<?php

namespace App\Http\Controllers;

use App\Blocos;
use App\ChapaBlocoAgendamentoProcesso;
use App\ChapasBlocos;
use App\ChapasBlocosEstadosChapas;
use App\ChapasBlocosObservacoesChapas;
use App\ChapasSerradas;
use App\EspessurasChapas;
use App\EstadosChapas;
use App\Http\Requests\BlocosRequest;
use App\ItensChapasSerrada;
use App\ObservacoesChapas;
use App\TiposBlocos;
use App\Transportadores;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlocosController extends Controller
{

    public function rindex()
    {
        return redirect('blocos');
    }

    public function index()
    {
        $this->temAcesso('blocos');
        $blocos = Blocos::all();
        return view('pages.blocos.index', ['blocos' => $blocos]);
    }

    public function pesquisa()
    {
        global $data;
        $data = request()->all();
        $blocos = Blocos::orderByRaw('CAST(numeracao as SIGNED INTEGER)')->limit(50);
        if(isset($data['q']) and $data['q'])
            $blocos->where('numeracao', 'like', "%" . $data['q'] . "%")
                ->orWhereExists(function ($query) {
                    global $data;
                    $query->select(DB::raw(1))
                        ->from('tipos_blocos')
                        ->whereColumn('blocos.tipos_blocos_id', 'tipos_blocos.id')
                        ->where('tipos_blocos.descricao', 'like', "%" . $data['q'] . "%");
                })
                ->orWhereExists(function ($query) {
                    global $data;
                    $query->select(DB::raw(1))
                        ->from('transportadores')
                        ->whereColumn('blocos.transportadores_id', 'transportadores.id')
                        ->where('transportadores.nome', 'like', "%" . $data['q'] . "%")
                        ->orWhere('transportadores.placa', 'like', "%" . $data['q'] . "%");
                });
        return view('pages.blocos.table', ['blocos' => $blocos->get()]);
    }

    public function pesquisaChapas()
    {
        $data = request()->all();

        $chapas_serradas = DB::table('chapas_serradas')
            ->select('chapas_serradas.id', 'chapas_serradas.tipos_blocos_id', 'chapas_serradas.numeracao as value', DB::raw("concat(chapas_serradas.numeracao, ' - ', tipos_blocos.descricao) as label"))
            ->join('tipos_blocos', 'tipos_blocos.id', 'chapas_serradas.tipos_blocos_id')
            ->whereNotExists(function ($query) {
                $query->from('itens_chapas_serradas')
                    ->whereColumn('chapas_serradas.id', 'itens_chapas_serradas.chapas_serradas_id')
                    ->whereNotNull('itens_chapas_serradas.chapas_bloco_id');
            })->where(function ($query) {
                $query->select([DB::raw('COUNT(*)')])->from('itens_chapas_serradas')->whereColumn('chapas_serradas.id', 'itens_chapas_serradas.chapas_serradas_id');
            }, '>', 0);

        if(isset($data['q']))
            $chapas_serradas->where('chapas_serradas.numeracao', 'like', "%{$data['q']}%");

        return $chapas_serradas->get()->toJson();
    }

    public function cadastrar()
    {
        $this->temAcesso('blocos', 'I');
        $data = [
            'transportadores' => Transportadores::all(),
            'tiposblocos' => TiposBlocos::all()
        ];
        return view('pages.blocos.cadastrar', ['data' => $data]);
    }

    public function editar(Blocos $id)
    {
        return view('pages.blocos.alterar', [
            'bloco' => $id,
            'transportadores' => Transportadores::all(),
            'tiposblocos' => TiposBlocos::all(),
            'espessuras' => EspessurasChapas::all(),
            'estadosChapas' => EstadosChapas::all(),
            'observacoesChapas' => ObservacoesChapas::all(),
            'chapaSerrada' => ItensChapasSerrada::join('chapas_serradas', 'chapas_serradas.id', '=', 'itens_chapas_serradas.chapas_serradas_id')
                ->leftJoin('chapas_blocos', 'chapas_blocos.id', '=', 'itens_chapas_serradas.chapas_bloco_id')
                ->where('chapas_serradas.numeracao', '=', $id->numeracao)
                ->whereNull('itens_chapas_serradas.chapas_bloco_id')
        ]);
    }

    public function listaSerrada(Blocos $bloco)
    {
        return view('pages.blocos.serrada', [
            'chapaSerrada' => ItensChapasSerrada::join('chapas_serradas', 'chapas_serradas.id', '=', 'itens_chapas_serradas.chapas_serradas_id')
                                ->leftJoin('chapas_blocos', 'chapas_blocos.id', '=', 'itens_chapas_serradas.chapas_bloco_id')
                                ->where('chapas_serradas.numeracao', '=', $bloco->numeracao)
                                ->whereNull('itens_chapas_serradas.chapas_bloco_id')
        ]);
    }

    public function importaSerrada(Blocos $bloco)
    {
        $itens =
            DB::table('itens_chapas_serradas')
                ->select('itens_chapas_serradas.*')
                ->join('chapas_serradas', 'chapas_serradas.id', '=', 'itens_chapas_serradas.chapas_serradas_id')
                ->leftJoin('chapas_blocos', 'chapas_blocos.id', '=', 'itens_chapas_serradas.chapas_bloco_id')
                ->where('chapas_serradas.numeracao', '=', $bloco->numeracao)
                ->whereNull('itens_chapas_serradas.chapas_bloco_id')
                ->orderByRaw('CAST(itens_chapas_serradas.numeracao as SIGNED INTEGER)')
                ->get();
        return view('pages.blocos.importarserrada', ['itens' => $itens, 'numeracao' => $bloco->numeracao]);

    }

    public function salvaImportacaoSerrada(Blocos $bloco)
    {
        $data = request()->all();
        foreach ($data['chapas'] as $chapa) {
            $item = ItensChapasSerrada::find($chapa);
            $serrada = ChapasSerradas::find($item->chapas_serradas_id);
            $c = ChapasBlocos::create([
                'blocos_id' => $bloco->id,
                'numeracao' => $item->numeracao,
                'espessuras_chapas_id' => $item->espessuras_chapas_id,
                'comprimento' => $item->comprimento,
                'largura' => $item->altura,
            ]);
            ChapasBlocosEstadosChapas::create(['chapas_blocos_id' => $c->id, 'estados_chapas_id' => 1]);
            foreach ($serrada->observacoes()->get() as $o)
                ChapasBlocosObservacoesChapas::create(['chapas_blocos_id' => $c->id, 'observacoes_chapas_id' => $o->observacoes_chapas_id]);
            $item->chapas_bloco_id = $c->id;
            $item->save();
        }
        return true;
    }

    public function deletar($id)
    {
        global $b;
        $b = Blocos::findOrFail($id);
        $aux = ChapaBlocoAgendamentoProcesso::whereExists(function ($q) {
            global $b;
            $q->select(DB::raw(1))
                ->from('chapas_blocos')
                ->whereRaw('chapas_blocos.id = chapa_bloco_agendamento_processos.chapas_bloco_id')
                ->where('blocos_id', $b->id);
        });
        if ($aux->count())
            return $this->rindex()->with('error', 'Não será possível excluir esse bloco pois ele já foi agendado em um processo.');
        $b->deletar();
        return $this->rindex()->with('status', 'Bloco excluído com sucesso');
    }

    public function inserir(BlocosRequest $request)
    {
        $data = $request->all();
        $bloco = $this->create($data);
        if ($this->temAcesso('blocos.inserir.redirecionar'))
            return redirect()->route('blocos.editar', ['id' => $bloco->id]);
        else
            return $this->rindex();
    }

    public function alterar(BlocosRequest $request, $id)
    {
        $data = $request->all();
        $bloco = Blocos::findOrFail($id);
        $this->update($bloco, $data);
        return $this->rindex();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Blocos
     */
    protected function create(array $data)
    {
        return Blocos::create($data);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Blocos
     */
    protected function update($bloco, array $data)
    {
//        dd($data);
        return $bloco->update($data);
    }
}
