<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_detail_products', function (Blueprint $table) {
            $table->id();

            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_price');
            $table->integer('quantity');
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail_products');
    }
};
