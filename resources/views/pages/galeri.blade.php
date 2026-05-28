@extends('layouts.public')

@section('title', 'Galeri - Komdes Sultra')

@section('content')

@php
// Dummy data
$galleries = [
    [
        'id' => 1,
        'title' => 'Aksi Tanam Mangrove Serentak se-Sultra',
        'type' => 'photo',
        'count' => 12,
        'date' => '15 April 2023',
        'author' => 'Admin Komdes',
        'thumbnail' => 'https://picsum.photos/seed/mangrove/800/600',
    ],
    [
        'id' => 2,
        'title' => 'Dokumenter: Kehidupan Nelayan Desa Wakatobi',
        'type' => 'video',
        'count' => 1,
        'date' => '05 Juli 2023',
        'author' => 'Tim Media',
        'thumbnail' => 'https://picsum.photos/seed/nelayan/800/600',
    ],
    [
        'id' => 3,
        'title' => 'Diskusi Komunitas Nelayan Tradisional',
        'type' => 'photo',
        'count' => 8,
        'date' => '22 Mei 2023',
        'author' => 'Koordinator Lapangan',
        'thumbnail' => 'https://picsum.photos/seed/diskusi/800/600',
    ],
    [
        'id' => 4,
        'title' => 'Pelatihan Pengelolaan Pesisir Berkelanjutan',
        'type' => 'photo',
        'count' => 25,
        'date' => '12 Agustus 2023',
        'author' => 'Admin Komdes',
        'thumbnail' => 'https://picsum.photos/seed/pesisir/800/600',
    ],
    [
        'id' => 5,
        'title' => 'Webinar Perubahan Iklim & Dampaknya',
        'type' => 'video',
        'count' => 1,
        'date' => '02 Maret 2023',
        'author' => 'Humas',
        'thumbnail' => 'https://picsum.photos/seed/iklim/800/600',
    ],
    [
        'id' => 6,
        'title' => 'Rapat Kerja Tahunan Jaring Nusa',
        'type' => 'photo',
        'count' => 15,
        'date' => '10 Januari 2023',
        'author' => 'Sekretariat',
        'thumbnail' => 'https://picsum.photos/seed/rapat/800/600',
    ]
];
@endphp

<!-- Main Content Area -->
<main class="w-full">

    <!-- 1. Header Section (Green Gradient) -->
    <div class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, var(--color-primary-500, #22c55e) 0%, var(--color-primary-700, #15803d) 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="text-center mt-10 mb-8 max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-widest uppercase text-white drop-shadow-md">Galeri Kegiatan</h1>
                <div class="w-24 h-1.5 mx-auto rounded-full shadow-sm mb-6 bg-white opacity-80"></div>
                <p class="text-xl text-white leading-loose drop-shadow-sm font-medium">
                    Jelajahi berbagai momen dan aktivitas yang merekam semangat kolaborasi Komdes Sultra.
                </p>
            </div>
        </div>
    </div>

    <!-- 2. Grid Galeri (White Background) -->
    <section class="py-16 md:py-24 relative overflow-hidden bg-gradient-to-b from-white to-primary-50/80">
        
        <div class="max-w-7xl mx-auto px-6 md:px-10 lg:px-12 relative z-10">
            
            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12 mb-16">
                @foreach($galleries as $item)
                <a href="{{ route('galeri.detail') }}" class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col group">
                    <!-- Thumbnail with overlay -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Overlay gradient on hover -->
                        <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/10 transition-colors duration-300"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 md:p-8 flex flex-col flex-grow bg-white">
                        <!-- Meta -->
                        <div class="flex items-center gap-4 text-sm text-zinc-500 mb-4 font-medium">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item['date'] }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $item['author'] }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h2 class="font-heading text-xl md:text-2xl font-bold text-zinc-900 leading-snug mb-6 group-hover:text-primary-600 transition-colors duration-300">
                            {{ $item['title'] }}
                        </h2>

                        <!-- Spacer -->
                        <div class="flex-grow"></div>

                        <!-- Action Link -->
                        <div class="mt-4 inline-flex items-center text-sm font-bold text-primary-600 group-hover:text-primary-700">
                            Lihat Detail
                            <svg class="ml-1 w-4 h-4 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- Pagination (Consistent with Berita) -->
            <div class="flex justify-center mb-12">
                <nav class="inline-flex items-center gap-1 bg-white p-1 rounded-full border border-zinc-200 shadow-sm">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-500 hover:bg-zinc-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-600 text-white font-bold shadow-sm">1</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">2</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">3</a>
                    <span class="w-10 h-10 flex items-center justify-center text-zinc-400">...</span>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">8</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-500 hover:bg-zinc-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </nav>
            </div>
            
        </div>
    </section>
</main>
@endsection
