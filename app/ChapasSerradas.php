<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapasSerradas extends Model
{

    protected $fillable = [
        'numeracao', 'tipos_blocos_id', 'observacoes'
    ];

    public function tiposBlocos()
    {
        return $this->belongsTo(TiposBlocos::class);
    }

    public function chapas()
    {
        return $this->hasMany(ItensChapasSerrada::class);
    }

    public function observacoes()
    {
        return $this->hasMany(ObservacoesChapasSerrada::class);
    }

    public function deletar()
    {
        ItensChapasSerrada::where('chapas_serradas_id', $this->id)->delete();
        ObservacoesChapasSerrada::where('chapas_serradas_id', $this->id)->delete();
        OrdemDeSerradas::where('chapas_serradas_id', $this->id)->update(['chapas_serradas_id' => null, 'user_id' => null]);
        BlocosBrutos::where('chapas_serradas_id', $this->id)->update(['chapas_serradas_id' => null]);
        return $this->delete();
    }

    public function ordemDeSerrada()
    {
        return $this->hasMany(OrdemDeSerradas::class);
    }
}
