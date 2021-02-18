<?php

namespace App\Http\Controllers;

use App\AgendamentoProcesso;
use App\Blocos;
use App\ChapaBlocoAgendamentoProcesso;
use App\ChapasBlocos;
use App\GruposUsuarios;
use App\Http\Requests\AgendamentoProcessosRequest;
use App\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class AgendamentoProcessosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('agendamento_processo');
        return view('pages.agendamentoprocessos.index', ['agendamentoProcessos' => AgendamentoProcesso::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('agendamento_processo');
        return view('pages.agendamentoprocessos.create', ['processos' => Processo::all(), 'gruposUsuarios' => GruposUsuarios::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendamentoProcessosRequest $request)
    {
        $data = $request->all();
        $agendamentoProcesso = AgendamentoProcesso::create($data);
        return redirect()->route('agendamento-processos.edit', ['agendamento_processo' => $agendamentoProcesso]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AgendamentoProcesso  $agendamentoProcesso
     * @return \Illuminate\Http\Response
     */
    public function show(AgendamentoProcesso $agendamentoProcesso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AgendamentoProcesso  $agendamentoProcesso
     * @return \Illuminate\Http\Response
     */
    public function edit(AgendamentoProcesso $agendamentoProcesso)
    {
        return view ('pages.agendamentoprocessos.edit', ['agendamentoProcesso' => $agendamentoProcesso, 'processos' => Processo::all(), 'gruposUsuarios' => GruposUsuarios::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AgendamentoProcesso  $agendamentoProcesso
     * @return \Illuminate\Http\Response
     */
    public function update(AgendamentoProcessosRequest $request, AgendamentoProcesso $agendamentoProcesso)
    {
        $data = $request->all();
        $this->temAcesso('agendamento_processos', 'A');
        $agendamentoProcesso->update($data);
        return redirect()->route('agendamento-processos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AgendamentoProcesso  $agendamentoProcesso
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgendamentoProcesso $agendamentoProcesso)
    {
        $agendamentoProcesso->deletar();
        return redirect()->route('agendamento-processos.index')->with('status', 'Agendamento excluido com sucesso');
    }

    public function pesquisaChapas()
    {
        global $q, $queryChapas, $agenda_id;
        $data = request()->all();
        $agenda_id = $data['id'];
        $blocos = $blocos = Blocos::where(function ($q) {
                $q->select(DB::raw('count(*)'))
                    ->from('chapas_blocos')
                    ->whereColumn('chapas_blocos.blocos_id', '=', 'blocos.id');
            }, '>', 0)
            ->orderByRaw('CAST(numeracao as SIGNED INTEGER)')
            ->limit(10);
        if(isset($data['q']) and $data['q']) {
            $q = $data['q'];
            $blocos->where('numeracao', 'like', "%$q%");
        }
        return view('pages.agendamentoprocessos.chapas', ['blocos' => $blocos->get()]);
    }
}
