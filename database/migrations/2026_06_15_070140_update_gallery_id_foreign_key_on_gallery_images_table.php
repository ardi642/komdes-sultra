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
        Schema::table('gallery_images', function (Blueprint $table) {
            // Drop existing foreign key
            $table->dropForeign(['gallery_id']);
            
            // Make column nullable
            $table->foreignId('gallery_id')->nullable()->change();
            
            // Add new foreign key with set null on delete
            $table->foreign('gallery_id')
                  ->references('id')
                  ->on('galleries')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropForeign(['gallery_id']);
            
            // Revert back to non-nullable and cascade on delete
            $table->foreignId('gallery_id')->nullable(false)->change();
            $table->foreign('gallery_id')
                  ->references('id')
                  ->on('galleries')
                  ->cascadeOnDelete();
        });
    }
};
