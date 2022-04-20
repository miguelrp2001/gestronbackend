<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => "Usuario Admin",
            'admin' => true,
            'email' => "admin@admin.com",
            'password' => bcrypt('123123123'),
            'telefono' => 666555444,
            'ipRegistro' => "0.0.0.0",
            'ipUltLogin' => "0.0.0.0",
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => "Usuario",
            'admin' => false,
            'email' => "usuario@usuario.com",
            'password' => bcrypt('123123123'),
            'telefono' => 666555333,
            'ipRegistro' => "0.0.0.0",
            'ipUltLogin' => "0.0.0.0",
        ]);
    }
}