<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcessosGruposUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acessos_grupos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupos_usuarios_id');
            $table->unsignedBigInteger('acessos_id');
            $table->enum('inserir', ['S', 'N'])->default('S')->nullable(false);
            $table->enum('alterar', ['S', 'N'])->default('S')->nullable(false);
            $table->enum('excluir', ['S', 'N'])->default('S')->nullable(false);
            $table->timestamps();
            $table->foreign('grupos_usuarios_id')->references('id')->on('grupos_usuarios');
            $table->foreign('acessos_id')->references('id')->on('acessos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acessos_grupos_usuarios');
    }
}
