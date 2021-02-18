<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocos', function (Blueprint $table) {
            $table->id();
            $table->string('numeracao');
            $table->unsignedBigInteger('transportadores_id');
            $table->unsignedBigInteger('tipos_blocos_id');
            $table->foreign('transportadores_id')->references('id')->on('transportadores');
            $table->foreign('tipos_blocos_id')->references('id')->on('tipos_blocos');
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
        Schema::dropIfExists('blocos');
    }
}
