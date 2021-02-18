<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassificacoesBlocos extends Model
{
    protected $fillable = [
        'descricao'
    ];

    public function blocosBrutos()
    {
        $this->belongsTo(BlocosBrutos::class);
    }

}
