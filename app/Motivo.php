<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    protected $fillable = [
        'motivo'
    ];

    public function processos()
    {
        return $this->belongsToMany(Processo::class);
    }

}
