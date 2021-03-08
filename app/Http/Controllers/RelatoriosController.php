<?php

namespace App\Http\Controllers;

use App\AgendamentoProcesso;
use App\Blocos;
use App\BlocosBrutos;
use App\ChapasSerradas;
use App\ClassificacoesBlocos;
use App\Fornecedores;
use App\GruposUsuarios;
use App\Processo;
use App\TiposBlocos;
use App\Transportadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    public function estoqueChapasSerradas()
    {
        $this->temAcesso('relatorio_estoque_chapas_serradas');
        $data = request()->all();
        $chapas_serradas = ChapasSerradas::whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('itens_chapas_serradas')
                ->whereColumn('itens_chapas_serradas.chapas_serradas_id', 'chapas_serradas.id')
                ->whereNull('chapas_bloco_id');
        });

        if (isset($data['numeracao']))
            $chapas_serradas->where('numeracao', 'like', '%' . $data['numeracao'] . '%');

        if (isset($data['tipos_blocos'])) {
            if (count($data['tipos_blocos']) == 1)
                $chapas_serradas->where('tipos_blocos_id', $data['tipos_blocos'][0]);
            else
                $chapas_serradas->whereIn('tipos_blocos_id', $data['tipos_blocos']);
        }

        if (isset($data['dtinicial']) and isset($data['dtfinal']))
            $chapas_serradas->whereBetween('created_at', [$data['dtinicial'], $data['dtfinal']]);

        return view('pages.relatorios.estoque-chapas-serradas', [
            'chapas_serradas' => $chapas_serradas->get(),
            'tipos_blocos' => TiposBlocos::all()
        ]);
    }

    public static function getScriptEstoqueChapasBlocos()
    {
        return DB::table('blocos')
            ->select('blocos.numeracao',
                'blocos.created_at',
                'tipos_blocos.descricao as material',
                'chapas_blocos.espessuras_chapas_id',
                'espessuras_chapas.descricao as espessura',
                DB::raw('count(chapas_blocos.id) as qtdChapas'),
                DB::raw('sum(chapas_blocos.comprimento * chapas_blocos.largura) as m2'),
                DB::raw('max(chapas_blocos.comprimento) as comprimento'),
                DB::raw('max(chapas_blocos.largura) as altura')
            )
            ->join('chapas_blocos', 'blocos.id', '=', 'chapas_blocos.blocos_id')
            ->join('tipos_blocos', 'blocos.tipos_blocos_id', '=', 'tipos_blocos.id')
            ->join('espessuras_chapas', 'chapas_blocos.espessuras_chapas_id', '=', 'espessuras_chapas.id')
            ->whereNotExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('chapa_bloco_agendamento_processos')
                    ->whereRaw('chapa_bloco_agendamento_processos.chapas_bloco_id = chapas_blocos.id')
                    ->limit(1);
            })
            ->groupBy('blocos.numeracao', 'blocos.created_at', 'tipos_blocos.descricao', 'chapas_blocos.espessuras_chapas_id', 'espessuras_chapas.descricao');
    }

    public function blocosChapas()
    {
        $this->temAcesso('relatorio_blocos_chapas');
        $data = request()->all();
        $blocos = $this->getScriptEstoqueChapasBlocos();

        if (isset($data['numeracao']))
            $blocos->where('blocos.numeracao', 'like', '%' . $data['numeracao'] . '%');

        if (isset($data['tipos_blocos'])) {
            if (count($data['tipos_blocos']) == 1)
                $blocos->where('tipos_blocos.id', $data['tipos_blocos'][0]);
            else
                $blocos->whereIn('tipos_blocos.id', $data['tipos_blocos']);
        }

        if (isset($data['dtinicial']) and isset($data['dtfinal']))
            $blocos->whereBetween('blocos.created_at', [$data['dtinicial'], $data['dtfinal'] . ' 23:59:59 999']);

        return view('pages.relatorios.blocos-chapas', [
            'blocos' => $blocos->get(),
            'tipos_blocos' => TiposBlocos::all()
        ]);
    }

    public function estoqueBlocos()
    {
        $this->temAcesso('relatorio_estoque_blocos');
        $data = request()->all();
        $blocos_brutos = BlocosBrutos::whereNull('chapas_serradas_id');

        if (isset($data['numeracao']))
            $blocos_brutos->where('numeracao', 'like', '%' . $data['numeracao'] . '%');


        if (isset($data['tipos_blocos'])) {
            if (count($data['tipos_blocos']) == 1)
                $blocos_brutos->where('tipos_blocos_id', $data['tipos_blocos'][0]);
            else
                $blocos_brutos->whereIn('tipos_blocos_id', $data['tipos_blocos']);
        }

        if (isset($data['transportadores_id'])) {
            if (count($data['transportadores_id']) == 1)
                $blocos_brutos->where('transportadores_id', $data['transportadores_id'][0]);
            else
                $blocos_brutos->whereIn('transportadores_id', $data['transportadores_id']);
        }

        if (isset($data['fornecedores_id'])) {
            if (count($data['fornecedores_id']) == 1)
                $blocos_brutos->where('fornecedores_id', $data['fornecedores_id'][0]);
            else
                $blocos_brutos->whereIn('fornecedores_id', $data['fornecedores_id']);
        }

        if (isset($data['classificacoes_blocos_id'])) {
            if (count($data['classificacoes_blocos_id']) == 1)
                $blocos_brutos->where('classificacoes_blocos_id', $data['classificacoes_blocos_id'][0]);
            else
                $blocos_brutos->whereIn('classificacoes_blocos_id', $data['classificacoes_blocos_id']);
        }

        if (isset($data['dtinicial']) and isset($data['dtfinal']))
            $blocos_brutos->whereBetween('created_at', [$data['dtinicial'], $data['dtfinal']  . ' 23:59:59 999']);

        return view('pages.relatorios.estoque-blocos-brutos', [
            'blocos_brutos' => $blocos_brutos->get(),
            'tipos_blocos' => TiposBlocos::all(),
            'transportadores' => Transportadores::all(),
            'classificacoes_blocos' => ClassificacoesBlocos::all(),
            'fornecedores' => Fornecedores::all(),
        ]);
    }

    public function agendamentos()
    {
        $this->temAcesso('relatorio_agendamentos');

        $data = request()->all();
        if (!isset($data['dtinicial']) and !isset($data['dtfinal'])) {
            $data['dtinicial'] = $dtinicial = date('Y-m-d', time() - 60*60*24);
            $data['dtfinal'] = $dtfinal = date('Y-m-d', time());
        }
        /*
select ap.id, ap.observacoes, b.numeracao, tb.descricao, gu.nome, ap.created_at,
	sum(if(cbap.concluido = 'S', 1, 0)) as concluido,
    sum(if(cbap.concluido = 'N', 1, 0)) as nconcluido,
    sum(if(cbap.cancelado = 'S', 1, 0)) as cancelado,
    count(cbap.id) as chapas
from agendamento_processos ap
inner join processos p on p.id = ap.processo_id
inner join grupos_usuarios gu on gu.id = ap.grupos_usuario_id
inner join chapa_bloco_agendamento_processos cbap on cbap.agendamento_processo_id = ap.id
inner join chapas_blocos cb on cb.id = cbap.chapas_bloco_id
inner join blocos b on b.id = cb.blocos_id
inner join tipos_blocos tb on tb.id = b.tipos_blocos_id
group by ap.id, ap.observacoes, b.numeracao, tb.descricao, gu.nome, ap.created_at
        */
        $agendamentos = DB::table('agendamento_processos as ap')
            ->select('ap.id', 'p.nome', 'ap.observacoes', 'b.numeracao', 'tb.descricao as material', 'gu.nome as setor', 'ap.created_at',
                        DB::raw("sum(if(cbap.concluido = 'S', 1, 0)) as concluido"),
                        DB::raw("sum(if(cbap.concluido = 'N', 1, 0)) as nconcluido"),
                        DB::raw("sum(if(cbap.cancelado = 'S', 1, 0)) as cancelado"),
                        DB::raw("count(cbap.id) as chapas"))
            ->join('processos as p', 'p.id', '=','ap.processo_id')
            ->join('grupos_usuarios as gu', 'gu.id', '=' , 'ap.grupos_usuario_id')
            ->join('chapa_bloco_agendamento_processos as cbap', 'cbap.agendamento_processo_id' , '=', 'ap.id')
            ->join('chapas_blocos as cb', 'cb.id', '=', 'cbap.chapas_bloco_id')
            ->join('blocos as b', 'b.id', '=', 'cb.blocos_id')
            ->join('tipos_blocos as tb', 'tb.id', '=', 'b.tipos_blocos_id')
            ->groupBy('ap.id', 'p.nome', 'ap.observacoes', 'b.numeracao', 'tb.descricao', 'gu.nome', 'ap.created_at');

        if (isset($data['numeracao']))
            $agendamentos->where('b.numeracao', 'like', '%' . $data['numeracao'] . '%');

        if (isset($data['tipos_blocos'])) {
            if (count($data['tipos_blocos']) == 1)
                $agendamentos->where('b.tipos_blocos_id', $data['tipos_blocos'][0]);
            else
                $agendamentos->whereIn('b.tipos_blocos_id', $data['tipos_blocos']);
        }

        if (isset($data['grupos_usuarios_id'])) {
            if (count($data['grupos_usuarios_id']) == 1)
                $agendamentos->where('ap.grupos_usuario_id', $data['grupos_usuarios_id'][0]);
            else
                $agendamentos->whereIn('ap.grupos_usuario_id', $data['grupos_usuarios_id']);
        }

        if (isset($data['processo_id'])) {
            if (count($data['processo_id']) == 1)
                $agendamentos->where('ap.processo_id', $data['processo_id'][0]);
            else
                $agendamentos->whereIn('ap.processo_id', $data['processo_id']);
        }

        if (isset($data['dtinicial']) and isset($data['dtfinal']))
            $agendamentos->whereBetween('ap.created_at', [$data['dtinicial'] . ' 00:00:00 000', $data['dtfinal']  . ' 23:59:59 999']);

        return view('pages.relatorios.agendamentos', [
            'agendamentos' => $agendamentos->get(),
            'tipos_blocos' => TiposBlocos::all(),
            'grupos_usuarios' => GruposUsuarios::all(),
            'processos' => Processo::all(),
            'dtinicial' => $dtinicial ?? null,
            'dtfinal' => $dtfinal ?? null,
        ]);
    }

    public function historicoBloco($numeracao)
    {
        return view('pages.relatorios.historico-bloco', [
            'numeracao' => $numeracao,
            'bloco' => BlocosBrutos::where('numeracao_pedreira', $numeracao)->first(),
            'chapa_serrada' => ChapasSerradas::where('numeracao', $numeracao)->first(),
            'chapa_bruta' => Blocos::where('numeracao', $numeracao)->first(),
        ]);
    }

}
