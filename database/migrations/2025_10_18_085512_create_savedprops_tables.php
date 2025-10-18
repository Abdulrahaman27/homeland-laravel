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
        Schema::create('savedprops', function (Blueprint $table) {
            $table->id();
            $table->integer('prop_id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('image');
            $table->string('price');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savedprops_tables');
    }
};
