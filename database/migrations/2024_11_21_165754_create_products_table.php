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
        // Create products table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key to categories table
            $table->integer('stock_quantity');
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade'); // Foreign key to vendors table
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_traditional')->default(false);
            $table->boolean('is_customizable')->default(false);
            $table->decimal('price_after_discount', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};