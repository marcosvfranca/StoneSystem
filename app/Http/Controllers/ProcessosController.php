<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessosRequest;
use App\Processo;
use App\TipoMaterialProcesso;
use App\TipoMaterialProcessoProcessos;

class ProcessosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('processos');
        return view('pages.processos.index', ['processos' => Processo::all()]);
    }


    public function pesquisa()
    {
        $data = request()->all();
        $processos = Processo::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $processos
                ->where('nome', 'like', '%' . $data['q'] . '%');
        return view('pages.processos.table', ['processos' => $processos->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('processos', 'C');
        return view('pages.processos.create', ['tipoMaterialProcessos' => TipoMaterialProcesso::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessosRequest $request)
    {
        $this->temAcesso('processos', 'C');
        $data = $request->all();
        $processo = Processo::create($data);
        foreach ($data['tipo_material_processos'] ?? [] as $t)
            TipoMaterialProcessoProcessos::create(['processos_id' => $processo->id,'tipo_material_processos_id' => $t]);
        return redirect()->route('processos.index')->with('status', 'Processo cadastrado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Processo  $processo
     * @return \Illuminate\Http\Response
     */
    public function edit(Processo $processo)
    {
        $this->temAcesso('processos', 'A');
        return view('pages.processos.edit', ['processo' => $processo, 'tipoMaterialProcessos' => TipoMaterialProcesso::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Processo  $processo
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessosRequest $request, Processo $processo)
    {
        $this->temAcesso('processos', 'A');
        $data = $request->all();
        $processo->update($data);
        return redirect()->route('processos.index')->with('status', 'Processo alterado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Processo  $processo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Processo $processo)
    {
        //verificar se antes não tem algo associado
        dd($processo);
        $this->temAcesso('processos', 'E');
        $processo->delete();
        return redirect()->route('processos.index')->with('status', 'Processo excluído');
    }
}
