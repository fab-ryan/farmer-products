<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('product_name');
            $table->string('product_code');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('unit_price')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('unit')->default('KG');
            $table->string('description')->nullable();
            $table->string('images')->nullable();
            $table->date('harvest_date')->nullable();
            $table->time('harvest_time')->nullable();
            $table->string('status')->default('active');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
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
