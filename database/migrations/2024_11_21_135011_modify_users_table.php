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
        Schema::table('users', function (Blueprint $table) {
            // Check if 'name' column exists before attempting to drop it
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
    
            // Add the 'first_name' and 'last_name' columns
            $table->string('first_name');
            $table->string('last_name');
            
            // Add 'role_id' column with foreign key constraint and default to 1
            $table->unsignedBigInteger('role_id')->default(1); // Default to "customer"
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            
            // Add optional columns
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            
            // Additional fields
            $table->boolean('is_deleted')->default(0);
            $table->integer('age')->nullable();
            $table->integer('points')->default(0);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['role_id']); // Ensure to drop the foreign key first
            
            // Drop the columns we added
            $table->dropColumn([
                'first_name',
                'last_name',
                'role_id',
                'address',
                'phone_number',
                'is_deleted',
                'age',
                'points',
            ]);

            // Re-add the 'name' column if rolling back
            // $table->string('name');
        });
    }
};