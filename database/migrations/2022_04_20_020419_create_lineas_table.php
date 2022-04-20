<?php

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
        Schema::create('lineas', function (Blueprint $table) {
            $table->id();
            $table->set('estado', ['a', 'c'])->default('a');
            $table->foreignIdFor(Ticket::class)->references('id')->on('tickets')->restrictOnDelete();
            $table->foreignIdFor(Trabajador::class)->references('id')->on('trabajadors')->restrictOnDelete();
            $table->foreignIdFor(Precio::class)->references('id')->on('precios')->restrictOnDelete();
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
        Schema::dropIfExists('lineas');
    }
};