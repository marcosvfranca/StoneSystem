<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GruposUsuarios extends Model
{
    protected $fillable = [
        'nome', 'admin', 'telas_iniciais_id'
    ];

    public function acessos()
    {
        return $this->belongsToMany(Acessos::class);
    }

    public function acessosGruposUsuarios()
    {
        return DB::select('select acessos_grupos_usuarios.id, acessos.nome, acessos.unico, acessos_grupos_usuarios.inserir, acessos_grupos_usuarios.alterar, acessos_grupos_usuarios.excluir from acessos inner join acessos_grupos_usuarios on acessos_grupos_usuarios.acessos_id = acessos.id where acessos.id = acessos_grupos_usuarios.acessos_id and acessos_grupos_usuarios.grupos_usuarios_id = ?', [$this->id]);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function acessosDisponiveis()
    {
        return DB::select('select * from acessos where not exists (select * from acessos_grupos_usuarios where acessos.id = acessos_grupos_usuarios.acessos_id and acessos_grupos_usuarios.grupos_usuarios_id = ?)', [$this->id]);
    }

    public function getTelaInicial()
    {
        return $this->belongsToMany(TelasIniciais::class, 'grupos_usuarios', 'id');
    }

}
