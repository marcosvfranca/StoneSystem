<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItensTiposBlocosRequest;
use App\ItensTiposBlocos;

class ItensTiposBlocosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        return view()
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //    public function create()
    //    {
    //        //
    //    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItensTiposBlocosRequest $request)
    {
        $data = $request->all();
        $itemTipoBloco = ItensTiposBlocos::create($data);
        return redirect()->route('tiposblocos.editar', ['id' => $itemTipoBloco->tipos_blocos_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItensTiposBlocos  $itensTiposBlocos
     * @return \Illuminate\Http\Response
     */
//    public function show(ItensTiposBlocos $itensTiposBlocos)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItensTiposBlocos  $itensTiposBlocos
     * @return \Illuminate\Http\Response
     */
//    public function edit(ItensTiposBlocos $itensTiposBlocos)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItensTiposBlocos  $itensTiposBlocos
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, ItensTiposBlocos $itensTiposBlocos)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItensTiposBlocos  $itensTiposBlocos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItensTiposBlocos $itens_tipos_bloco)
    {
        $tipos_blocos_id = $itens_tipos_bloco->tipos_blocos_id;
        $this->temAcesso('itens-tipos-blocos', 'E');
        $itens_tipos_bloco->delete();
        return redirect()->route('tiposblocos.editar', ['id' => $tipos_blocos_id]);
    }
}
