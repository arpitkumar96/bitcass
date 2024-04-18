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
        Schema::create('commission_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['joinning', 'subordinate_joinning', 'first_recharge', 'recharge', 'game_play', 'first_recharge_self']);
            $table->integer('level')->nullable();
            $table->integer('tier')->nullable();
            $table->double('commission',8,2)->nullable();
            $table->enum('method', ['percent', 'amount']);
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_settings');
    }
};
