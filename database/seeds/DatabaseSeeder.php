<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call([GruposUsuariosTableSeeder::class]);
//        $this->call([UsersTableSeeder::class]);
        $this->call([AcessosTableSeeder::class]);
        $this->call([TelasIniciaisSeeder::class]);
    }
}
