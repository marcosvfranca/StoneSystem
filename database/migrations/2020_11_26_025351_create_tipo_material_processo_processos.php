<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMaterialProcessoProcessos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_material_processo_processos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_material_processos_id');
            $table->unsignedBigInteger('processos_id');
            $table->foreign('tipo_material_processos_id', 'fk_processos_tipo_material_processos')->on('tipo_material_processos')->references('id');
            $table->foreign('processos_id')->on('processos')->references('id');
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
        Schema::dropIfExists('tipo_material_processo_processos');
    }
}
