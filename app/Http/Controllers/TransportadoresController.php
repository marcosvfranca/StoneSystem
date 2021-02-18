<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransportadoresRequest;
use App\Transportadores;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class TransportadoresController extends Controller
{
    public function rindex()
    {
        return redirect('transportadores');
    }

    public function index()
    {
        $this->temAcesso('transportadores');
        return view('pages.transportadores.index', ['transportadores' => Transportadores::all()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $transportadores = Transportadores::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q']) {
            $transportadores
                ->where('nome', 'like', "%{$data['q']}%")
                ->orWhere('placa', 'like', "%{$data['q']}%");
        }
        return view('pages.transportadores.table', ['transportadores' => $transportadores->get()]);
    }

    public function cadastrar()
    {
        $this->temAcesso('transportadores', 'I');
        return view('pages.transportadores.cadastrar');
    }

    public function editar($id)
    {
        return view('pages.transportadores.alterar', ['transportador' => Transportadores::findOrFail($id)]);
    }

    public function deletar($id)
    {
        $transportador = Transportadores::findOrFail($id);
        if ($transportador->blocos()->count())
            flash('Existem ' . $transportador->blocos()->count() . ' blocos associados a este transportador. Não será possível excluir')->error()->important();
        else
            $transportador->delete();
        return $this->rindex();
    }

    public function inserir(TransportadoresRequest $request)
    {
        $data = $request->all();
        Transportadores::create($data);
        return $this->rindex();
    }

    public function alterar(TransportadoresRequest $request, $id)
    {
        $data = $request->all();
        $transportador = Transportadores::findOrFail($id);
        $transportador->update($data);
        return $this->rindex();
    }

}
