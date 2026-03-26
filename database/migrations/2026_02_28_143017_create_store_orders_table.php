<?php

// xxxx_xx_xx_create_store_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('store_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('mc_username');
            $table->enum('status', ['pending','paid','failed','refunded','fulfilled'])->default('pending');

            $table->unsignedInteger('subtotal_cents');
            $table->unsignedInteger('discount_cents')->default(0);
            $table->unsignedInteger('total_cents');
            $table->char('currency', 3)->default('EUR');

            $table->foreignId('coupon_id')->nullable()->constrained('store_coupons')->nullOnDelete();

            $table->string('payment_provider')->nullable();
            $table->string('payment_reference')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('store_orders');
    }
};
