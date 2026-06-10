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
            $viewName = $view->getName();
            
            $postType = null;
            if (str_contains($viewName, 'berita')) {
                $postType = 'berita';
            } elseif (str_contains($viewName, 'artikel')) {
                $postType = 'artikel';
            } elseif (str_contains($viewName, 'riset')) {
                $postType = 'riset';
            } elseif (str_contains($viewName, 'siaran-pers')) {
                $postType = 'siaran_pers';
            }

            // 1. Kategori beserta jumlah postingan yang terpublikasi, difilter berdasarkan postType jika ada
            $categoryQuery = Category::query();
            if ($postType) {
                $categoryQuery->where('type', $postType);
            }
            $categories = $categoryQuery->withCount(['posts' => function ($query) {
                $query->published();
            }])->get();

            // 2. Top 15 Tags yang digunakan pada postingan sesuai tipe
            $tagQuery = Tag::query();
            if ($postType) {
                $tagQuery->whereHas('posts', function($q) use ($postType) {
                    $q->where('type', $postType)->published();
                });
                $tagQuery->withCount(['posts' => function ($query) use ($postType) {
                    $query->where('type', $postType)->published();
                }]);
            } else {
                $tagQuery->withCount(['posts' => function ($query) {
                    $query->published();
                }]);
            }
            $topTags = $tagQuery->orderBy('posts_count', 'desc')
              ->take(15)
              ->get();

            // 3. Arsip Waktu (Tahun dan Bulan) dari postingan sesuai tipe
            $archiveQuery = Post::published();
            if ($postType) {
                $archiveQuery->where('type', $postType);
            }
            $archives = $archiveQuery
                ->selectRaw('YEAR(published_at) year, MONTH(published_at) month, count(*) published')
                ->groupBy('year', 'month')
                ->orderByRaw('year DESC, month DESC')
                ->get()
                ->groupBy('year');

            $view->with(compact('categories', 'topTags', 'archives'));
        });
    }
}
