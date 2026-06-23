@extends('layouts.public')

@section('title', 'Riset dan Publikasi - Komdes Sultra')

@section('content')
<!-- Hero Section -->
<div class="relative pt-64 pb-48 overflow-hidden bg-[#165a3f]">
    <div class="hidden md:block absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center" data-aos="fade-up">

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white uppercase tracking-widest mb-6 drop-shadow-md">Riset dan Publikasi</h1>
            <p class="text-white/90 text-base md:text-lg font-light leading-relaxed drop-shadow-sm max-w-2xl mx-auto">{{ \App\Models\SiteSetting::where('key', 'hero_research_text')->value('value') }}</p>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="bg-white relative overflow-hidden py-28 lg:py-36">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">
            
            <!-- Articles List (Left Content) -->
            <div class="w-full lg:w-auto lg:flex-1" x-data="{ showFilter: false }">
                
                @include('partials.post-filter', ['title' => 'Publikasi Riset'])

                <!-- Articles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @forelse($posts as $post)
                    <!-- Article Item -->
                    <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="relative h-48 sm:h-56 overflow-hidden">
                            @if($post->cover_image)
                                <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-zinc-50 flex flex-col items-center justify-center text-zinc-300 group-hover:bg-zinc-100 group-hover:scale-105 transition-all duration-500">
                                    <svg class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Komdes Sultra</span>
                                </div>
                            @endif                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                                <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ \Carbon\Carbon::parse($post->published_at)->locale('id')->translatedFormat('d F Y') }}</span>
                                <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> {{ $post->author->name ?? 'Admin' }}</span>
                            </div>
                            
                            @php
                                $allTags = $post->tags;
                            @endphp
                            @if($allTags->isNotEmpty())
                            <div class="flex flex-wrap gap-2 mb-3" x-data="{ expanded: false }">
                                @foreach($allTags->take(3) as $tag)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-zinc-100 text-zinc-600 text-[11px] font-semibold uppercase tracking-wider border border-zinc-200/60">
                                    #{{ $tag->name }}
                                </span>
                                @endforeach
                                
                                @if($allTags->count() > 3)
                                <template x-if="expanded">
                                    <div class="contents">
                                        @foreach($allTags->skip(3) as $tag)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-zinc-100 text-zinc-600 text-[11px] font-semibold uppercase tracking-wider border border-zinc-200/60">
                                            #{{ $tag->name }}
                                        </span>
                                        @endforeach
                                    </div>
                                </template>
                                <button x-show="!expanded" @click.prevent="expanded = true" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-primary-50 text-primary-600 text-[11px] font-bold hover:bg-primary-100 transition-colors cursor-pointer">
                                    +{{ $allTags->count() - 3 }} lainnya
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                @endif
                            </div>
                            @endif

                            <a href="{{ route('riset.detail', $post->slug) }}" class="block group-hover:text-primary-600 transition-colors">
                                <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">{{ $post->title }}</h2>
                            </a>
                            <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                            <a href="{{ route('riset.detail', $post->slug) }}" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700 mt-auto">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-1 md:col-span-2 text-center py-12">
                        <p class="text-zinc-500">Belum ada riset dan publikasi yang diterbitkan.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar (Right Content) -->
            <div class="w-full lg:w-[350px] flex-shrink-0" data-aos="fade-left" data-aos-delay="200">
                @include('partials.post-sidebar')
            </div>
            
        </div>
    </div>
</div>

@endsection
