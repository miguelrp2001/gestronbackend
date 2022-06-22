<?php

use App\Models\Cliente;
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
        Schema::table('centros', function (Blueprint $table) {
            $table->foreignId("tarifaSeleccionada")->nullable()->constrained()->references("id")->on("tarifas");
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignIdFor(Cliente::class)->nullable()->references('id')->on('clientes')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
