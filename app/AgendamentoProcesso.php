<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendamentoProcesso extends Model
{
    protected $fillable = [
        'grupos_usuario_id', 'processo_id', 'observacoes', 'liberado'
    ];

    public function grupoUsuario()
    {
        return $this->belongsToMany(GruposUsuarios::class, 'agendamento_processos', 'id', 'grupos_usuario_id');
    }

    public function processo()
    {
        return $this->belongsToMany(Processo::class, 'agendamento_processos', 'id');
    }

    public function chapas()
    {
        return $this->belongsTo(ChapaBlocoAgendamentoProcesso::class, 'id', 'agendamento_processo_id');
    }

    public function deletar()
    {
        foreach (ChapaBlocoAgendamentoProcesso::where('agendamento_processo_id', $this->id)->get() as $c)
            $c->deletar();
        $this->delete();
        return true;
    }

}
