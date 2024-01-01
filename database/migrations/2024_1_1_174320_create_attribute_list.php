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
        Schema::create('attribute_list', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attribute_id')->nullable()->constrained('attributes')->cascadeOnDelete();
            $table->foreignId('attributeChild_id')->nullable()->constrained('attribute_child')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_list');
    }
};
