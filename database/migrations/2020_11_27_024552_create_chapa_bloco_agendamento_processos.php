<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapaBlocoAgendamentoProcessos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapa_bloco_agendamento_processos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agendamento_processo_id');
            $table->unsignedBigInteger('chapas_bloco_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('concluido', ['S', 'N'])->nullable();
            $table->unsignedBigInteger('motivo_cancelamento_id')->nullable();
            $table->enum('cancelado', ['S', 'N'])->default('N');
            $table->unsignedBigInteger('motivo_nao_conclusao_processo_id')->nullable();
            $table->foreign('agendamento_processo_id', 'fk_cbap_processo_id')->on('agendamento_processos')->references('id');
            $table->foreign('chapas_bloco_id', 'fk_cbap_chapas_bloco_id')->on('chapas_blocos')->references('id');
            $table->foreign('motivo_cancelamento_id', 'fk_cbap_motivo_cancelamento_id')->on('motivos')->references('id');
            $table->foreign('motivo_nao_conclusao_processo_id', 'fk_cbap_motivo_nao_conclusao_id')->on('motivos')->references('id');
            $table->foreign('user_id', 'fk_cbap_user_id')->on('users')->references('id');
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
        Schema::dropIfExists('chapa_bloco_agendamento_processos');
    }
}
