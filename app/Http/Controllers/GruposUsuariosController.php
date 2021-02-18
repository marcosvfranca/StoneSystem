<?php

namespace App\Http\Controllers;

use App\AcessosGruposUsuarios;
use App\GruposUsuarios;
use App\Http\Requests\GruposUsuariosRequest;
use App\TelasIniciais;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class GruposUsuariosController extends Controller
{

    public function index()
    {
        $this->temAcesso('gruposusuarios');
        $gruposUsuarios = $this->retornaClassePaginada(new GruposUsuarios());
        return view('pages.gruposusuarios.index', ['gruposusuarios' => $gruposUsuarios]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $gruposUsuarios = GruposUsuarios::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $gruposUsuarios->where('nome', 'like', '%' . $data['q'] . '%');
        return view('pages.gruposusuarios.table', ['gruposusuarios' => $gruposUsuarios->get()]);
    }

    public function cadastrar()
    {
        $this->temAcesso('gruposusuarios', 'I');
        return view('pages.gruposusuarios.cadastrar', ['telas_iniciais' => TelasIniciais::all()]);
    }

    public function editar($id)
    {
        return view('pages.gruposusuarios.alterar', ['gruposusuarios' => GruposUsuarios::findOrFail($id), 'telas_iniciais' => TelasIniciais::all()]);
    }

    public function deletar($id)
    {
        $grupousuario = GruposUsuarios::findOrFail($id);
        $qtdUsuarios = $grupousuario->usuarios()->count();
        if ($qtdUsuarios)
            flash('Não será possível excluir este grupo de usuário!<br>Existe' . ($qtdUsuarios == 1 ? '' : 'm') . ' ' . $qtdUsuarios . ' usuário' . ($qtdUsuarios == 1 ? '' : 's') . ' associado' . ($qtdUsuarios == 1 ? '' : 's') . ' a este grupo.')->error();
        else
            $grupousuario->delete();
        return $this->rindex();
    }

    public function inserir(GruposUsuariosRequest $request)
    {
        $data = $request->all();
        GruposUsuarios::create($data);
        return $this->rindex();
    }

    public function alterar(GruposUsuariosRequest $request, $id)
    {
        $data = $request->all();
        $grupousuario = GruposUsuarios::findOrFail($id);
        $grupousuario->update($data);
        return $this->rindex();
    }

    public function acessosDisponiveis($id)
    {
        $grupoUsuario = GruposUsuarios::findOrFail($id);
        $acessos = $grupoUsuario->acessosDisponiveis();
        return view('pages.gruposusuarios.acessos', ['acessos' => $acessos, 'grupousuario_id' => $id]);
    }

    public function acessosGruposUsuarios($id)
    {
        $grupoUsuario = GruposUsuarios::findOrFail($id);
        $acessos = $grupoUsuario->acessosGruposUsuarios();
        return view('pages.gruposusuarios.acessosgruposusuarios', ['acessos' => $acessos]);
    }

    public function liberarAcesso(Request $r)
    {
        $data = $r->all();
        $data['grupos_usuarios_id'] = $data['id-grupo'];
        $data['acessos_id'] = $data['id-acesso'];
        AcessosGruposUsuarios::create($data);
    }

    public function removeAcesso(Request $r)
    {
        $data = $r->all();
        $acessos_grupos_usuarios_id = $r['id'];
        $acesso = AcessosGruposUsuarios::findOrFail($acessos_grupos_usuarios_id);
        $acesso->delete();
    }
}
