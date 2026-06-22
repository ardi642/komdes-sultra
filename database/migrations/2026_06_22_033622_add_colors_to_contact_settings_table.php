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
        Schema::table('contact_settings', function (Blueprint $table) {
            $table->string('site_name_2')->nullable()->after('site_name');
            $table->string('site_color_1')->default('#165a3f')->after('favicon');
            $table->string('site_color_2')->default('#FFD700')->after('site_color_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_settings', function (Blueprint $table) {
            $table->dropColumn(['site_name_2', 'site_color_1', 'site_color_2']);
        });
    }
};
