<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemDeSerradas extends Model
{
    protected $fillable = [
        'blocos_brutos_id', 'espessuras_chapas_id', 'observacoes', 'chapas_serradas_id', 'user_id'
    ];

    public function blocoBruto()
    {
        return $this->hasMany(BlocosBrutos::class, 'id', 'blocos_brutos_id');
    }

    public function espessura()
    {
        return $this->hasMany(EspessurasChapas::class, 'id', 'espessuras_chapas_id');
    }

    public function chapasSerrada()
    {
        return $this->hasMany(ChapasSerradas::class, 'id', 'chapas_serradas_id');
    }

}
