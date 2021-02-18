<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEspessuraAddCorFonte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('espessuras_chapas', function (Blueprint $table) {
            $table->string('cor_fonte')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('espessuras_chapas', function (Blueprint $table) {
            $table->dropColumn('cor_fonte');
        });
    }
}
