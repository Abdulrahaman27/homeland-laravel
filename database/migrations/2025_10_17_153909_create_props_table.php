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
        Schema::create('props', function (Blueprint $table) {
            $table->id();
        $table->string('title');
        $table->decimal('price', 10, 2);
        $table->string('image')->nullable();
        $table->integer('bed')->nullable();
        $table->integer('baths')->nullable();
        $table->integer('sq_ft')->nullable();
        $table->string('home_type')->nullable();
        $table->year('year_built')->nullable();
        $table->decimal('price_sqft', 10, 2)->nullable();
        $table->text('more_info')->nullable();
        $table->string('location')->nullable();
        $table->string('type')->nullable();
        $table->string('agent_name')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('props');
    }
};
