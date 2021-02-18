<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportadores extends Model
{
    protected $fillable = [
        'nome', 'placa'
    ];

    public function blocos()
    {
        return $this->hasMany(Blocos::class);
    }

}
