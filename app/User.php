<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'grupos_usuarios_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private $arrAcessos = [
        'I' => 'inserir',
        'C' => 'inserir',
        'A' => 'alterar',
        'E' => 'excluir',
    ];

    public function grupoUsuario()
    {
        return $this->belongsToMany(GruposUsuarios::class, 'users', 'id');
    }

    public function temAcessoUnico($apelido_acesso, $tipo = false)
    {
        $id_user = Auth::id();

        $qAdm = DB::table('users')
            ->join('grupos_usuarios', 'grupos_usuarios.id', '=', 'users.grupos_usuarios_id')
            ->select('admin')
            ->where(['users.id' => $id_user])
            ->first();

        if ($qAdm->admin == 'S')
            return true;

        if (is_array($apelido_acesso)) {
            foreach ($apelido_acesso as $a) {
                $q = DB::table('users')
                    ->join('grupos_usuarios', 'grupos_usuarios.id', '=', 'users.grupos_usuarios_id')
                    ->join('acessos_grupos_usuarios', 'acessos_grupos_usuarios.grupos_usuarios_id', '=', 'grupos_usuarios.id')
                    ->join('acessos', 'acessos.id', '=', 'acessos_grupos_usuarios.acessos_id')
                    ->select('admin', 'acessos_grupos_usuarios.id', 'inserir', 'alterar', 'excluir')
                    ->where(['acessos.apelido' => $a, 'users.id' => $id_user])
                    ->first();

                if ($q)
                    return true;
            }

            return false;
        }

        $q = DB::table('users')
            ->join('grupos_usuarios', 'grupos_usuarios.id', '=', 'users.grupos_usuarios_id')
            ->join('acessos_grupos_usuarios', 'acessos_grupos_usuarios.grupos_usuarios_id', '=', 'grupos_usuarios.id')
            ->join('acessos', 'acessos.id', '=', 'acessos_grupos_usuarios.acessos_id')
            ->select('admin', 'acessos_grupos_usuarios.id', 'inserir', 'alterar', 'excluir')
            ->where(['acessos.apelido' => $apelido_acesso, 'users.id' => $id_user])
            ->first();

        if (!$tipo)
            return ($q);

        if (!$q)
            return false;

        return ($q->{$this->arrAcessos[$tipo]} == 'S');
    }
}
