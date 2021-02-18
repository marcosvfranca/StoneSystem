<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacoesChapasSerrada extends Model
{

    protected $fillable = [
        'chapas_serradas_id', 'observacoes_chapas_id'
    ];

    public function observacao()
    {
        return $this->hasMany(ObservacoesChapas::class, 'id', 'observacoes_chapas_id');
    }
}
