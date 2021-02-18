<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoMaterialProcessosRequest;
use App\TipoMaterialProcesso;
use Illuminate\Http\Request;

class TipoMaterialProcessosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('tipo_material_processos');
        $tipoMaterialProcessos = TipoMaterialProcesso::get();
        return view('pages.tipomaterialprocessos.index', ['tipoMaterialProcessos' => $tipoMaterialProcessos]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $tipoMaterialProcessos = TipoMaterialProcesso::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $tipoMaterialProcessos
                ->where('tipo', 'like', '%' . $data['q'] . '%');
        return view('pages.tipomaterialprocessos.table', ['tipoMaterialProcessos' => $tipoMaterialProcessos->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('tipo_material_processos', 'C');
        return view('pages.tipomaterialprocessos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoMaterialProcessosRequest $request)
    {
        $data = $request->all();
        $tipoMaterialProcesso = TipoMaterialProcesso::create($data);
        return redirect()->route('tipo-material-processos.index')->with('status', 'Material de processo cadastrado!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoMaterialProcesso  $tipoMaterialProcesso
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMaterialProcesso $tipoMaterialProcesso)
    {
        return view('pages.tipomaterialprocessos.edit', ['tipoMaterialProcessos' => $tipoMaterialProcesso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoMaterialProcesso  $tipoMaterialProcesso
     * @return \Illuminate\Http\Response
     */
    public function update(TipoMaterialProcessosRequest $request, TipoMaterialProcesso $tipoMaterialProcesso)
    {
        $data = $request->all();
        $tipoMaterialProcesso->update($data);
        return redirect()->route('tipo-material-processos.index')->with('status', 'Material de processo alterado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoMaterialProcesso  $tipoMaterialProcesso
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMaterialProcesso $tipoMaterialProcesso)
    {
        if ($tipoMaterialProcesso->processos()->count() or $tipoMaterialProcesso->chapaAgendamentoProcessos()->count())
            return redirect()->route('tipo-material-processos.index')->with('error', 'Não será possivel excluir este material!');
        $tipoMaterialProcesso->delete();
        return redirect()->route('tipo-material-processos.index')->with('status', 'Material de processo excluido!');
    }

}
