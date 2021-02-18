<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChapaSerradaIdItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itens_chapas_serradas', function (Blueprint $table) {
            $table->unsignedBigInteger('chapas_serradas_id')->after('id');
            $table->foreign('chapas_serradas_id')->on('chapas_serradas')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itens_chapas_serradas', function (Blueprint $table) {
            $table->drop('chapas_serradas_id');
        });
    }
}
