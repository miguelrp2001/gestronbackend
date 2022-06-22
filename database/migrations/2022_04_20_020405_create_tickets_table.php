<?php

use App\Models\Cliente;
use App\Models\Trabajador;
use App\Models\Centro;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Centro::class)->references('id')->on('centros')->restrictOnDelete();
            $table->foreignIdFor(Trabajador::class)->references('id')->on('trabajadors')->restrictOnDelete();
            $table->enum('estado', ['n', 'a', 'c'])->default('n');
            $table->enum('tipo', ['p', 't', 'f'])->default('p');
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
        Schema::dropIfExists('tickets');
    }
};
