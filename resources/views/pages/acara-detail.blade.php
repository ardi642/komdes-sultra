@extends('layouts.public')

@section('title', $event->title . ' - Komdes Sultra')

@section('content')
<!-- HERO SECTION (Teks Hijau) -->
<section class="bg-[#165a3f] pt-40 pb-32 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb (Teks Putih) -->
        <nav class="flex text-sm text-white/70 mb-10" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('acara') }}" class="ml-1 md:ml-2 hover:text-white transition-colors">Acara</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="ml-1 md:ml-2 text-white truncate max-w-[150px] sm:max-w-[300px]">{{ Str::limit($event->title, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <!-- Judul -->
        <div class="mb-6 flex gap-2">
            <span class="text-xs font-bold text-zinc-900 bg-[#FFD700] px-3 py-1.5 rounded-full uppercase tracking-wider">Acara</span>
        </div>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white leading-tight mb-4">{{ $event->title }}</h1>
    </div>
</section>

<!-- KONTEN BAWAH (Gambar Bersih & Teks) -->
<section class="bg-white pb-20 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Main Card -->
        <div class="bg-white rounded-3xl shadow-2xl border-4 border-white overflow-hidden -mt-24 relative z-20">
            
            <!-- Poster Wrapper -->
            @if($event->cover_image)
            <div class="w-full bg-zinc-900 flex justify-center relative border-b border-zinc-100">
                <!-- Blurred background for aesthetics -->
                <div class="absolute inset-0 opacity-40">
                    <img src="{{ asset($event->cover_image) }}" alt="Background Blur" class="w-full h-full object-cover blur-xl">
                </div>
                <!-- Actual Poster (Constrained to natural aspect ratio) -->
                <img src="{{ asset($event->cover_image) }}" alt="{{ $event->title }}" class="relative z-10 w-full max-w-2xl max-h-[600px] object-contain object-top">
            </div>
            @endif

            <div class="p-8 md:p-12">
                <!-- Info Box (Date & Location) -->
                <div class="bg-zinc-50 border border-zinc-100 rounded-2xl p-6 mb-10 flex flex-col sm:flex-row gap-6 sm:gap-12">
                    <div class="flex gap-4 items-start">
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-zinc-100 text-primary-500">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-1">Pelaksanaan</h4>
                            <p class="text-zinc-900 font-semibold">{{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('l, d F Y') }}</p>
                            @if($event->time)
                            <p class="text-zinc-500 text-sm">{{ $event->time }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex gap-4 items-start">
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-zinc-100 text-primary-500">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-1">Lokasi</h4>
                            <p class="text-zinc-900 font-semibold">{{ $event->location ?? 'Virtual' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description / Body Content -->
                <div class="text-zinc-600 leading-relaxed space-y-6 prose max-w-none">
                    {!! $event->content ?? $event->description !!}
                </div>

                <div class="mt-12 pt-8 border-t border-zinc-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    @include('partials.share-buttons', ['title' => $event->title])
                </div>

            </div>
        </div>
        
    </div>
</section>
@endsection
