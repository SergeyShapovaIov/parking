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

        Schema::table('car', function (Blueprint $table) {
         
            $table->string('brand', 255)->change();
            $table->string('model', 255)->change();
            $table->string('color_bodywork', 255)->change();
            $table->string('rf_license_number', 9)->change();
            $table->enum('status', [0,1])->change();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car', function (Blueprint $table) {
            $table->string('brand')->change();
            $table->string('model')->change();
            $table->string('color_bodywork')->change();
            $table->string('rf_license_number')->change();
            $table->boolean('status')->change();
        });
    }
};
