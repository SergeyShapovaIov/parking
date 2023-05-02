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
        Schema::create('review', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->string('text', 1000);
            $table->bigInteger('mark_helpful_review');
            $table->foreignId('buyer_id')->constrained('buyer');
            $table->foreignId('product_id')->constrained('product');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
