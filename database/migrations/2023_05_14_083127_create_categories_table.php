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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nameSeo')->nullable();
            $table->string('bodySeo')->nullable();
            $table->string('slug');
            $table->tinyInteger('type');
            $table->string('image',400)->nullable();
            $table->text('body')->nullable();
            $table->string('keyword',400)->nullable();
            $table->timestamps();
        });
        Schema::create('catables', function (Blueprint $table) {
            $table->integer('category_id');
            $table->integer('catables_id');
            $table->string('catables_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
