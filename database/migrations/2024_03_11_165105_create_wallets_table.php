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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('type_id');
            $table->double('amount',15,2);
            $table->enum('transaction_type', ['credit', 'debit']);
            $table->enum('type', ['deposite', 'withdrawal', 'bet', 'reward', 'joinning_bonus', 'subordinate_joinning_bonus', 'first_recharge_commission', 'recharge_commission', 'game_play_commission', 'first_recharge_self_commission', 'gift']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
