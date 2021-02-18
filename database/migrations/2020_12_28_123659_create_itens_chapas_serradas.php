<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensChapasSerradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_chapas_serradas', function (Blueprint $table) {
            $table->id();
            $table->integer('qtd');
            $table->string('comprimento');
            $table->string('altura');
            $table->unsignedBigInteger('espessuras_chapas_id');
            $table->foreign('espessuras_chapas_id')->on('espessuras_chapas')->references('id');
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
        Schema::dropIfExists('itens_chapas_serradas');
    }
}
