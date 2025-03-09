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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('more')->nullable();
            $table->text('description')->nullable();
            $table->string('background')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('count')->nullable();
            $table->smallInteger('number')->nullable();
            $table->boolean('status')->nullable();
            $table->text('ads1')->nullable();
            $table->text('ads2')->nullable();
            $table->text('ads3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
