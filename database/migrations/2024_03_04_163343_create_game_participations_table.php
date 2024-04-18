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
        Schema::create('game_participations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('start_game_id');
            $table->bigInteger('user_id');
            $table->enum('type', ['number', 'color', 'size']);
            $table->text('data');
            $table->double('amount',15,2);
            $table->double('handling_fee',15,2);
            $table->double('final_amount',15,2);
            $table->bigInteger('quantity');
            $table->double('win_amount', 15,2)->nullable();
            $table->enum('is_win', ['1', '0'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_participations');
    }
};
