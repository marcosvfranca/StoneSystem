<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChapas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chapas_serradas', function (Blueprint $table) {
//            $table->dropColumn('qtd_chapas');
//            $table->dropColumn('comprimento');
//            $table->dropColumn('altura');
//            $table->dropColumn('espessuras_chapas_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
