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
        Schema::create('variety_options', function (Blueprint $table) {
            $table->id();
            $table->char('value')->nullable();
            $table->unsignedBigInteger('variety_id');
            $table->foreign('variety_id')->references('id')->on('varieties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variety_options');
    }
};
