<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChapasBlocosAddIdItemSerrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itens_chapas_serradas', function (Blueprint $table) {
            $table->unsignedBigInteger('chapas_bloco_id')->nullable();
            $table->foreign('chapas_bloco_id')->on('chapas_blocos')->references('id')->onDelete('set null');
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
            $table->dropColumn('chapas_bloco_id');
        });
    }
}
