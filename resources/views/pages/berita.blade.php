@extends('layouts.public')

@section('title', 'Berita Terkini - Komdes Sultra')

@section('content')
<!-- Page Header -->
<div class="relative pt-40 pb-32 overflow-hidden bg-[#165a3f]">
    <!-- Ambient Glow -->
    <div class="absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <div class="w-32 h-[1px] bg-white mx-auto mb-6 opacity-50"></div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white uppercase tracking-widest mb-6 drop-shadow-md">Berita Terkini</h1>
            <p class="text-white/90 text-base md:text-lg max-w-2xl mx-auto font-light leading-relaxed drop-shadow-sm">Kabar terbaru seputar advokasi, program kerja, dan dinamika komunitas desa di Sulawesi Tenggara.</p>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="relative bg-white py-28 lg:py-36 overflow-hidden">
    <!-- Ambient Glow Elements -->
    <div class="absolute right-0 top-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full blur-[120px] pointer-events-none opacity-30 translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">
        
        <!-- Articles Grid (Left Content) -->
        <div class="flex-1" x-data="{ showFilter: false }">
            
            @include('partials.post-filter', ['title' => 'Semua Berita'])

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                @forelse($posts as $post)
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $post->cover_image ? asset($post->cover_image) : 'https://images.unsplash.com/photo-1574046664972-e565980fcbc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($post->category)
                        <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">{{ $post->category->name }}</div>
                        @endif
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $post->published_at->format('d M Y') }}</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> {{ $post->author->name ?? 'Admin' }}</span>
                        </div>
                        
                        @if($post->issues->isNotEmpty())
                        <a href="{{ route('isu.detail', $post->issues->first()->slug) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 mb-2 rounded-lg bg-primary-50 text-primary-700 text-xs font-bold border border-primary-100 hover:bg-primary-100 transition-colors w-fit">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            {{ $post->issues->first()->title }}
                        </a>
                        @endif

                        <a href="{{ route('berita.detail', $post->slug) }}" class="block group-hover:text-primary-600 transition-colors">
                            <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">{{ $post->title }}</h2>
                        </a>
                        <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                        <a href="{{ route('berita.detail', $post->slug) }}" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700 mt-auto">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-2 text-center py-12">
                    <p class="text-zinc-500">Belum ada berita yang diterbitkan.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Sidebar (Right Content) -->
        <div class="lg:w-[350px] flex-shrink-0">
            @include('partials.post-sidebar')
        </div>
        
    </div>
</div>
</div>
@endsection
