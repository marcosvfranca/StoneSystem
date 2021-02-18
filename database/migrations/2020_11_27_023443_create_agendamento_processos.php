<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentoProcessos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_processos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupos_usuario_id')->nullable();
            $table->unsignedBigInteger('processo_id')->nullable();
            $table->string('observacoes')->nullable();
            $table->foreign('grupos_usuario_id')->on('grupos_usuarios')->references('id');
            $table->foreign('processo_id')->on('processos')->references('id');
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
        Schema::dropIfExists('agendamento_processos');
    }
}
