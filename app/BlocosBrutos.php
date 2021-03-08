<?php

namespace App;

use App\BaseModel;

class BlocosBrutos extends BaseModel
{
    protected $fillable = [
        'numeracao_pedreira', 'nosso_numero', 'comprimento_bruto', 'altura_bruta', 'largura_bruta',
        'comprimento_liquido', 'altura_liquida', 'largura_liquida', 'origem', 'nf_chegada', 'dt_nf_chegada',
        'nf_compra', 'dt_nf_compra', 'transportadores_id', 'tipos_blocos_id', 'classificacoes_blocos_id',
        'fornecedores_id', 'chapas_serradas_id'
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

    public function getCubagemBruta($format = false)
    {
        return $format ? number_format($this->comprimento_bruto * $this->altura_bruta * $this->largura_bruta, 2, ',', '.') : $this->comprimento_bruto * $this->altura_bruta * $this->largura_bruta;
    }

    public function getCubagemLiquida($format = false)
    {
        return $format ? number_format($this->comprimento_liquido * $this->altura_liquida * $this->largura_liquida, 2, ',', '.') : $this->comprimento_liquido * $this->altura_liquida * $this->largura_liquida;
    }

    public function getOrigemFormated()
    {
        return $this->origem == 'P' ? 'Próprio' : 'Terceiros';
    }
}
