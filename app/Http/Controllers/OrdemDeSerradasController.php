<?php

namespace App\Http\Controllers;

use App\BlocosBrutos;
use App\EspessurasChapas;
use App\Http\Requests\OrdemDeSerradasRequest;
use App\OrdemDeSerradas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdemDeSerradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('ordem_de_serradas');
        return view('pages.ordemdeserradas.index', ['ordem_de_serradas' => OrdemDeSerradas::limit(100)->orderByDesc('id')->get()]);
    }

    public function pesquisa()
    {
        $data = request()->all();

        $ordem_de_serradas = OrdemDeSerradas::join('blocos_brutos', 'blocos_brutos.id', '=', 'ordem_de_serradas.blocos_brutos_id')
            ->orderByDesc('ordem_de_serradas.id');

        if (isset($data['q']))
            $ordem_de_serradas->where('blocos_brutos.numeracao', 'like', '%' . $data['q'] . '%');

        return view('pages.ordemdeserradas.table', [
            'ordem_de_serradas' => $ordem_de_serradas->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('ordem_de_serradas', 'C');
        return view('pages.ordemdeserradas.create', [
            'espessuras_chapas' => EspessurasChapas::all(),
            'blocos_brutos' => $this->getBlocosBrutos()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdemDeSerradasRequest $request)
    {
        $this->temAcesso('ordem_de_serradas', 'C');
        $data = $request->all();
        $ordemDeSerrada = OrdemDeSerradas::create($data);
        return redirect()->route('ordem-de-serradas.index')->with('status', 'Ordem de serrada cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdemDeSerradas  $ordemDeSerradas
     * @return \Illuminate\Http\Response
     */
    public function show(OrdemDeSerradas $ordemDeSerradas)
    {
        //
    }

    private function getBlocosBrutos()
    {
        return BlocosBrutos::whereNull('chapas_serradas_id')->
            whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('ordem_de_serradas')
                    ->whereRaw('ordem_de_serradas.blocos_brutos_id = blocos_brutos.id');
            });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdemDeSerradas  $ordemDeSerradas
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdemDeSerradas $ordem_de_serrada)
    {
        $this->temAcesso('ordem_de_serradas', 'A');
        return view('pages.ordemdeserradas.edit', [
            'ordem_de_serrada' => $ordem_de_serrada,
            'espessuras_chapas' => EspessurasChapas::all(),
            'blocos_brutos' => $this->getBlocosBrutos()->orWhere('blocos_brutos.id', $ordem_de_serrada->blocos_brutos_id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdemDeSerradas  $ordemDeSerradas
     * @return \Illuminate\Http\Response
     */
    public function update(OrdemDeSerradasRequest $request, OrdemDeSerradas $ordem_de_serrada)
    {
        $this->temAcesso('ordem_de_serradas', 'A');
        $data = $request->all();
        $ordem_de_serrada->update($data);
        return redirect()->route('ordem-de-serradas.index')->with('status', 'Ordem de serrada alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdemDeSerradas  $ordemDeSerradas
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdemDeSerradas $ordem_de_serrada)
    {
        $this->temAcesso('ordem_de_serradas', 'E');
        if ($ordem_de_serrada->chapas_serradas_id)
            return redirect()->route('ordem-de-serradas.index')->with('error', 'Esta ordem de serrada não pode ser excluída, pois já foi processada');
        $ordem_de_serrada->delete();
        return redirect()->route('ordem-de-serradas.index')->with('status', 'Ordem de serrada excluída com sucesso');
    }

    public function executar()
    {
        $this->temAcesso('executar_ordem_de_serradas');
        $ordem_de_serradas = OrdemDeSerradas::whereNull('chapas_serradas_id')->orderBy('id')->get();
        return view('pages.ordemdeserradas.executar.index', ['ordem_de_serradas' => $ordem_de_serradas]);
    }

}
