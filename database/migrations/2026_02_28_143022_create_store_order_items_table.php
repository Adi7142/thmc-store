<?php

// xxxx_xx_xx_create_store_order_items_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('store_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('store_orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('store_products');
            $table->foreignId('variant_id')->constrained('store_product_variants');

            $table->string('name_snapshot');
            $table->unsignedInteger('unit_price_cents');
            $table->unsignedInteger('qty')->default(1);
            $table->unsignedInteger('line_total_cents');
            $table->json('meta_snapshot')->nullable();

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('store_order_items');
    }
};
