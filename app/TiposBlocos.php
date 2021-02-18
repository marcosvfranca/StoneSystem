<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposBlocos extends Model
{
    protected $fillable = [
        'descricao'
    ];

    public function blocos()
    {
        return $this->hasMany(Blocos::class);
    }

    public function itensTiposBlocos()
    {
        return $this->hasMany(ItensTiposBlocos::class);
    }
}
