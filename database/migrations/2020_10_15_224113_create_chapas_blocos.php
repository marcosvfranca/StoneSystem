<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapasBlocos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapas_blocos', function (Blueprint $table) {
            $table->id();
            $table->string('comprimento');
            $table->string('largura');
            $table->string('numeracao');
            $table->unsignedBigInteger('blocos_id');
            $table->unsignedBigInteger('espessuras_chapas_id');
            $table->foreign('blocos_id')->references('id')->on('blocos');
            $table->foreign('espessuras_chapas_id')->references('id')->on('espessuras_chapas');
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
        Schema::dropIfExists('chapas_blocos');
    }
}
