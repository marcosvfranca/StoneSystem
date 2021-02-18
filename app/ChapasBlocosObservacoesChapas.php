<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapasBlocosObservacoesChapas extends Model
{
    protected $fillable = [
        'chapas_blocos_id', 'observacoes_chapas_id'
    ];

    public function chapas()
    {
        return $this->belongsToMany(ChapasBlocos::class);
    }
}
