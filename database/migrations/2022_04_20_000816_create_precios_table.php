<?php

use App\Models\Impuesto;
use App\Models\Tarifa;
use App\Models\Articulo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Articulo::class)->references('id')->on('articulos')->restrictOnDelete();
            $table->foreignIdFor(Tarifa::class)->references('id')->on('tarifas')->restrictOnDelete();
            $table->foreignIdFor(Impuesto::class)->references('id')->on('impuestos')->restrictOnDelete();
            $table->double('precio', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios');
    }
};