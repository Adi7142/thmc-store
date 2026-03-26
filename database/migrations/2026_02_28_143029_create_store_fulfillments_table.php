<?php

// xxxx_xx_xx_create_store_fulfillments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('store_fulfillments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained('store_orders')->cascadeOnDelete();
            $table->enum('status', ['pending','sent','failed'])->default('pending');
            $table->string('provider')->nullable();
            $table->json('payload')->nullable();
            $table->text('last_error')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('store_fulfillments');
    }
};
