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
        Schema::create('config_item_products', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->char('stock');
            $table->unsignedBigInteger('variety_option_id');
            $table->foreign('variety_option_id')->references('id')->on('variety_options')->onDelete('cascade');
            $table->unsignedBigInteger('product_item_id');
            $table->foreign('product_item_id')->references('id')->on('product_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_item_products');
    }
};
