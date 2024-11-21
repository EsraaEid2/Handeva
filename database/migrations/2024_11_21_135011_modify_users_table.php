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
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('role_id');
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->integer('age')->nullable();
            $table->integer('points')->default(0);

            // Set foreign key constraint
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop added columns
            $table->dropColumn([
                'first_name',
                'last_name',
                'role_id',
                'address',
                'phone_number',
                'is_deleted',
                'age',
                'points'
            ]);

            // Drop foreign key
            $table->dropForeign(['role_id']);
        });
    }
};