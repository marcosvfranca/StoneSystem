<?php

namespace App\Http\Controllers;

use App\ChapaAgendamentoTiposMateriais;
use App\ChapaBlocoAgendamentoProcesso;
use App\Http\Requests\ChapaBlocoAgendamentoProcessosRequest;
use Illuminate\Http\Request;

class ChapaBlocoAgendamentoProcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = request()->all();
        if (isset($data['agendamentoProcesso']))
            $chapas = ChapaBlocoAgendamentoProcesso::where('agendamento_processo_id', $data['agendamentoProcesso'])->get();
        else
            $chapas = ChapaBlocoAgendamentoProcesso::all();
        return view('pages.agendamentoprocessos.chapascadastradas', ['chapas' => $chapas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapaBlocoAgendamentoProcessosRequest $request)
    {
        $data = $request->all();
        if (!isset($data['chapas_bloco']) or !isset($data['tipos_materiais']))
            return response()->json(['mensagem' => 'Parametros imcompletos']);

        foreach ($data['chapas_bloco'] as $chapa) {
            $agendamento = ChapaBlocoAgendamentoProcesso::create([
                'agendamento_processo_id' => $data['agendamento_processo_id'],
                'chapas_bloco_id' => $chapa
            ]);
            foreach ($data['tipos_materiais'] as $tipoMaterial) {
                ChapaAgendamentoTiposMateriais::create([
                    'chapa_bloco_agendamento_processo_id' => $agendamento->id,
                    'tipo_material_processo_id' => $tipoMaterial
                ]);
            }
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChapaBlocoAgendamentoProcesso  $chapaBlocoAgendamentoProcesso
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChapaBlocoAgendamentoProcesso $chapas_agendamento)
    {
        $this->temAcesso('agendamento_processos', 'E');
        $chapas_agendamento->delete();
        return back()->with('status', 'Chapa excluída com suceso');
    }

}
