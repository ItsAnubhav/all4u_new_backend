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
            $table->id(); // Primary key for the order
            $table->foreignId('store_id')->constrained()->cascadeOnDelete(); // 'store_id' column as an integer, foreign key to 'id' column on 'stores' table
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // 'user_id' column as an integer, foreign key to 'id' column on 'users' table
            $table->enum('order_status',['pending','completed']); // Status of the order (e.g., 'pending', 'completed', etc.)
            $table->dateTime('order_date'); // Date the order was placed
            $table->dateTime('shipping_date')->nullable(); // Date the order was shipped (nullable)
            $table->decimal('total_amount', 10, 2); // Total order amount
            $table->enum('payment_status',['paid','unpaid','failed'])->default('unpaid'); // Payment status (e.g., 'paid', 'unpaid')
            $table->enum('shipping_method', ['standard','express'])->default('standard'); // Shipping method (e.g., 'standard', 'express')
            $table->string('billing_address'); // Billing address (JSON or text format)
            $table->string('shipping_address'); // Shipping address (JSON or text format)
            $table->softDeletes();
            $table->timestamps(); // Created_at and updated_at timestamps
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
