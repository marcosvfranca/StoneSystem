<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapaAgendamentoTiposMateriais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapa_agendamento_tipos_materiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapa_bloco_agendamento_processo_id');
            $table->unsignedBigInteger('tipo_material_processo_id');
            $table->foreign('chapa_bloco_agendamento_processo_id', 'fk_catm_cbap_id')->on('chapa_bloco_agendamento_processos')->references('id');
            $table->foreign('tipo_material_processo_id', 'fk_catm_tmp_id')->on('tipo_material_processos')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapa_agendamento_tipos_materiais');
    }
}
