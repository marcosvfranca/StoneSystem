<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBlocosBrutosAddFieldsD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocos_brutos', function (Blueprint $table) {
            $table->renameColumn('numeracao', 'numeracao_pedreira');
            $table->renameColumn('comprimento', 'comprimento_bruto');
            $table->renameColumn('altura', 'altura_bruta');
            $table->renameColumn('largura', 'largura_bruta');
            $table->string('nosso_numero')->nullable()->after('numeracao');
            $table->float('comprimento_liquido')->default(0.00);
            $table->float('altura_liquida')->default(0.00);
            $table->float('largura_liquida')->default(0.00);
            $table->enum('origem', ['P', 'T'])->default('P');
            $table->string('nf_chegada')->nullable();
            $table->date('dt_nf_chegada')->nullable();
            $table->string('nf_compra')->nullable();
            $table->date('dt_nf_compra')->nullable();
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
            $table->renameColumn('numeracao_pedreira', 'numeracao');
            $table->renameColumn('comprimento_bruto', 'comprimento');
            $table->renameColumn('altura_bruta', 'altura');
            $table->renameColumn('largura_bruta', 'largura');
            $table->dropColumn('nosso_numero');
            $table->dropColumn('comprimento_liquido');
            $table->dropColumn('altura_liquida');
            $table->dropColumn('largura_liquida');
            $table->dropColumn('origem', ['P', 'T']);
            $table->dropColumn('nf_chegada');
            $table->dropColumn('dt_nf_chegada');
            $table->dropColumn('nf_compra');
            $table->dropColumn('dt_nf_compra');
        });
    }
}
