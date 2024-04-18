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
        Schema::create('wallet_recharge_requests', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->bigInteger('user_id');
            $table->double('amount',15,2);
            $table->longText('payment_type_detail');
            $table->longText('channel_detail');
            $table->bigInteger('utr_number')->nullable();
            $table->enum('status', ['initiated', 'pending', 'confirm', 'cancel','timeout'])->default('initiated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_recharge_requests');
    }
};
