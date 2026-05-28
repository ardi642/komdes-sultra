<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/tentang-kami', 'pages.tentang-kami')->name('tentang-kami');
Route::view('/anggota', 'pages.anggota')->name('anggota');
Route::view('/berita', 'pages.berita')->name('berita');
Route::view('/berita/detail', 'pages.berita-detail')->name('berita.detail');

Route::view('/artikel', 'pages.artikel')->name('artikel');
Route::view('/artikel/detail', 'pages.artikel-detail')->name('artikel.detail');

Route::view('/acara', 'pages.acara')->name('acara');
Route::view('/acara/detail', 'pages.acara-detail')->name('acara.detail');

Route::view('/riset', 'pages.riset')->name('riset');
Route::view('/riset/kategori', 'pages.riset-kategori')->name('riset.kategori');
Route::view('/riset/detail', 'pages.riset-detail')->name('riset.detail');

Route::view('/siaran-pers', 'pages.siaran-pers')->name('siaran-pers');
Route::view('/siaran-pers/detail', 'pages.siaran-pers-detail')->name('siaran-pers.detail');

Route::view('/isu', 'pages.isu')->name('isu');
Route::view('/isu/detail', 'pages.isu-detail')->name('isu.detail');

Route::view('/kontak', 'pages.kontak')->name('kontak');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
