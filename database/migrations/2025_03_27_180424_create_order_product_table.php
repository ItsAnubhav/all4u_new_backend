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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id(); // Primary key for the order-product relationship
            $table->integer('order_id'); // Foreign key to the 'orders' table
            $table->integer('product_id'); // Foreign key to the 'products' table
            $table->string('product_name'); // Name of the product at the time of order
            $table->integer('quantity'); // Quantity of the product ordered
            $table->decimal('unit_price', 10, 2); // Price per unit of the product at the time of order
            $table->decimal('total_price', 10, 2); // Total price for this product (quantity * unit_price)
            $table->string('notes')->nullable(); // Any notes for this product
            $table->softDeletes();
            $table->timestamps(); // Created_at and updated_at timestamps

            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
