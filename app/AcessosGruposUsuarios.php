<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcessosGruposUsuarios extends Model
{
    protected $fillable = [
        'grupos_usuarios_id', 'acessos_id', 'inserir', 'alterar', 'excluir'
    ];
}
