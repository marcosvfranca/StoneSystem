<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapasBlocosObservacoesChapas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapas_blocos_observacoes_chapas', function (Blueprint $table) {
            $table->unsignedBigInteger('chapas_blocos_id');
            $table->unsignedBigInteger('observacoes_chapas_id');
            $table->foreign('chapas_blocos_id')->references('id')->on('chapas_blocos');
            $table->foreign('observacoes_chapas_id')->references('id')->on('observacoes_chapas');
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
        Schema::dropIfExists('chapas_blocos_observacoes_chapas');
    }
}
