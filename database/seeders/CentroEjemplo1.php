<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentroEjemplo1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('centros')->insert([
            'id' => 1,
            'nombre' => "Mi tienda 1",
            'direccion' => "Calle de Ejemplo, 1",
            'telefono' => "666555444",
            'nombre_legal' => "Mi tienda 1 S.L.",
            'nif' => "B12345678",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('centros')->insert([
            'id' => 2,
            'nombre' => "Mi tienda 2",
            'direccion' => "Calle de Ejemplo, 2",
            'telefono' => "666555333",
            'nombre_legal' => "Mi tienda 2 S.L.",
            'nif' => "B12345679",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tarifas')->insert([
            'id' => 1,
            'nombre' => "Tarifa invierno",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tarifas')->insert([
            'id' => 2,
            'nombre' => "Tarifa verano",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tarifas')->insert([
            'id' => 3,
            'nombre' => "Tarifa general",
            'centro_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('centros')->where('id', 1)->update([
            'tarifaSeleccionada' => 2
        ]);

        DB::table('centros')->where('id', 2)->update([
            'tarifaSeleccionada' => 3
        ]);

        DB::table('centro_user')->insert([
            'centro_id' => 1,
            'user_id' => 1
        ]);

        DB::table('centro_user')->insert([
            'centro_id' => 2,
            'user_id' => 1
        ]);

        DB::table('centro_user')->insert([
            'centro_id' => 2,
            'user_id' => 2
        ]);

        DB::table('clientes')->insert([
            'id' => 1,
            'nombre' => "Cliente 1",
            'nombre_fiscal' => "Empresa Cli1 SL",
            'nif' => "B12345678",
            'telefono' => "666555444",
            'direccion' => "Calle de Ejemplo, 1",
            'centro_id' => 1,
            'correo' => "cliente1@mijikonetwork.com",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('clientes')->insert([
            'id' => 2,
            'nombre' => "Cliente 2",
            'nombre_fiscal' => "Empresa Cli2 SL",
            'nif' => "B12345678",
            'telefono' => "666222111",
            'direccion' => "Calle de Ejemplo, 2",
            'centro_id' => 1,
            'correo' => "cliente2@mijikonetwork.com",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('clientes')->insert([
            'id' => 3,
            'nombre' => "Cliente 3",
            'nombre_fiscal' => "Nombre Cliente 3",
            'nif' => "12345678Z",
            'telefono' => "666333444",
            'direccion' => "Calle de Ejemplo, 3",
            'centro_id' => 1,
            'correo' => "cliente3@mijikonetwork.com",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('clientes')->insert([
            'id' => 4,
            'nombre' => "Cliente 4",
            'nombre_fiscal' => "Empresa Cli4 SA",
            'nif' => "B12345678",
            'telefono' => "666555444",
            'direccion' => "Calle de Ejemplo, 1",
            'centro_id' => 2,
            'correo' => "cliente4@mijikonetwork.com",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 1,
            'nombre' => "Bebidas",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 2,
            'nombre' => "Entrantes",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 3,
            'nombre' => "Principales",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 4,
            'nombre' => "Precocinada",
            'centro_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 5,
            'nombre' => "Herramientas",
            'centro_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 6,
            'nombre' => "Electrónica",
            'centro_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 7,
            'nombre' => "Telefonía",
            'centro_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 8,
            'nombre' => "Guarniciones",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 9,
            'nombre' => "Postres",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 10,
            'nombre' => "Varios",
            'centro_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 11,
            'nombre' => "Embutidos",
            'centro_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('familias')->insert([
            'id' => 12,
            'nombre' => "Otros",
            'centro_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('articulos')->insert([
            'id' => 3,
            'nombre' => 'AGUA GAS',
            'nombre_corto' => 'AGUA GAS',
            'estado' => 'a',
            'color' => '#40d6e7',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 3,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 20,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 3,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 8,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 4,
            'nombre' => 'AGUA',
            'nombre_corto' => 'AGUA',
            'estado' => 'a',
            'color' => '#34b239',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 4,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 4,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 13,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 5,
            'nombre' => 'COCA COLA',
            'nombre_corto' => 'COCA COLA',
            'estado' => 'a',
            'color' => '#070fa9',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 5,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 5,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 6,
            'nombre' => 'COLA ZERO',
            'nombre_corto' => 'COLA ZERO',
            'estado' => 'a',
            'color' => '#a82812',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 6,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 17,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 6,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 17,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 7,
            'nombre' => 'COLA LIGHT',
            'nombre_corto' => 'COLA LIGHT',
            'estado' => 'a',
            'color' => '#0cabbb',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 7,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 11,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 7,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 8,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 8,
            'nombre' => 'NESTEA',
            'nombre_corto' => 'NESTEA',
            'estado' => 'a',
            'color' => '#94a897',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 8,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 8,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 13,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 9,
            'nombre' => 'SPRITE',
            'nombre_corto' => 'SPRITE',
            'estado' => 'a',
            'color' => '#5e7f28',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 9,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 9,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 10,
            'nombre' => 'SCHWEEPES',
            'nombre_corto' => 'SCHWEEPES',
            'estado' => 'a',
            'color' => '#e3b956',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 10,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 10,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 13,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 11,
            'nombre' => 'ZUMO MELOCOTON',
            'nombre_corto' => 'ZUMO MELOCOTON',
            'estado' => 'a',
            'color' => '#76c5c3',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 11,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 11,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 20,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 12,
            'nombre' => 'ZUMO PIÑA',
            'nombre_corto' => 'ZUMO PIÑA',
            'estado' => 'a',
            'color' => '#2c512f',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 12,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 11,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 12,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 13,
            'nombre' => 'ZUMO MANZANA',
            'nombre_corto' => 'ZUMO MANZANA',
            'estado' => 'a',
            'color' => '#62c76d',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 13,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 13,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 14,
            'nombre' => 'CAÑA',
            'nombre_corto' => 'CAÑA',
            'estado' => 'a',
            'color' => '#9bff88',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 14,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 13,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 14,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 15,
            'nombre' => 'PINTA',
            'nombre_corto' => 'PINTA',
            'estado' => 'a',
            'color' => '#901bf2',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 15,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 13,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 15,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 16,
            'nombre' => 'CORONA',
            'nombre_corto' => 'CORONA',
            'estado' => 'a',
            'color' => '#dc28ce',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 16,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 16,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 17,
            'nombre' => 'TINTO VERANO',
            'nombre_corto' => 'TINTO VERANO',
            'estado' => 'a',
            'color' => '#7890ce',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 17,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 11,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 17,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 18,
            'nombre' => 'COPA SANGRIA',
            'nombre_corto' => 'COPA SANGRIA',
            'estado' => 'a',
            'color' => '#5bae94',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 18,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 12,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 18,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 19,
            'nombre' => 'SAN MIGUEL LATA',
            'nombre_corto' => 'SAN MIGUEL LATA',
            'estado' => 'a',
            'color' => '#36c237',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 19,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 21,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 19,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 20,
            'nombre' => 'SAN MIGUEL 0',
            'nombre_corto' => 'SAN MIGUEL 0',
            'estado' => 'a',
            'color' => '#2e0ff2',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 20,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 9,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 20,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 21,
            'nombre' => 'GIN BEEFEATER',
            'nombre_corto' => 'GIN BEEFEATER',
            'estado' => 'a',
            'color' => '#e598e6',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 21,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 21,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 22,
            'nombre' => 'VODKA ERISTOFF',
            'nombre_corto' => 'VODKA ERISTOFF',
            'estado' => 'a',
            'color' => '#c5daf3',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 22,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 22,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 11,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 23,
            'nombre' => 'RHUM BRUGAL',
            'nombre_corto' => 'RHUM BRUGAL',
            'estado' => 'a',
            'color' => '#ceb1c8',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 23,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 23,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 14,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 24,
            'nombre' => 'WHISKY JB',
            'nombre_corto' => 'WHISKY JB',
            'estado' => 'a',
            'color' => '#4da31b',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 24,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 17,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 24,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 25,
            'nombre' => 'MALIBU',
            'nombre_corto' => 'MALIBU',
            'estado' => 'a',
            'color' => '#6a56d5',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 25,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 25,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 26,
            'nombre' => 'BAILEYS',
            'nombre_corto' => 'BAILEYS',
            'estado' => 'a',
            'color' => '#f87780',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 26,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 26,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 27,
            'nombre' => 'AMARETTO',
            'nombre_corto' => 'AMARETTO',
            'estado' => 'a',
            'color' => '#1503f3',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 27,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 7,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 27,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 17,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 28,
            'nombre' => 'BRANDY SOBERANO',
            'nombre_corto' => 'BRANDY SOBERANO',
            'estado' => 'a',
            'color' => '#8f19c7',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 28,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 28,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 8,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 29,
            'nombre' => 'COPA VINO BLANCO',
            'nombre_corto' => 'COPA V BLANCO',
            'estado' => 'a',
            'color' => '#ab6e3b',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 29,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 12,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 29,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 30,
            'nombre' => 'COPA VINO ROSADO',
            'nombre_corto' => 'COPA V ROSADO',
            'estado' => 'a',
            'color' => '#a9df5c',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 30,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 30,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 31,
            'nombre' => 'COPA VINO TINTO',
            'nombre_corto' => 'COPA V TINTO',
            'estado' => 'a',
            'color' => '#d5d14c',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 31,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 31,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 32,
            'nombre' => 'BOT BLANCO',
            'nombre_corto' => 'BOT BLANCO',
            'estado' => 'a',
            'color' => '#6831c2',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 32,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 12,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 32,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 21,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 33,
            'nombre' => 'BOT ROSADO',
            'nombre_corto' => 'BOT ROSADO',
            'estado' => 'a',
            'color' => '#162b9f',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 33,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 33,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 20,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 34,
            'nombre' => 'BOT TINTO',
            'nombre_corto' => 'BOT TINTO',
            'estado' => 'a',
            'color' => '#fb82b6',
            'familia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 34,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 34,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 35,
            'nombre' => 'POLLO ENTERO',
            'nombre_corto' => 'POLLO ENTERO',
            'estado' => 'a',
            'color' => '#70e071',
            'familia_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 35,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 35,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 20,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 36,
            'nombre' => '1/2 POLLO',
            'nombre_corto' => '1/2 POLLO',
            'estado' => 'a',
            'color' => '#7ad610',
            'familia_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 36,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 14,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 36,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 37,
            'nombre' => 'ALITAS 6 UD',
            'nombre_corto' => 'ALITAS 6 UD',
            'estado' => 'a',
            'color' => '#c3b0db',
            'familia_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 37,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 21,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 37,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 38,
            'nombre' => 'ALITAS 10 UD',
            'nombre_corto' => 'ALITAS 10 UD',
            'estado' => 'a',
            'color' => '#10f089',
            'familia_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 38,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 38,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 39,
            'nombre' => 'ALITAS 20 UD',
            'nombre_corto' => 'ALITAS 20 UD',
            'estado' => 'a',
            'color' => '#246cb0',
            'familia_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 39,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 39,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 13,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 40,
            'nombre' => 'CROQ POLLO',
            'nombre_corto' => 'CROQ POLLO',
            'estado' => 'a',
            'color' => '#ff64ba',
            'familia_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 40,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 12,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 40,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 17,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 41,
            'nombre' => 'CAMPERO POLLO',
            'nombre_corto' => 'CAMPERO POLLO',
            'estado' => 'a',
            'color' => '#3456b4',
            'familia_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 41,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 41,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 42,
            'nombre' => 'ENS POLLO',
            'nombre_corto' => 'ENS POLLO',
            'estado' => 'a',
            'color' => '#c8325c',
            'familia_id' => 3,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 42,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 9,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 42,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 21,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 43,
            'nombre' => 'HAMB POLLO',
            'nombre_corto' => 'HAMB POLLO',
            'estado' => 'a',
            'color' => '#2015fd',
            'familia_id' => 3,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 43,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 11,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 43,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 7,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 44,
            'nombre' => 'LAGRIMITAS POLLO',
            'nombre_corto' => 'LAGR POLLO',
            'estado' => 'a',
            'color' => '#01bc4e',
            'familia_id' => 3,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 44,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 11,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 44,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 45,
            'nombre' => 'PATATAS HORNO',
            'nombre_corto' => 'PATATAS HORNO',
            'estado' => 'a',
            'color' => '#3dbe68',
            'familia_id' => 8,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 45,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 45,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 21,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 46,
            'nombre' => 'PATATAS FRITAS',
            'nombre_corto' => 'PATATAS FRITAS',
            'estado' => 'a',
            'color' => '#c2f1a0',
            'familia_id' => 8,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 46,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 46,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 47,
            'nombre' => 'BATATAS FRITAS',
            'nombre_corto' => 'BATATAS FRITAS',
            'estado' => 'a',
            'color' => '#4b9b2e',
            'familia_id' => 8,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 47,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 47,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 19,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 48,
            'nombre' => 'ENS MIXTA',
            'nombre_corto' => 'ENS MIXTA',
            'estado' => 'a',
            'color' => '#0f1364',
            'familia_id' => 8,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 48,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 48,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 12,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 49,
            'nombre' => 'ENS GRIEGA',
            'nombre_corto' => 'ENS GRIEGA',
            'estado' => 'a',
            'color' => '#192c05',
            'familia_id' => 8,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 49,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 49,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 50,
            'nombre' => 'COMPOTA MANZANA',
            'nombre_corto' => 'COMPOTA MANZANA',
            'estado' => 'a',
            'color' => '#dc7f15',
            'familia_id' => 8,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 50,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 50,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 51,
            'nombre' => 'TARTARA',
            'nombre_corto' => 'TARTARA',
            'estado' => 'a',
            'color' => '#ab51fb',
            'familia_id' => 9,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 51,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 14,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 51,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 14,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 52,
            'nombre' => 'PANNA COTTA',
            'nombre_corto' => 'PANNA COTTA',
            'estado' => 'a',
            'color' => '#3d34a5',
            'familia_id' => 9,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 52,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 9,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 52,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 53,
            'nombre' => 'MOUSSE CHOCO',
            'nombre_corto' => 'MOUSSE CHOCO',
            'estado' => 'a',
            'color' => '#0ac912',
            'familia_id' => 9,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 53,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 9,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 53,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 20,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 54,
            'nombre' => 'TIRAMISU',
            'nombre_corto' => 'TIRAMISU',
            'estado' => 'a',
            'color' => '#0dc775',
            'familia_id' => 9,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 54,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 54,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 8,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 55,
            'nombre' => 'HELADO VAINILLA',
            'nombre_corto' => 'HEL VAINILLA',
            'estado' => 'a',
            'color' => '#3529a9',
            'familia_id' => 9,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 55,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 55,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 56,
            'nombre' => 'HELADO CHOCO',
            'nombre_corto' => 'HELADO CHOCO',
            'estado' => 'a',
            'color' => '#28c5ba',
            'familia_id' => 9,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 56,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 14,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 56,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 57,
            'nombre' => 'VARIOS',
            'nombre_corto' => 'VARIOS',
            'estado' => 'a',
            'color' => '#6725f5',
            'familia_id' => 10,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 57,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 57,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 58,
            'nombre' => 'COMIDA',
            'nombre_corto' => 'COMIDA',
            'estado' => 'a',
            'color' => '#a5a431',
            'familia_id' => 10,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 58,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 58,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 18,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('articulos')->insert([
            'id' => 59,
            'nombre' => 'BEBIDA',
            'nombre_corto' => 'BEBIDA',
            'estado' => 'a',
            'color' => '#393434',
            'familia_id' => 10,

            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 59,
            'tarifa_id' => 1,
            'impuesto_id' => 2,
            'precio' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('precios')->insert([
            'articulo_id' => 59,
            'tarifa_id' => 2,
            'impuesto_id' => 2,
            'precio' => 9,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}