<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // View Composer untuk Sidebar di halaman publik (berita, artikel, riset, siaran_pers)
        View::composer(['pages.berita', 'pages.artikel', 'pages.riset', 'pages.siaran-pers', 'pages.berita-detail', 'pages.artikel-detail', 'pages.riset-detail', 'pages.siaran-pers-detail'], function ($view) {
            // 1. Kategori beserta jumlah postingan yang terpublikasi
            $categories = Category::withCount(['posts' => function ($query) {
                $query->published();
            }])->get();

            // 2. Top 15 Tags (menampilkan semua tag, diurutkan berdasarkan jumlah post terbanyak)
            $topTags = Tag::withCount(['posts' => function ($query) {
                $query->published();
            }])->orderBy('posts_count', 'desc')
              ->take(15)
              ->get();

            // 3. Arsip Waktu (Tahun dan Bulan) dari postingan yang terpublikasi
            $archives = Post::published()
                ->selectRaw('YEAR(published_at) year, MONTH(published_at) month, count(*) published')
                ->groupBy('year', 'month')
                ->orderByRaw('year DESC, month DESC')
                ->get()
                ->groupBy('year');

            $view->with(compact('categories', 'topTags', 'archives'));
        });
    }
}
