<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosChapas extends Model
{
    protected $fillable = [
        'descricao'
    ];

    public function chapas()
    {
        return $this->belongsToMany(ChapasBlocos::class);
    }
}
