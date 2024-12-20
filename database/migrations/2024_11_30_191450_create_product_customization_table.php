<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCustomizationTable extends Migration
{
    public function up()
    {
        Schema::create('product_customization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products table
            $table->string('custom_type'); // e.g., 'engraving', 'size', 'color', etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_customization');
    }
}