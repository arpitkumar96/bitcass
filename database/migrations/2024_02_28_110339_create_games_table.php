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
        Schema::create('games', function (Blueprint $table) {
            $table->id()->index();
            $table->string('slug')->unique()->index();
            $table->integer('game_category_id')->index();
            $table->integer('game_sub_category_id')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('duration')->comment('in minute');
            $table->longText('how_to_play')->nullable();
            $table->enum('is_active', ['1', '0'])->default('1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
