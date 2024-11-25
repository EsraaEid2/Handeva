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
        Schema::table('orders', function (Blueprint $table) {
        
            $table->enum('status', ['pending', 'processing', 'delivered', 'cancelled'])
                  ->default('pending')
                  ->change();

            // Add new columns
            $table->text('notes')->nullable(); // Optional notes field
            $table->softDeletes(); // Add soft delete functionality
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert 'status' enum to original
            $table->enum('status', ['pending', 'delivered'])
                  ->default('pending')
                  ->change();

            // Drop the added columns
            $table->dropColumn('notes');
            $table->dropSoftDeletes();
        });
    }
};