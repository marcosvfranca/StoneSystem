<?php

namespace App\Http\Controllers;

use App\AgendamentoProcesso;
use App\ChapaBlocoAgendamentoProcesso;
use App\Motivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExecutarProcessosController extends Controller
{
    public function index()
    {
        $this->temAcesso('executar_processos');
        $processosDisponiveis = AgendamentoProcesso::where('liberado', 'S')
            ->whereExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('chapa_bloco_agendamento_processos')
                    ->whereRaw('agendamento_processos.id = chapa_bloco_agendamento_processos.agendamento_processo_id')
                    ->whereNull('concluido')
                    ->where('cancelado', 'N');
            })->orderBy('created_at');
        if (auth()->user()->grupoUsuario()->first()->admin == 'N')
            $processosDisponiveis->where('grupos_usuario_id', auth()->user()->grupos_usuarios_id);
        return view('pages.agendamentoprocessos.executar.index', ['processosDisponiveis' => $processosDisponiveis->get()]);
    }

    public function edit(AgendamentoProcesso $agendamento)
    {
        return view('pages.agendamentoprocessos.executar.edit', ['agendamento' => $agendamento, 'motivos' => Motivo::all()]);;
    }

    public function concluiChapas()
    {
        $data = request()->all();
        foreach ($data['chapas'] as $chapa) {
            $agendamentoChapa = ChapaBlocoAgendamentoProcesso::find($chapa);
            $agendamentoChapa->concluido = 'S';
            $agendamentoChapa->user_id = auth()->id();
            $agendamentoChapa->save();
        }
        return true;
    }

    public function cancelarChapas()
    {
        $data = request()->all();
        foreach ($data['chapas'] as $chapa) {
            $agendamentoChapa = ChapaBlocoAgendamentoProcesso::find($chapa);
            $agendamentoChapa->cancelado = 'S';
            $agendamentoChapa->motivo_cancelamento_id = $data['motivo_cancelamento_id'];
            $agendamentoChapa->user_id = auth()->id();
            $agendamentoChapa->save();
        }
        return true;
    }

    public function naoConcluirChapas()
    {
        $data = request()->all();
        foreach ($data['chapas'] as $chapa) {
            $agendamentoChapa = ChapaBlocoAgendamentoProcesso::find($chapa);
            $agendamentoChapa->concluido = 'N';
            $agendamentoChapa->motivo_nao_conclusao_processo_id = $data['motivo_nao_conclusao_processo_id'];
            $agendamentoChapa->user_id = auth()->id();
            $agendamentoChapa->save();
        }
        return true;
    }

    public function chapas(AgendamentoProcesso $agendamento)
    {
        return view('pages.agendamentoprocessos.executar.chapas', ['agendamento' => $agendamento]);
    }

}
