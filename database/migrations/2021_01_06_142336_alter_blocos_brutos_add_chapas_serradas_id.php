<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBlocosBrutosAddChapasSerradasId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocos_brutos', function (Blueprint $table) {
            $table->unsignedBigInteger('chapas_serradas_id')->nullable();
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
        Schema::table('blocos_brutos', function (Blueprint $table) {
            $table->dropForeign('chapas_serradas_chapas_serradas_id_foreign');
            $table->dropColumn('chapas_serradas_id');
        });

    }
}
