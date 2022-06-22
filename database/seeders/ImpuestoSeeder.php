<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('impuestos')->insert([
            'id' => 1,
            'nombre' => "IVA General",
            'nombre_corto' => "IVA21",
            'porcentaje' => 21,
            'updated_at' => now(),
            'created_at' => now()
        ]);
        DB::table('impuestos')->insert([
            'id' => 2,
            'nombre' => "IVA Reducido",
            'nombre_corto' => "IVA10",
            'porcentaje' => 10,
            'updated_at' => now(),
            'created_at' => now()
        ]);
        DB::table('impuestos')->insert([
            'id' => 3,
            'nombre' => "IVA Super reducido",
            'nombre_corto' => "IVA04",
            'porcentaje' => 4,
            'updated_at' => now(),
            'created_at' => now()
        ]);
    }
}