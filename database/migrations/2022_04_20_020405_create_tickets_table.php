<?php

use App\Models\Cliente;
use App\Models\Trabajador;
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
            $table->foreignIdFor(Cliente::class)->references('id')->on('clientes')->restrictOnDelete();
            $table->foreignIdFor(Trabajador::class)->references('id')->on('trabajadors')->restrictOnDelete();
            $table->foreignIdFor(Cliente::class)->nullable()->references('id')->on('clientes')->restrictOnDelete();
            $table->set('estado', ['n', 'a', 'c'])->default('n');
            $table->set('tipo', ['p', 't', 'f'])->default('p');
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