<?php

namespace App\Http\Controllers;

use App\BlocosBrutos;
use App\ClassificacoesBlocos;
use App\Fornecedores;
use App\Http\Requests\BlocosBrutosRequest;
use App\ObservacoesBlocosBrutos;
use App\ObservacoesChapas;
use App\TiposBlocos;
use App\Transportadores;
use Illuminate\Http\Request;

class BlocosBrutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('blocos_brutos');
        return view('pages.blocos-brutos.index', ['blocos_brutos' => BlocosBrutos::limit(100)->get()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $blocos_brutos = BlocosBrutos::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $blocos_brutos
                ->where('numeracao_pedreira	', 'like', '%' . $data['q'] . '%')
                ->where('nosso_numero	', 'like', '%' . $data['q'] . '%');
        return view('pages.blocos-brutos.table', ['blocos_brutos' => $blocos_brutos->limit(100)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('blocos_brutos', 'C');
        return view('pages.blocos-brutos.create', [
            'transportadores' => Transportadores::all(),
            'tipos_blocos' => TiposBlocos::all(),
            'classificacoes_blocos' => ClassificacoesBlocos::all(),
            'fornecedores' => Fornecedores::all(),
            'observacoes' => ObservacoesChapas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlocosBrutosRequest $request)
    {
        $data = $request->all();
        $data['comprimento_bruto'] = str_replace(',', '.', $data['comprimento_bruto']);
        $data['altura_bruta'] = str_replace(',', '.', $data['altura_bruta']);
        $data['largura_bruta'] = str_replace(',', '.', $data['largura_bruta']);
        $data['comprimento_liquido'] = str_replace(',', '.', $data['comprimento_liquido']);
        $data['altura_liquida'] = str_replace(',', '.', $data['altura_liquida']);
        $data['largura_liquida'] = str_replace(',', '.', $data['largura_liquida']);
        $bloco_bruto = BlocosBrutos::create($data);
        foreach ($data['observacoes_id'] as $o)
            ObservacoesBlocosBrutos::create([
                'blocos_brutos_id' => $bloco_bruto->id,
                'observacoes_chapas_id' => $o
            ]);
        return redirect()->route('blocos-brutos.index')->with('status', 'Bloco cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlocosBrutos  $blocosBrutos
     * @return \Illuminate\Http\Response
     */
    public function show(BlocosBrutos $blocosBrutos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlocosBrutos  $blocosBrutos
     * @return \Illuminate\Http\Response
     */
    public function edit(BlocosBrutos $blocos_bruto)
    {
        $this->temAcesso('blocos_brutos', 'A');
        return view('pages.blocos-brutos.edit', [
            'blocos_bruto' => $blocos_bruto,
            'transportadores' => Transportadores::all(),
            'tipos_blocos' => TiposBlocos::all(),
            'classificacoes_blocos' => ClassificacoesBlocos::all(),
            'fornecedores' => Fornecedores::all(),
            'observacoes' => ObservacoesChapas::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlocosBrutos  $blocosBrutos
     * @return \Illuminate\Http\Response
     */
    public function update(BlocosBrutosRequest $request, BlocosBrutos $blocos_bruto)
    {
        $this->temAcesso('blocos_brutos', 'A');
        $data = $request->all();
        $data['comprimento_bruto'] = str_replace(',', '.', $data['comprimento_bruto']);
        $data['altura_bruta'] = str_replace(',', '.', $data['altura_bruta']);
        $data['largura_bruta'] = str_replace(',', '.', $data['largura_bruta']);
        $data['comprimento_liquido'] = str_replace(',', '.', $data['comprimento_liquido']);
        $data['altura_liquida'] = str_replace(',', '.', $data['altura_liquida']);
        $data['largura_liquida'] = str_replace(',', '.', $data['largura_liquida']);
        $blocos_bruto->update($data);
        ObservacoesBlocosBrutos::where('blocos_brutos_id', $blocos_bruto->id)->delete();
        foreach ($data['observacoes_id'] as $o)
            ObservacoesBlocosBrutos::create([
                'blocos_brutos_id' => $blocos_bruto->id,
                'observacoes_chapas_id' => $o
            ]);
        return redirect()->route('blocos-brutos.index')->with('status', 'Bloco alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlocosBrutos  $blocosBrutos
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlocosBrutos $blocos_bruto)
    {
        $this->temAcesso('blocos_brutos', 'E');
        $blocos_bruto->delete();
        return redirect()->route('blocos-brutos.index')->with('status', 'Bloco excluído com sucesso');
    }
}
