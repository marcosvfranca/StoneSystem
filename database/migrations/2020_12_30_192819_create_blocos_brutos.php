<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocosBrutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocos_brutos', function (Blueprint $table) {
            $table->id();
            $table->string('numeracao');
            $table->float('comprimento');
            $table->float('altura');
            $table->float('largura');
            $table->unsignedBigInteger('transportadores_id');
            $table->unsignedBigInteger('tipos_blocos_id');
            $table->unsignedBigInteger('classificacoes_blocos_id');
            $table->unsignedBigInteger('fornecedores_id');
            $table->foreign('transportadores_id')->on('transportadores')->references('id');
            $table->foreign('tipos_blocos_id')->on('tipos_blocos')->references('id');
            $table->foreign('classificacoes_blocos_id')->on('classificacoes_blocos')->references('id');
            $table->foreign('fornecedores_id')->on('fornecedores')->references('id');
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
        Schema::dropIfExists('blocos_brutos');
    }
}
