<?php

namespace App\Http\Controllers;

use App\Acessos;
use App\AcessosGruposUsuarios;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $arrAcessos = [
        'I' => 'inserir',
        'C' => 'inserir',
        'A' => 'alterar',
        'E' => 'excluir',
    ];

    public function temAcesso($apelido, $tipo = null)
    {
        $grupoUsuario = auth()->user()->grupoUsuario()->first();

        if ($grupoUsuario->admin == 'S')
            return true;

        $acesso = Acessos::where(['apelido' => $apelido])->first();

        if (!$acesso)
            return $this->semAcesso();

        $acessoGrupoUsuario = AcessosGruposUsuarios::where([
            'grupos_usuarios_id' => $grupoUsuario->id,
            'acessos_id' => $acesso->id
        ])->first();

        if ($acessoGrupoUsuario == null)
            return $this->semAcesso();

        if (!$tipo) {
            foreach ($this->arrAcessos as $chave => $valor) {
                $this->arrAcessos[$chave] = $acessoGrupoUsuario->{$valor};
            }
            return $this->arrAcessos;
        } else
            return (isset($this->arrAcessos[$tipo]) and $acessoGrupoUsuario->{$this->arrAcessos[$tipo]} == 'S');
    }

    public function semAcesso()
    {
//        return redirect()->route('sem-acesso');
//        throw new \Exception('Você não possui acesso a essa página, contate o administrador do sistema');
    }

    public function rindex()
    {
        $explode = explode('\\', get_called_class());
        $className = $explode[count($explode) - 1];
        $route = strtolower(str_ireplace('Controller', '', $className));
        return redirect()->route($route);
    }

    public function retornaClassePaginada($class, $qtdPaginas = 15, $except = 'page')
    {
        return $class->paginate($qtdPaginas)->append(request()->except('page'));
    }

    public function decryptToken($token)
    {
        try {
            return decrypt($token);
        } catch (DecryptException $e) {
            flash('Erro ao descriptografar token')->error();
            return $this->rindex();
        }
    }

}
