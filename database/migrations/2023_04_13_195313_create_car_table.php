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
        Schema::create('car', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('color_bodywork')->nullable();
            $table->string('rf_license_number')->nullable()->unique();
            $table->boolean('status')->nullable();
            $table->foreignId('client_id')->constrained('client');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car');
    }
};
