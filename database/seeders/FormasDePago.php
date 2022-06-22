<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormasDePago extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forma_pagos')->insert([
            'id' => 1,
            'nombre' => "Metálico",
            'icon' => "payments",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forma_pagos')->insert([
            'id' => 2,
            'nombre' => "Tarjeta",
            'icon' => "credit_card",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('forma_pagos')->insert([
            'id' => 3,
            'nombre' => "Trasnferencia",
            'icon' => "account_balance",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}