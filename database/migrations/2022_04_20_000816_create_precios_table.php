<?php

use App\Models\Impuesto;
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
            $table->foreignIdFor(Articulo::class)->references('id')->on('articulos')->cascadeOnDelete();
            $table->foreignIdFor(Tarifa::class)->references('id')->on('tarifas')->cascadeOnDelete();
            $table->foreignIdFor(Impuesto::class)->references('id')->on('impuestos')->cascadeOnDelete();
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