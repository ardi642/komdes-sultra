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
        Schema::create('hero_slider_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_autoplay')->default(true);
            $table->integer('autoplay_interval')->default(6000); // ms
            $table->integer('animation_duration')->default(1000); // ms
            $table->integer('text_delay')->default(1000); // ms
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_slider_settings');
    }
};
