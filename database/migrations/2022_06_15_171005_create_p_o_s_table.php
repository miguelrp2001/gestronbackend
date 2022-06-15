<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Centro;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_o_s', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Centro::class)->references('id')->on('centros')->restrictOnDelete();
            $table->string('nombre', 30);
            $table->string('token', 300);
            $table->boolean('activo')->default(true);
            $table->foreignId('creadoPor')->references('id')->on('users')->nullOnDelete()->nullable();
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
        Schema::dropIfExists('p_o_s');
    }
};