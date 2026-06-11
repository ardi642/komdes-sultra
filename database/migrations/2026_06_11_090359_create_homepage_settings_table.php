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
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->text('about_description')->nullable();
            $table->enum('about_media_type', ['none', 'image', 'youtube'])->default('none');
            $table->string('about_image_path')->nullable();
            $table->string('about_youtube_url')->nullable();
            
            // Buttons
            $table->string('about_btn1_text')->nullable();
            $table->string('about_btn1_url')->nullable();
            $table->string('about_btn2_text')->nullable();
            $table->string('about_btn2_url')->nullable();
            
            // Subtitles
            $table->string('network_subtitle')->nullable();
            $table->string('issue_subtitle')->nullable();
            $table->string('agenda_subtitle')->nullable();
            $table->string('publication_subtitle')->nullable();
            $table->string('gallery_subtitle')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};
