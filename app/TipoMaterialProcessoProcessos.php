<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMaterialProcessoProcessos extends Model
{
    protected $fillable = [
        'tipo_material_processos_id', 'processos_id'
    ];

    public function processo()
    {
        return $this->hasMany(Processo::class);
    }

    public function tipoMaterialProcessos()
    {
        return $this->hasMany(TipoMaterialProcesso::class);
    }

}
