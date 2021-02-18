<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $fillable = ['nome', 'exige_material', 'ultimo_processo', 'selecionar_materiais'];

    public function tipoMaterialProcessos()
    {
        return $this->belongsToMany(TipoMaterialProcesso::class, 'tipo_material_processo_processos', 'processos_id', 'tipo_material_processos_id');
    }

    public function update(array $attributes = [], array $options = [])
    {
        if (! $this->exists) {
            return false;
        }
        foreach ($this->tipoMaterialProcessos()->select('tipo_material_processo_processos.id')->get() as $t) {
            $material = TipoMaterialProcessoProcessos::where('id', $t->id);
            if ($material)
                $material->delete();
        }
        foreach ($attributes['tipo_material_processos'] ?? [] as $d)
            TipoMaterialProcessoProcessos::create(['processos_id' => $this->id, 'tipo_material_processos_id' => $d]);
        return $this->fill($attributes)->save($options);
    }

}
