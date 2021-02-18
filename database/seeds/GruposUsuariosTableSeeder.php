<?php

use Illuminate\Database\Seeder;

class GruposUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('grupos_usuarios')->truncate();
        DB::table('grupos_usuarios')->insert([
            'nome' => "Administrador",
            'admin' => 'S'
        ]);
        DB::table('grupos_usuarios')->insert([
            'nome' => "Usuário",
            'admin' => 'N'
        ]);
    }
}
