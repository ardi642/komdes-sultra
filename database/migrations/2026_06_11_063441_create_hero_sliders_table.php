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
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('btn1_text')->nullable();
            $table->string('btn1_url')->nullable();
            $table->string('btn2_text')->nullable();
            $table->string('btn2_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_number')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sliders');
    }
};
