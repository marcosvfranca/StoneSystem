<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspessurasChapas extends Model
{
    protected $fillable = [
        'descricao', 'cor', 'cor_fonte'
    ];

    public function chapas()
    {
        return $this->hasMany(ChapasBlocos::class);
    }
}
