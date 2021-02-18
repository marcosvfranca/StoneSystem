<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapasBlocosEstadosChapas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapas_blocos_estados_chapas', function (Blueprint $table) {
            $table->unsignedBigInteger('chapas_blocos_id');
            $table->unsignedBigInteger('estados_chapas_id');
            $table->foreign('chapas_blocos_id')->references('id')->on('chapas_blocos');
            $table->foreign('estados_chapas_id')->references('id')->on('estados_chapas');
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
        Schema::dropIfExists('chapas_blocos_estados_chapas');
    }
}
