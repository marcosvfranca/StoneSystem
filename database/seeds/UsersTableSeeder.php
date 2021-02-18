<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'Marcos',
            'email' => 'marcos@material.com',
            'username' => 'marcos',
            'email_verified_at' => now(),
            'password' => Hash::make('alemao'),
            'created_at' => now(),
            'updated_at' => now(),
            'grupos_usuarios_id' => '1'
        ]);
        DB::table('users')->insert([
            'name' => 'Marcos2',
            'email' => 'marcos2@material.com',
            'username' => 'marcos2',
            'email_verified_at' => now(),
            'password' => Hash::make('alemao'),
            'created_at' => now(),
            'updated_at' => now(),
            'grupos_usuarios_id' => '2'
        ]);
    }
}
