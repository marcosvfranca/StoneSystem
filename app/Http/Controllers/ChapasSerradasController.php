<?php

namespace App\Http\Controllers;

use App\BlocosBrutos;
use App\ChapasSerradas;
use App\EspessurasChapas;
use App\Http\Requests\ChapasSerradasRequest;
use App\ObservacoesChapas;
use App\ObservacoesChapasSerrada;
use App\OrdemDeSerradas;
use App\TiposBlocos;
use Illuminate\Http\Request;

class ChapasSerradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('chapas_serradas');
        return view('pages.chapasserradas.index', ['chapasSerradas' => ChapasSerradas::limit(100)->get()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $chapasSerradas = ChapasSerradas::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $chapasSerradas
                ->where('numeracao', 'like', '%' . $data['q'] . '%');
        return view('pages.chapasserradas.table', ['chapasSerradas' => $chapasSerradas->limit(100)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('chapas_serradas', 'C');
        return view('pages.chapasserradas.create', [
            'tiposBlocos' => TiposBlocos::all(),
            'observacoes' => ObservacoesChapas::all()
        ]);
    }

    public function createForOrder(OrdemDeSerradas $ordem_de_serrada)
    {
        $chapa_serrada = ChapasSerradas::create([
            'numeracao' => $ordem_de_serrada->blocoBruto()->first()->numeracao,
            'tipos_blocos_id' => $ordem_de_serrada->blocoBruto()->first()->tipos_blocos_id
        ]);
        $ordem_de_serrada->chapas_serradas_id = $chapa_serrada->id;
        $ordem_de_serrada->user_id = auth()->id();
        $ordem_de_serrada->save();
        $bloco_bruto = $ordem_de_serrada->blocoBruto()->first();
        $bloco_bruto->chapas_serradas_id = $chapa_serrada->id;
        $bloco_bruto->save();
        return redirect()->route('chapas-serradas.editfororder', ['ordem_de_serrada' => $ordem_de_serrada]);
    }

    public function editForOrder(OrdemDeSerradas $ordem_de_serrada)
    {
        return view('pages.chapasserradas.editfororder', [
            'ordem_de_serrada' => $ordem_de_serrada,
            'tiposBlocos' => TiposBlocos::all(),
            'observacoes' => ObservacoesChapas::all(),
            'espessuras' => EspessurasChapas::all(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapasSerradasRequest $request)
    {
        $this->temAcesso('chapas_serradas', 'C');
        $data = $request->all();
        $chapaSerrada = ChapasSerradas::create($data);
        foreach ($data['observacoes_id'] as $o)
            ObservacoesChapasSerrada::create([
                'chapas_serradas_id' => $chapaSerrada->id,
                'observacoes_chapas_id' => $o
            ]);

        $bloco_bruto = BlocosBrutos::whereNull('chapas_serradas_id')->where('numeracao', $chapaSerrada->numeracao)->first();
        if ($bloco_bruto) {
            $bloco_bruto->chapas_serradas_id = $chapaSerrada->id;
            $bloco_bruto->save();
        }
        return redirect()->route('chapas-serradas.edit', ['chapas_serrada' => $chapaSerrada]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ChapasSerradas  $chapasSerradas
     * @return \Illuminate\Http\Response
     */
    public function show(ChapasSerradas $chapasSerradas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChapasSerradas  $chapasSerradas
     * @return \Illuminate\Http\Response
     */
    public function edit(ChapasSerradas $chapas_serrada)
    {
        $this->temAcesso('chapas_serradas', 'A');
        return view('pages.chapasserradas.edit', [
            'chapasSerradas' => $chapas_serrada,
            'tiposBlocos' => TiposBlocos::all(),
            'observacoes' => ObservacoesChapas::all(),
            'espessuras' => EspessurasChapas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChapasSerradas  $chapasSerradas
     * @return \Illuminate\Http\Response
     */
    public function update(ChapasSerradasRequest $request, ChapasSerradas $chapas_serrada)
    {
        $this->temAcesso('chapas_serradas', 'A');
        $data = $request->all();
        $chapas_serrada->update($data);
        ObservacoesChapasSerrada::where('chapas_serradas_id', $chapas_serrada->id)->delete();
        foreach ($data['observacoes_id'] as $o)
            ObservacoesChapasSerrada::create([
                'chapas_serradas_id' => $chapas_serrada->id,
                'observacoes_chapas_id' => $o
            ]);
        if (isset($data['redirect_to_ordem_de_serradas']) and $data['redirect_to_ordem_de_serradas'] == 'S')
            return redirect()->route('ordem-de-serradas.executar')->with('status', 'Ordem de serrada concluída com sucesso');
        return redirect()->route('chapas-serradas.index')->with('status', 'Chapa serrada alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChapasSerradas  $chapasSerradas
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChapasSerradas $chapas_serrada)
    {
        $this->temAcesso('chapas_serradas', 'A');
        $chapas_serrada->deletar();
        return redirect()->route('chapas-serradas.index')->with('status', 'Chapa serrada excluída com sucesso');
    }
}
