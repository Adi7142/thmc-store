<?php

// xxxx_xx_xx_create_store_product_variants_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('store_product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('store_products')->cascadeOnDelete();
            $table->string('name');
            $table->string('sku')->nullable()->index();
            $table->unsignedInteger('price_cents');
            $table->char('currency', 3)->default('EUR');
            $table->json('meta')->nullable(); // coin_amount, rank_code, commands, etc.
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('store_product_variants');
    }
};
