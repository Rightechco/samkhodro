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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('titleSeo')->nullable();
            $table->string('slug');
            $table->smallInteger('time')->nullable();
            $table->text('image');
            $table->string('imageAlt')->nullable();
            $table->string('keyword')->nullable();
            $table->text('body');
            $table->text('bodySeo')->nullable();
            $table->boolean('status');
            $table->boolean('suggest')->nullable();
            $table->string('user_id' , 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
