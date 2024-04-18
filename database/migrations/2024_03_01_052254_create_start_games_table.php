<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('start_games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('start_game_id')->index();
            $table->integer('game_id')->index();
            $table->integer('duration')->index();
            $table->integer('winning_number')->nullable();
            $table->enum('winning_color', ['green', 'violet', 'red', 'red-violet', 'green-violet'])->nullable();
            $table->enum('winning_size', ['big', 'small'])->nullable();
            $table->enum('is_running', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('start_games');
    }
};
