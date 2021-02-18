<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapasSerradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapas_serradas', function (Blueprint $table) {
            $table->id();
            $table->string('numeracao');
            $table->integer('qtd_chapas');
            $table->string('comprimento');
            $table->string('altura');
            $table->unsignedBigInteger('tipos_blocos_id');
            $table->unsignedBigInteger('espessuras_chapas_id');
            $table->foreign('tipos_blocos_id')->on('tipos_blocos')->references('id');
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
        Schema::dropIfExists('chapas_serradas');
    }
}
