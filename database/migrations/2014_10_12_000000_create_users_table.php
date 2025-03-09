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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile');
            $table->tinyInteger('gender');
            $table->tinyInteger('level')->default(0);
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('registration_number')->nullable();
            $table->bigInteger('number')->nullable();
            $table->boolean('contact')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('postal',15)->nullable();
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
