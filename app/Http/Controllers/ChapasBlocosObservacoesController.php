<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapasBlocosObservacoesRequest;
use App\ObservacoesChapas;

class ChapasBlocosObservacoesController extends Controller
{
    public function index()
    {
        $this->temAcesso('observacoes-chapas');
        return view('pages.observacoeschapas.index', ['observacoesChapas' => ObservacoesChapas::all()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $observacoesChapas = ObservacoesChapas::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $observacoesChapas
                ->where('descricao', 'like', '%' . $data['q'] . '%')
                ->orWhere('apelido', 'like', '%' . $data['q'] . '%');
        return view('pages.observacoeschapas.table', ['observacoesChapas' => $observacoesChapas->get()]);
    }

    public function create()
    {
        $this->temAcesso('observacoes-chapas', 'C');
        return view('pages.observacoeschapas.create');
    }

    public function store(ChapasBlocosObservacoesRequest $r)
    {
        $data = $r->all();
        ObservacoesChapas::create($data);
        flash('Observação de chapa cadastrada com sucesso')->success();
        return $this->rindex();
    }

    public function rindex()
    {
        return redirect()->route('observacoes-chapas.index');
    }

    public function destroy($observacoes_chapa)
    {
        $observacaoChapa = ObservacoesChapas::findOrFail($observacoes_chapa);
        if ($observacaoChapa->chapas()->count())
            flash('Existem ' . $observacaoChapa->chapas()->count() . ' chapas associadas a esta observação de chapa. Não será possível excluir')->error()->important();
        else
            $observacaoChapa->delete();
        return $this->rindex();
    }

    public function edit($observacoes_chapa)
    {
        $observacaoChapa = ObservacoesChapas::findOrFail($observacoes_chapa);
        return view('pages.observacoeschapas.edit', ['observacaoChapa' => $observacaoChapa]);
    }

    public function update(ChapasBlocosObservacoesRequest $r, $observacoes_chapa)
    {
        $data = $r->all();
        $observacaoChapa = ObservacoesChapas::findOrFail($observacoes_chapa);
        $observacaoChapa->update($data);
        return $this->rindex();
    }

}
