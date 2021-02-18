<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeM2ItensChapasSerradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update("update `itens_chapas_serradas` set
                comprimento = REPLACE(comprimento, ',', '.'),
                altura = REPLACE(altura, ',', '.')");

        Schema::table('itens_chapas_serradas', function(Blueprint $table) {
            $table->float('comprimento')->change();
            $table->float('altura')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itens_chapas_serradas', function(Blueprint $table) {
            $table->string('comprimento')->change();
            $table->string('altura')->change();
        });
    }
}
