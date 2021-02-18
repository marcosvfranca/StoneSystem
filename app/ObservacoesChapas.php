<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacoesChapas extends Model
{
    protected $fillable = [
        'descricao', 'apelido'
    ];

    public function chapas()
    {
        return $this->belongsToMany(ChapasBlocos::class);
    }
}
