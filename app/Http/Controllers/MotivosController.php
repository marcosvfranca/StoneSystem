<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotivosRequest;
use App\Motivo;
use Illuminate\Http\Request;

class MotivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('motivos');
        return view('pages.motivos.index', ['motivos' => Motivo::all()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $motivos = Motivo::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $motivos->where('motivo', 'like', '%' . $data['q'] . '%');
        return view('pages.motivos.table', ['motivos' => $motivos->get()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('motivos', 'C');
        return view('pages.motivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotivosRequest $request)
    {
        $this->temAcesso('motivos', 'C');
        $data = $request->all();
        $motivoCancelamento = Motivo::create($data);
        return redirect()->route('motivos.index')->with('status', 'Motivo de cancelamento de processo cadastrado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Motivo  $motivoCancelamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Motivo $motivo)
    {
        $this->temAcesso('motivos', 'A');
        return view('pages.motivos.edit', ['motivo' => $motivo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Motivo  $motivoCancelamento
     * @return \Illuminate\Http\Response
     */
    public function update(MotivosRequest $request, Motivo $motivo)
    {
        $motivo->update($request->all());
        return redirect()->route('motivos.index')->with('status', 'Motivo de operação de processo alterado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Motivo  $motivoCancelamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motivo $motivo)
    {
        //verificar se tem fk associado
        dd($motivo);
        $motivo->delete();
        return redirect()->route('motivos.index')->with('status', 'Motivo de operação- de processo excluído');
    }
}
