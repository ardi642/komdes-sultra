@extends('layouts.public')

@section('title', $gallery->title . ' - Galeri Komdes Sultra')

@section('content')

<!-- Main Content Area -->
<main class="w-full">

    <!-- 1. Header Section -->
    <section class="bg-[#165a3f] pt-40 pb-32 relative overflow-hidden">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb (Teks Putih) -->
            <nav class="flex text-sm text-white/70 mb-10" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <a href="{{ route('galeri') }}" class="ml-1 md:ml-2 hover:text-white transition-colors">Galeri</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="ml-1 md:ml-2 text-white truncate max-w-[150px] sm:max-w-xs">{{ Str::limit($gallery->title, 30) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <div class="max-w-4xl">
                <!-- Meta data -->
                <div class="flex flex-wrap items-center gap-4 text-white/80 mb-6 font-medium text-sm md:text-base">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $gallery->date->format('d M Y') }}</span>
                    </div>
                </div>
                
                <h1 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-2">
                    {{ $gallery->title }}
                </h1>
            </div>
        </div>
    </section>

    <!-- 2. Content Section -->
    <section class="py-6 md:py-10 relative bg-zinc-50 border-t border-zinc-100">
        
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Optional Description -->
            @if($gallery->description)
            <div class="max-w-4xl mb-10">
                <div class="text-zinc-700 leading-relaxed text-base md:text-lg">
                    {!! nl2br(e($gallery->description)) !!}
                </div>
            </div>
            @endif

            <!-- Video Section (If Exists) -->
            @if($gallery->video_url)
                @php
                    $embedUrl = $gallery->video_url;
                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $gallery->video_url, $matches)) {
                        $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                    }
                @endphp
                <div class="max-w-4xl mb-12 rounded-2xl overflow-hidden shadow-lg ring-1 ring-zinc-200">
                    <div class="aspect-w-16 aspect-h-9 relative w-full h-0 pb-[56.25%] bg-zinc-900">
                        <iframe 
                            src="{{ $embedUrl }}" 
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
            @if($gallery->images->count() > 0)
                <div x-data="{ 
                        lightboxOpen: false, 
                        currentIndex: 0,
                        images: {{ json_encode($gallery->images->map(fn($img) => asset($img->image_path))->toArray()) }}
                     }"
                     @keydown.escape.window="lightboxOpen = false"
                     @keydown.arrow-left.window="if(lightboxOpen) { currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1 }"
                     @keydown.arrow-right.window="if(lightboxOpen) { currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1 }"
                     class="relative">
                     
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                        @foreach($gallery->images as $index => $photo)
                            <div class="group relative rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 bg-white ring-1 ring-zinc-200 aspect-w-4 aspect-h-3">
                                <img src="{{ asset($photo->image_path) }}" alt="Gallery image {{ $index + 1 }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                
                                <button type="button" @click="lightboxOpen = true; currentIndex = {{ $index }}" class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/30 transition-colors duration-300 cursor-zoom-in flex items-center justify-center w-full h-full">
                                    <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Lightbox Modal -->
                    <template x-teleport="body">
                        <div x-show="lightboxOpen" 
                             x-transition.opacity.duration.300ms
                             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-sm"
                             style="display: none;">
                            
                            <!-- Close Button -->
                            <button type="button" @click="lightboxOpen = false" class="absolute top-4 right-4 md:top-6 md:right-6 text-white/70 hover:text-white z-[110] p-2 transition-colors">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <!-- Prev Button -->
                            <button type="button" @click.stop="currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1" class="absolute left-4 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-2 z-[110] hidden md:block transition-colors">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>

                            <!-- Next Button -->
                            <button type="button" @click.stop="currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-2 z-[110] hidden md:block transition-colors">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>

                            <!-- Image Container -->
                            <div class="relative w-full h-full flex items-center justify-center p-4 md:p-12" @click.self="lightboxOpen = false">
                                <img :src="images[currentIndex]" 
                                     class="max-w-full max-h-full object-contain rounded-sm shadow-2xl transition-all duration-300"
                                     alt="Lightbox Image">
                                     
                                <!-- Mobile Navigation (Bottom) -->
                                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center gap-6 md:hidden z-[110] bg-black/60 px-5 py-2 rounded-full backdrop-blur-md">
                                    <button type="button" @click.stop="currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1" class="text-white hover:text-gray-300 p-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                    </button>
                                    <span class="text-white font-medium text-sm" x-text="(currentIndex + 1) + ' / ' + images.length"></span>
                                    <button type="button" @click.stop="currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1" class="text-white hover:text-gray-300 p-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </button>
                                </div>
                                
                                <!-- Counter Desktop -->
                                <div class="absolute top-6 left-6 text-white/50 text-sm hidden md:block font-medium tracking-widest" x-text="(currentIndex + 1) + ' / ' + images.length"></div>
                            </div>
                        </div>
                    </template>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
