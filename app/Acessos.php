<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acessos extends Model
{
    protected $fillable = [
        'nome', 'unico', 'apelido', 'ativo'
    ];

}
