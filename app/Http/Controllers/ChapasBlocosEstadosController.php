<?php

namespace App\Http\Controllers;

use App\EstadosChapas;
use App\Http\Requests\ChapasBlocosEstadosRequest;
use Illuminate\Http\Request;

class ChapasBlocosEstadosController extends Controller
{
    public function index()
    {
        $this->temAcesso('estados-chapas');
        return view('pages.estadoschapas.index', ['estadosChapas' => EstadosChapas::all()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $estadosChapas = EstadosChapas::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $estadosChapas
                ->where('descricao', 'like', '%' . $data['q'] . '%');
        return view('pages.estadoschapas.table', ['estadosChapas' => $estadosChapas->get()]);
    }

    public function create()
    {
        $this->temAcesso('estados-chapas', 'C');
        return view('pages.estadoschapas.create');
    }

    public function store(ChapasBlocosEstadosRequest $r)
    {
        $data = $r->all();
        EstadosChapas::create($data);
        flash('Estado de chapa cadastrada com sucesso')->success();
        return $this->rindex();
    }

    public function rindex()
    {
        return redirect()->route('estados-chapas.index');
    }

    public function destroy($estados_chapa)
    {
        $estadoChapa = EstadosChapas::findOrFail($estados_chapa);
        if ($estadoChapa->chapas()->count())
            flash('Existem ' . $estadoChapa->chapas()->count() . ' chapas associadas a este estado de chapa. Não será possível excluir')->error()->important();
        else
            $estadoChapa->delete();
        return $this->rindex();
    }

    public function edit($estados_chapa)
    {
        $estadoChapa = EstadosChapas::findOrFail($estados_chapa);
        return view('pages.estadoschapas.edit', ['estadoChapa' => $estadoChapa]);
    }

    public function update(ChapasBlocosEstadosRequest $r, $estados_chapa)
    {
        $data = $r->all();
        $estadoChapa = EstadosChapas::findOrFail($estados_chapa);
        $estadoChapa->update($data);
        return $this->rindex();
    }

}
