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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('merchant_name');
            $table->string('merchant_email');
            $table->double('total');
            $table->integer('quantity');

            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('merchant_id')->constrained('users');
            $table->foreignId('status_id')->constrained('status');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
