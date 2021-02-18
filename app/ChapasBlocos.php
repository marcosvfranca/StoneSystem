<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapasBlocos extends Model
{
    protected $fillable = [
        'comprimento', 'largura', 'numeracao', 'blocos_id', 'espessuras_chapas_id'
    ];

    public function espessura()
    {
        return $this->hasMany(EspessurasChapas::class, 'id', 'espessuras_chapas_id');
    }

    public function observacoes()
    {
        return $this->belongsToMany(ObservacoesChapas::class);
    }

    public function estados()
    {
        return $this->belongsToMany(EstadosChapas::class);
    }

    public function apagar()
    {
        ChapasBlocosEstadosChapas::where('chapas_blocos_id', $this->id)->delete();
        ChapasBlocosObservacoesChapas::where('chapas_blocos_id', $this->id)->delete();
        ItensChapasSerrada::where('chapas_bloco_id', $this->id)->update(['chapas_bloco_id' => null]);
        $this->delete();
    }

    public function bloco()
    {
        return $this->hasMany(Blocos::class, 'id', 'blocos_id');
    }
}
