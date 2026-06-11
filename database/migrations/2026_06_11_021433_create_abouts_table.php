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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('hero_description')->nullable();
            $table->longText('profil_singkat')->nullable();
            $table->longText('mengapa_komdes')->nullable();
            $table->string('tujuan_quote', 1000)->nullable();
            $table->json('tujuan_list')->nullable();
            $table->json('intensi_list')->nullable();
            $table->json('sikap_list')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
