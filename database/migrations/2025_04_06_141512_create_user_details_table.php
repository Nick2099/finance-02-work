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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->boolean('main_user')->default(true); // Indicates if the user is a main user
            $table->unsignedBigInteger('main_user_no')->nullable(); // ID of the main user
            $table->boolean('custom_groups')->default(false); // Indicates if the user has custom groups
            $table->unsignedBigInteger('custom_groups_id')->nullable(); // ID of the custom group
            $table->unsignedSmallInteger('level')->default(1); // User level
            $table->unsignedSmallInteger('admin_level')->default(1); // Admin level
            $table->string('timezone', 50)->default('UTC'); // User's timezone
            $table->string('language', 10)->default('en'); // User's language preference
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
