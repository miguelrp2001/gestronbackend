<?php

use App\Models\Familia;
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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['a', 'i'])->default('a');
            $table->string('nombre', 25);
            $table->string('nombre_corto', 15);
            $table->string('color', 8)->default("ffffffff");
            $table->foreignIdFor(Familia::class)->references('id')->on('familias')->restrictOnDelete();
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
        Schema::dropIfExists('articulos');
    }
};