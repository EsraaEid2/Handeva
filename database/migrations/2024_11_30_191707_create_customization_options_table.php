<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizationOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('customization_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_customization_id')->constrained('product_customization')->onDelete('cascade'); // Foreign key to product_customization
            $table->string('option_value'); // Custom option value (e.g., "Gold", "Silver", "Text Engraving", etc.)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customization_options');
    }
}