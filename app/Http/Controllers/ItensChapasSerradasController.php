<?php

namespace App\Http\Controllers;

use App\ChapasSerradas;
use App\EspessurasChapas;
use App\Http\Requests\ItensChapasSerradasRequest;
use App\ItensChapasSerrada;
use Illuminate\Http\Request;

class ItensChapasSerradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapasSerradas = ChapasSerradas::findOrFail(request()->get('serrada_id') ?? 0);
        return view('pages.chapasserradas.itens.index', ['chapas' => $chapasSerradas->chapas()->orderByRaw('CAST(numeracao as SIGNED INTEGER)')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chapasSerradas = ChapasSerradas::findOrFail(request()->get('serrada_id') ?? 0);
        return view('pages.chapasserradas.itens.create', ['chapasSerradas' => $chapasSerradas, 'espessuras' => EspessurasChapas::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItensChapasSerradasRequest $request)
    {
        $data = $request->all();
        $numeracao = (int)$data['numeracao_inicial'];
        $data['comprimento'] = str_replace(',', '.', $data['comprimento']);
        $data['altura'] = str_replace(',', '.', $data['altura']);
        for ($i = 0; $i < (int)$data['qtd']; $i++) {
            $data['numeracao'] = $numeracao + $i;
            $itemChapaSerrada = ItensChapasSerrada::create($data);
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItensChapasSerrada  $itensChapasSerrada
     * @return \Illuminate\Http\Response
     */
    public function show(ItensChapasSerrada $itensChapasSerrada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItensChapasSerrada  $itensChapasSerrada
     * @return \Illuminate\Http\Response
     */
    public function edit(ItensChapasSerrada $itensChapasSerrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItensChapasSerrada  $itensChapasSerrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItensChapasSerrada $itensChapasSerrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItensChapasSerrada  $itensChapasSerrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItensChapasSerrada $itens_chapas_serrada)
    {
        $itens_chapas_serrada->delete();
        return true;
    }
}
