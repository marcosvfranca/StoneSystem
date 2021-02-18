<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacoesBlocosBrutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacoes_blocos_brutos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blocos_brutos_id');
            $table->unsignedBigInteger('observacoes_chapas_id');
            $table->foreign('blocos_brutos_id')->on('blocos_brutos')->references('id');
            $table->foreign('observacoes_chapas_id')->on('observacoes_chapas')->references('id');
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
        Schema::dropIfExists('observacoes_blocos_brutos');
    }
}
