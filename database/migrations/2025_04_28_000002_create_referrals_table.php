<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referrer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'active', 'completed'])->default('pending');
            $table->decimal('commission', 10, 2)->default(0);
            $table->boolean('paid')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('referrals');
    }
};