<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChapaBlocoAgendamentoProcesso extends Model
{

    protected $fillable = [
        'agendamento_processo_id', 'chapas_bloco_id', 'user_id', 'concluido', 'cancelado', 'motivo_cancelamento_id', 'motivo_nao_conclusao_processo_id',
    ];

    public function chapa()
    {
        return $this->belongsToMany(ChapasBlocos::class, 'chapa_bloco_agendamento_processos', 'id', 'chapas_bloco_id')->first();
    }

    public function tiposMateriais()
    {
        return $this->belongsToMany(TipoMaterialProcesso::class, 'chapa_agendamento_tipos_materiais');
    }

    public function deletar()
    {
        DB::table('chapa_agendamento_tipos_materiais')->where('chapa_bloco_agendamento_processo_id', $this->id)->delete();
        $this->delete();
        return true;
    }

}
