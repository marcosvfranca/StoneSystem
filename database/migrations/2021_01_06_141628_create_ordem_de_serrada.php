<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemDeSerrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_de_serradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blocos_brutos_id');
            $table->unsignedBigInteger('espessuras_chapas_id');
            $table->unsignedBigInteger('chapas_serradas_id')->nullable();
            $table->text('observacoes')->nullable();
            $table->foreign('blocos_brutos_id')->on('blocos_brutos')->references('id');
            $table->foreign('espessuras_chapas_id')->on('espessuras_chapas')->references('id');
            $table->foreign('chapas_serradas_id')->on('chapas_serradas')->references('id');
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
        Schema::dropIfExists('ordem_de_serradas');
    }
}
