<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMaterialProcesso extends Model
{
    protected $fillable = [
        'tipo'
    ];

    public function processos()
    {
        return $this->belongsToMany(TipoMaterialProcessoProcessos::class);
    }

    public function chapaAgendamentoProcessos()
    {
        return $this->belongsToMany(TipoMaterialChapaAgendamentoProcesso::class);
    }
}
