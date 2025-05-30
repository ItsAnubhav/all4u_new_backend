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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing 'id' column
            $table->bigInteger('created_by'); // 'created_by' column as an integer
            $table->foreignId('store_id')->constrained()->cascadeOnDelete(); // 'store_id' column as an integer, foreign key to 'id' column on 'stores' table
            $table->string('name'); // 'name' column as varchar
            $table->text('description'); // 'content' column as text
            $table->bigInteger('parent_product')->nullable(); // 'parent_product' column as integer, nullable
            $table->enum('product_type',['simple','variable','grouped','external'])->default('simple');
            $table->integer('review_count')->default(0); // 'comment_count' column as integer
            $table->decimal('avg_review', 2, 1)->default(0); // 'avg_review' column as decimal with 2 digits before and 1 digit after the decimal point
            // Adding indexes (optional based on your requirements)
            $table->boolean('is_active')->default(true);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_product')->references('id')->on('products')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps(); // Laravel default timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
