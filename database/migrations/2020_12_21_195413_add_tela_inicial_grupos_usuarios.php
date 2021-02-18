<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTelaInicialGruposUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupos_usuarios', function(Blueprint $table) {
            $table->unsignedBigInteger('telas_iniciais_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupos_usuarios', function(Blueprint $table) {
            $table->dropColumn('telas_iniciais_id');
        });
    }
}
