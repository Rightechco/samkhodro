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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('image',400)->nullable();
            $table->string('sku',20);
            $table->string('count');
            $table->string('slug');
            $table->string('titleSeo');
            $table->text('bodySeo');
            $table->string('keywordSeo');
            $table->string('imageAlt');
            $table->bigInteger('price');
            $table->bigInteger('priceF');
            $table->timestamps();
        });
        Schema::create('productables', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('productables_id');
            $table->string('productables_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
