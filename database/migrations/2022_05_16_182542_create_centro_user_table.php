<?php

use App\Models\Centro;
use App\Models\User;
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
        Schema::create('centro_user', function (Blueprint $table) {
            $table->foreignIdFor(Centro::class)->references('id')->on('centros')->cascadeOnDelete();
            $table->foreignIdFor(User::class)->references('id')->on('users')->cascadeOnDelete();
            $table->primary(['centro_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centro_user');
    }
};