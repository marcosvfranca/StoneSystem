<?php

use Illuminate\Database\Seeder;

class TelasIniciaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $telas = [
            '/home', '/executar-processos', '/blocos', '/chapas-serradas', '/ordem-de-serradas/executar'
        ];

        foreach ($telas as $t) {
            $tela = DB::table('telas_iniciais')->where(['nome' => $t]);
            if (!$tela->first())
                DB::table('telas_iniciais')->insert(['nome' => $t]);
            else
                $tela->update(['nome' => $t]);
        }
    }
}
