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
        Schema::table('posts', function (Blueprint $table) {
            // Hapus index unik lama (yang melarang slug kembar di semua jenis tulisan)
            $table->dropUnique('posts_slug_unique');
            
            // Buat index unik baru: Slug boleh kembar ASALKAN type-nya berbeda
            $table->unique(['slug', 'type'], 'posts_slug_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Hapus index unik gabungan
            $table->dropUnique('posts_slug_type_unique');
            
            // Kembalikan ke pengaturan awal (slug harus unik secara global)
            $table->unique('slug', 'posts_slug_unique');
        });
    }
};
