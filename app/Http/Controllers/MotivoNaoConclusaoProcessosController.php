<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotivoNaoConclusaoProcessoRequest;
use App\MotivoNaoConclusaoProcesso;
use Illuminate\Http\Request;

class MotivoNaoConclusaoProcessosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('motivo_nao_conclusao_processos');
        $motivoNaoConclusaoProcessos = MotivoNaoConclusaoProcesso::all();
        return view('pages.motivonaoconclusaoprocessos.index', ['motivoNaoConclusaoProcessos' => $motivoNaoConclusaoProcessos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('motivo_nao_conclusao_processos', 'C');
        return view('pages.motivonaoconclusaoprocessos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotivoNaoConclusaoProcessoRequest $request)
    {
        $this->temAcesso('motivo_nao_conclusao_processos', 'C');
        $data = $request->all();
        $motivo = MotivoNaoConclusaoProcesso::create($data);
        return redirect()->route('motivo-nao-conclusao-processos.index')->with('status', 'Motivo cadastrado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MotivoNaoConclusaoProcesso  $motivoNaoConclusaoProcesso
     * @return \Illuminate\Http\Response
     */
    public function edit(MotivoNaoConclusaoProcesso $motivoNaoConclusaoProcesso)
    {
        $this->temAcesso('motivo_nao_conclusao_processos', 'A');
        return view ('pages.motivonaoconclusaoprocessos.edit', ['motivoNaoConclusaoProcesso' => $motivoNaoConclusaoProcesso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MotivoNaoConclusaoProcesso  $motivoNaoConclusaoProcesso
     * @return \Illuminate\Http\Response
     */
    public function update(MotivoNaoConclusaoProcessoRequest $request, MotivoNaoConclusaoProcesso $motivoNaoConclusaoProcesso)
    {
        $data = $request->all();
        $motivoNaoConclusaoProcesso->update($data);
        return redirect()->route('motivo-nao-conclusao-processos.index')->with('status', 'Motivo alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MotivoNaoConclusaoProcesso  $motivoNaoConclusaoProcesso
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotivoNaoConclusaoProcesso $motivoNaoConclusaoProcesso)
    {
        // fazer as verificações se pode delatar antes
        dd($motivoNaoConclusaoProcesso);
        return redirect()->route('motivo-nao-conclusao-processos.index')->with('status', 'Motivo alterado com sucesso');
    }
}
