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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // ID will auto-increment
            $table->enum('role_type', ['customer', 'vendor', 'admin'])
                ->default('customer')
                ->comment('customer, vendor, admin');
            $table->timestamps();
        });

        // Insert default roles, ensuring "customer" gets ID 1
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            ['id' => 1, 'role_type' => 'customer', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'role_type' => 'vendor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'role_type' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};