<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Modify 'quantity' column to have a default value of 1
            $table->integer('quantity')->default(1)->change();

            // Add a 'total_price' column to store the computed total price
            $table->decimal('total_price', 10, 2)->after('price_at_time');
        });

        // Populate total_price for existing records
        DB::statement('UPDATE order_items SET total_price = quantity * price_at_time');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Revert 'quantity' column to no default value
            $table->integer('quantity')->change();

            // Drop the 'total_price' column
            $table->dropColumn('total_price');
        });
    }
}