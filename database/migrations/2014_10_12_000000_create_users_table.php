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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('username');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('address_id')->nullable()->references('id')->on('addresses');
            $table->enum('role' , ['admin','teacher','student'])->default('student'); // roles of the users for authentication not for permissions
            $table->enum('status' , ['active','inactive'])->default('active');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
