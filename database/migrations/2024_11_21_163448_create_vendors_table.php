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
        if (!Schema::hasTable('vendors')) {
            Schema::create('vendors', function (Blueprint $table) {
                $table->id();
                $table->foreignId('role_id')->constrained()->onDelete('cascade');
                $table->json('social_links')->nullable();
                $table->text('bio')->nullable();
                $table->string('profile_pic')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraint first
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
        Schema::dropIfExists('vendors');
    }
};