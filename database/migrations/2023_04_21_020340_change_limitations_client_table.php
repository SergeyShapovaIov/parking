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
        Schema::table('client', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->enum('gender', ['Мужчина', 'Женщина'])->change();
            $table->string('phone_number', 11)->change();
            $table->string('address', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('gender')->change();
            $table->string('phone_number')->change();
            $table->string('address')->change();
        });
    }
};
