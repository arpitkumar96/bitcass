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
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('amount',15,2);
            $table->string('image')->nullable();
            $table->enum('usage_limitation', ['limited', 'unlimited']);
            $table->integer('number_of_usage')->nullable();
            $table->integer('usaged')->nullable();
            $table->longText('description')->nullable();
            $table->enum('is_active', ['1', '0'])->default('0');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gifts');
    }
};
