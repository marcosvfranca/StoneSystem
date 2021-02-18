<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacoesChapasSerradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacoes_chapas_serradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapas_serradas_id');
            $table->unsignedBigInteger('observacoes_chapas_id');
            $table->foreign('chapas_serradas_id')->references('id')->on('chapas_serradas');
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
        Schema::dropIfExists('observacoes_chapas_serradas');
    }
}
