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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('size',20);
            $table->string('name');
            $table->bigInteger('user_id');
            $table->string('url');
            $table->string('path');
            $table->string('type',10);
            $table->timestamps();
        });
        Schema::create('galleriables', function (Blueprint $table) {
            $table->integer('gallery_id');
            $table->integer('galleriables_id');
            $table->string('galleriables_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
