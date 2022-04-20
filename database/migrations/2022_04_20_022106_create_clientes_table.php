<?php

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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Centro::class)->references('id')->on('centros')->restrictOnDelete();
            $table->string('nombre', 25);
            $table->string('direccion', 150);
            $table->string('nif', 9);
            $table->string('nombre_fiscal', 25);
            $table->string('telefono', 15);
            $table->string('correo', 120);
            $table->boolean('ticketCorreo')->default(true);
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
        Schema::dropIfExists('clientes');
    }
};