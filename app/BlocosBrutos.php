<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlocosBrutos extends Model
{
    protected $fillable = [
        'numeracao', 'comprimento', 'altura', 'largura', 'transportadores_id', 'tipos_blocos_id', 'classificacoes_blocos_id', 'fornecedores_id', 'chapas_serradas_id'
    ];

    public function transportadores()
    {
        return $this->belongsTo(Transportadores::class);
    }

    public function tiposBlocos()
    {
        return $this->belongsTo(TiposBlocos::class);
    }

    public function classificacoes()
    {
        return $this->belongsTo(ClassificacoesBlocos::class, 'classificacoes_blocos_id');
    }

    public function fornecedores()
    {
        return $this->belongsTo(Fornecedores::class);
    }

    public function observacoes()
    {
        return $this->belongsToMany(ObservacoesChapas::class, 'observacoes_blocos_brutos', 'blocos_brutos_id', 'observacoes_chapas_id');
    }

}
