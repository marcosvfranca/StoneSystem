<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blocos extends Model
{
    protected $fillable = [
        'numeracao', 'transportadores_id', 'tipos_blocos_id'
    ];

    public function transportadores()
    {
        return $this->belongsTo(Transportadores::class);
    }

    public function tiposBlocos()
    {
        return $this->belongsTo(TiposBlocos::class);
    }

    public function chapas()
    {
        return $this->hasMany(ChapasBlocos::class);
    }

    public function deletar()
    {
        $chapas = ChapasBlocos::where('blocos_id', $this->id)->get();
        if($chapas)
            foreach ($chapas as $c)
                $c->apagar();
        $this->delete();
    }

}
