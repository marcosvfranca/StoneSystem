<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeM2ChapasBlocos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update("update `chapas_blocos` set
                comprimento = REPLACE(comprimento, ',', '.'),
                largura = REPLACE(largura, ',', '.')");

        Schema::table('chapas_blocos', function(Blueprint $table) {
            $table->float('comprimento')->change();
            $table->float('largura')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chapas_blocos', function(Blueprint $table) {
            $table->string('comprimento')->change();
            $table->string('largura')->change();
        });
    }
}
