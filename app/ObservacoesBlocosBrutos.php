<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacoesBlocosBrutos extends Model
{
    protected $fillable = [
        'blocos_brutos_id', 'observacoes_chapas_id'
    ];
}
