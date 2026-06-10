@extends('layouts.public')

@section('title', 'Artikel & Opini - Komdes Sultra')

@section('content')
<!-- Page Header -->
<div class="relative pt-40 pb-32 overflow-hidden bg-[#165a3f]">
    <div class="absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <div class="w-32 h-[1px] bg-white mx-auto mb-6 opacity-50"></div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white uppercase tracking-widest mb-6 drop-shadow-md">Artikel</h1>
            <p class="text-white/90 text-base md:text-lg font-light leading-relaxed drop-shadow-sm max-w-2xl mx-auto">Kumpulan esai, opini, dan kajian dari Lembaga Swadaya Masyarakat.</p>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="bg-white relative overflow-hidden py-28 lg:py-36">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <!-- Articles List (Left Content) -->
            <div class="flex-1" x-data="{ showFilter: false }">
                
                @include('partials.post-filter', ['title' => 'Tulisan Terbaru'])

                <!-- Horizontal Article Cards -->
                <div class="space-y-6 mb-12">
                    @forelse($posts as $post)
                    <!-- Article Item -->
                    <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row group">
                        <div class="relative md:w-2/5 h-64 md:h-auto overflow-hidden">
                            <img src="{{ $post->cover_image ? asset($post->cover_image) : 'https://images.unsplash.com/photo-1455390582262-044cdead2708?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-6 md:p-8 flex flex-col justify-center md:w-3/5">
                            @if($post->category)
                            <div class="flex items-center gap-3 mb-4">
                                <span class="bg-primary-50 text-primary-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">{{ $post->category->name }}</span>
                            </div>
                            @endif
                            
                            @if($post->issues->isNotEmpty())
                            <a href="{{ route('isu.detail', $post->issues->first()->slug) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 mb-2 rounded-lg bg-primary-50 text-primary-700 text-xs font-bold border border-primary-100 hover:bg-primary-100 transition-colors w-fit">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                                {{ $post->issues->first()->title }}
                            </a>
                            @endif

                            <a href="{{ route('artikel.detail', $post->slug) }}" class="block group-hover:text-primary-600 transition-colors">
                                <h2 class="font-heading text-2xl font-bold text-zinc-900 mb-3 leading-snug">{{ $post->title }}</h2>
                            </a>
                            <p class="text-zinc-500 mb-6 line-clamp-3 text-sm leading-relaxed">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                            
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-zinc-200 overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name ?? 'Admin') }}&background=random" alt="{{ $post->author->name ?? 'Admin' }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="text-sm">
                                        <p class="font-semibold text-zinc-900">{{ $post->author->name ?? 'Admin' }}</p>
                                        <p class="text-zinc-500 text-xs">Penulis</p>
                                    </div>
                                </div>
                                <span class="text-xs text-zinc-400">{{ $post->published_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="text-center py-12">
                        <p class="text-zinc-500">Belum ada artikel yang diterbitkan.</p>
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
