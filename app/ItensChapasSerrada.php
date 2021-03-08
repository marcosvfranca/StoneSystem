<?php

namespace App;

use App\BaseModel;

class ItensChapasSerrada extends BaseModel
{
    protected $fillable = [
        'chapas_serradas_id', 'numeracao', 'comprimento', 'altura', 'espessuras_chapas_id', 'chapas_bloco_id'
    ];

    public function espessura()
    {
        return $this->hasMany(EspessurasChapas::class, 'id', 'espessuras_chapas_id');
    }

}
