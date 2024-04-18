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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique()->index();
            $table->string('name')->nullable();
            $table->bigInteger('phone_number')->unique()->index();
            $table->string('invite_code')->nullable()->index();
            $table->double('total_wallet_amount')->default(0);
            $table->integer('level')->default(0);
            $table->string('password');
            $table->enum('block_status', ['1', '0'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
