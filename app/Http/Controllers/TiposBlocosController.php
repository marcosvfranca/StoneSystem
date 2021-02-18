<?php

namespace App\Http\Controllers;

use App\Http\Requests\TiposBlocosRequest;
use App\Http\Requests\TransportadoresRequest;
use App\TiposBlocos;
use App\Transportadores;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class TiposBlocosController extends Controller
{
    public function rindex()
    {
        return redirect('tiposblocos');
    }

    public function index()
    {
        $this->temAcesso('tipos-blocos');
        return view('pages.tiposblocos.index', ['tiposblocos' => TiposBlocos::all()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $tiposblocos = TiposBlocos::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $tiposblocos
                ->where('descricao', 'like', '%' . $data['q'] . '%');
        return view('pages.tiposblocos.table', ['tiposblocos' => $tiposblocos->get()]);
    }

    public function cadastrar()
    {
        $this->temAcesso('tipos-blocos', 'I');
        return view('pages.tiposblocos.cadastrar');
    }

    public function editar($id)
    {
        return view('pages.tiposblocos.alterar', ['tipobloco' => TiposBlocos::findOrFail($id)]);
     }

    public function deletar($id)
    {
        $tiposblocos = TiposBlocos::findOrFail($id);
        if ($tiposblocos->blocos()->count())
            flash('Existem ' . $tiposblocos->blocos()->count() . ' blocos associados a esta classificação de bloco. Não será possível excluir')->error()->important();
        else
            $tiposblocos->delete();
        return $this->rindex();
    }

    public function inserir(TiposBlocosRequest $request)
    {
        $data = $request->all();
        TiposBlocos::create($data);
        return $this->rindex();
    }

    public function alterar(TiposBlocosRequest $request, $id)
    {
        $data = $request->all();
        $tiposblocos = TiposBlocos::findOrFail($id);
        $tiposblocos->update($data);
        return $this->rindex();
    }

}
