<?php

namespace App\Http\Controllers;

use App\Fornecedores;
use App\Http\Requests\FornecedoresRequest;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('fornecedores');
        return view('pages.fornecedores.index', ['fornecedores' => Fornecedores::limit(100)->get()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $fornecedores = Fornecedores::whereRaw('1 = 1');
        if(isset($data['q']))
            $fornecedores->where('nome', 'like', "%{$data['q']}%");
        return view('pages.fornecedores.table', ['fornecedores' => $fornecedores->limit(100)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('fornecedores', 'C');
        return view('pages.fornecedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedoresRequest $request)
    {
        $data = $request->all();
        $fornecedor = Fornecedores::create($data);
        return redirect()->route('fornecedores.index')->with('status', 'Fornecedor cadastrado com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fornecedores  $fornecedores
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedores $fornecedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fornecedores  $fornecedores
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedores $fornecedore)
    {
        $this->temAcesso('fornecedores', 'A');
        return view('pages.fornecedores.edit', ['fornecedor' => $fornecedore]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fornecedores  $fornecedores
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedoresRequest $request, Fornecedores $fornecedore)
    {
        $this->temAcesso('fornecedores', 'A');
        $fornecedore->update($request->all());
        return redirect()->route('fornecedores.index')->with('status', 'Fornecedor alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fornecedores  $fornecedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedores $fornecedore)
    {
        $this->temAcesso('fornecedores', 'E');
        if ($fornecedore->blocosBrutos())
            return redirect()->route('fornecedores.index')->with('error', 'Existem blocos associados a este fornecedor, não será possível excluir');
        $fornecedore->delete();
        return redirect()->route('fornecedores.index')->with('status', 'Fornecedor excluído com sucesso');
    }

}
