@extends('layouts.public')

@section('title', 'Detail Galeri - Komdes Sultra')

@section('content')

@php
// Dummy detail data
$detail = [
    'title' => 'Aksi Tanam Mangrove Serentak se-Sultra',
    // The gallery can contain both photos and a video iframe
    'date' => '15 April 2023',
    'author' => 'Admin Komdes',
    'description' => 'Kegiatan ini merupakan bagian dari komitmen bersama Jaring Nusa dan Komdes Sultra dalam menjaga ekosistem pesisir. Diikuti oleh lebih dari 500 relawan di berbagai titik kabupaten dan kota, aksi penanaman mangrove ini diharapkan mampu meminimalisir abrasi serta memulihkan ruang hidup masyarakat nelayan.',
    // photos array
    'photos' => [
        'https://images.unsplash.com/photo-1601662528567-526cd06f6582?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1544474701-d00e0dfbdf42?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1596395355060-478627b003a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
    ],
    // video url
    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'
];
@endphp

<!-- Main Content Area -->
<main class="w-full">

    <!-- 1. Header Section -->
    <div class="relative pt-8 md:pt-12 pb-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            
            <!-- Breadcrumb -->
            <nav class="flex text-sm text-zinc-500 mb-8 font-medium" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-zinc-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('galeri') }}" class="ml-1 md:ml-2 hover:text-primary-600 transition-colors">Galeri</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-zinc-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 md:ml-2 text-zinc-400">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <div class="max-w-4xl">
                <!-- Meta data -->
                <div class="flex flex-wrap items-center gap-4 text-zinc-500 mb-6 font-medium text-sm md:text-base">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $detail['date'] }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>{{ $detail['author'] }}</span>
                    </div>
                </div>
                
                <h1 class="font-heading text-3xl md:text-4xl lg:text-5xl font-extrabold text-zinc-900 leading-tight mb-4">
                    {{ $detail['title'] }}
                </h1>
            </div>
        </div>
    </div>

    <!-- 2. Content Section -->
    <section class="py-8 md:py-12 relative bg-white">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            
            <!-- Optional Description -->
            @if(isset($detail['description']) && $detail['description'] != '')
            <div class="max-w-4xl mb-12">
                <div class="text-zinc-700 leading-relaxed text-base md:text-lg">
                    {{ $detail['description'] }}
                </div>
            </div>
            @endif

            <!-- Video Section (If Exists) -->
            @if(isset($detail['video_url']) && $detail['video_url'] != '')
                <div class="max-w-4xl mb-12 rounded-2xl overflow-hidden shadow-lg ring-1 ring-zinc-200">
                    <div class="aspect-w-16 aspect-h-9 relative w-full h-0 pb-[56.25%] bg-zinc-900">
                        <iframe 
                            src="{{ $detail['video_url'] }}" 
                            class="absolute top-0 left-0 w-full h-full"
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            @endif

            <!-- Multi-Photo Layout (If Exists) -->
            @if(isset($detail['photos']) && count($detail['photos']) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @foreach($detail['photos'] as $index => $photo)
                        <!-- Make the first photo larger to break the monotony -->
                        <div class="group relative rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : '' }}">
                            <img src="{{ $photo }}" alt="Gallery image {{ $index + 1 }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" style="min-height: {{ $index === 0 ? '400px' : '250px' }};">
                            
                            <!-- Hover Overlay for lightboxing in the future -->
                            <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-300 cursor-pointer flex items-center justify-center">
                                <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
        </div>
    </section>
</main>
@endsection
