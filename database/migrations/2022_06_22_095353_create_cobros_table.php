<?php

use App\Models\FormaPago;
use App\Models\Trabajador;
use App\Models\Ticket;
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
        Schema::create('cobros', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['a', 'c'])->default('a');
            $table->foreignIdFor(Ticket::class)->references('id')->on('tickets')->restrictOnDelete();
            $table->foreignIdFor(Trabajador::class)->references('id')->on('trabajadors')->restrictOnDelete();
            $table->foreignIdFor(FormaPago::class)->references('id')->on('forma_pagos')->restrictOnDelete();
            $table->double('cantidad', 10, 2);
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
        Schema::dropIfExists('cobros');
    }
};
