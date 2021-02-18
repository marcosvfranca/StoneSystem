<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{

    protected $fillable = [
        'nome'
    ];

    public function blocosBrutos()
    {
        $this->belongsTo(BlocosBrutos::class);
    }

}
