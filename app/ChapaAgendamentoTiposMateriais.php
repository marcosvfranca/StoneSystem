<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapaAgendamentoTiposMateriais extends Model
{
    protected $fillable = [
        'chapa_bloco_agendamento_processo_id',
        'tipo_material_processo_id'
    ];
}
