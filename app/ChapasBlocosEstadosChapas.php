<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapasBlocosEstadosChapas extends Model
{
    protected $fillable = [
        'chapas_blocos_id', 'estados_chapas_id'
    ];
}
