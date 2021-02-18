<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterItensChapasAddNumeracao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itens_chapas_serradas', function (Blueprint $table) {
            $table->dropColumn('qtd');
            $table->string('numeracao');
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
            $table->integer('qtd');
            $table->dropColumn('numeracao');
        });
    }
}
