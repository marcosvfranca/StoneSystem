<?php

namespace App\Http\Controllers;

use App\ClassificacoesBlocos;
use App\Http\Requests\ClassificacoesBlocosRequest;
use Illuminate\Http\Request;

class ClassificacoesBlocosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->temAcesso('classificacoes_blocos');
        return view('pages.classificacoesblocos.index', ['classificacoes' => ClassificacoesBlocos::limit(100)->get()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $classificacoes = ClassificacoesBlocos::whereRaw('1 = 1');
        if(isset($data['q']))
            $classificacoes->where('descricao', 'like', "%{$data['q']}%");
        return view('pages.classificacoesblocos.table', ['classificacoes' => $classificacoes->limit(100)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->temAcesso('classificacoes_blocos', 'C');
        return view('pages.classificacoesblocos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassificacoesBlocosRequest $request)
    {
        $data = $request->all();
        $classificacao = ClassificacoesBlocos::create($data);
        return redirect()->route('classificacoes-blocos.index')->with('status', 'Classificação de bloco cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassificacoesBlocos  $classificacoesBlocos
     * @return \Illuminate\Http\Response
     */
    public function show(ClassificacoesBlocos $classificacoesBlocos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassificacoesBlocos  $classificacoesBlocos
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassificacoesBlocos $classificacoes_bloco)
    {
        $this->temAcesso('classificacoes_blocos', 'A');
        return view('pages.classificacoesblocos.edit', ['classificacao' => $classificacoes_bloco]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassificacoesBlocos  $classificacoesBlocos
     * @return \Illuminate\Http\Response
     */
    public function update(ClassificacoesBlocosRequest $request, ClassificacoesBlocos $classificacoes_bloco)
    {
        $this->temAcesso('classificacoes_blocos', 'A');
        $classificacoes_bloco->update($request->all());
        return redirect()->route('classificacoes-blocos.index')->with('status', 'Classificação de bloco alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassificacoesBlocos  $classificacoesBlocos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassificacoesBlocos $classificacoes_bloco)
    {
        $this->temAcesso('classificacoes_blocos', 'E');
        if ($classificacoes_bloco->blocosBrutos())
            return redirect()->route('classificacoes-blocos.index')->with('error', 'Existem blocos associados a esta classificação, não será possível excluir');
        $classificacoes_bloco->delete();
        return redirect()->route('classificacoes-blocos.index')->with('status', 'Classificação de bloco excluída com sucesso');
    }
}
