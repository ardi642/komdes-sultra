@extends('layouts.public')

@section('title', $post->title . ' - Komdes Sultra')

@section('content')
<!-- HERO SECTION (Teks Hijau) -->
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
                        <a href="{{ route('siaran-pers') }}" class="ml-1 md:ml-2 hover:text-white transition-colors">Siaran Pers</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="ml-1 md:ml-2 text-white truncate max-w-[150px] sm:max-w-[300px]">{{ Str::limit($post->title, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <!-- Judul & Meta -->
        <div class="max-w-4xl">
            <div class="mb-6 flex flex-wrap items-center gap-3">
                @if($post->category)
                <span class="bg-secondary-500 text-zinc-900 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">{{ $post->category->name }}</span>
                @endif
                @if($post->issues && $post->issues->count() > 0)
                    @foreach($post->issues as $issue)
                        <span class="bg-white/20 text-white border border-white/30 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide backdrop-blur-sm">Isu {{ $issue->title }}</span>
                    @endforeach
                @endif
                <span class="text-sm text-white/80 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 
                    {{ $post->published_at->format('d M Y') }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white mb-8 leading-tight">{{ $post->title }}</h1>
            
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name ?? 'Admin') }}&background=random" alt="Penulis" class="w-10 h-10 rounded-full shadow-sm border border-white/20">
                    <div class="text-left">
                        <p class="font-bold text-white">{{ $post->author->name ?? 'Admin' }}</p>
                        <p class="text-xs text-white/70">{{ $post->author->posisi ?? 'Tim Redaksi' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KONTEN BAWAH (Gambar Bersih & Teks) -->
<section class="bg-white pb-20 relative">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <!-- Main Article Content (Left) -->
            <div class="flex-1">
                <article class="-mt-24 relative z-20">
                    <div class="bg-white rounded-2xl border border-zinc-100 shadow-sm overflow-hidden">
                        <!-- Cover Image -->
                        @if($post->cover_image)
                        <div class="w-full bg-zinc-100 border-b border-zinc-100">
                            <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-full max-h-[600px] object-contain">
                        </div>
                        @endif
                        
                        <div class="p-6 md:p-10">
                            <!-- Article Text (Prose) -->
                        <div class="text-zinc-700 leading-relaxed space-y-6 prose max-w-none">
                            {!! $post->content !!}
                        </div>
                        
                        <!-- Tags & Share -->
                        <div class="mt-12 pt-8 border-t border-zinc-100 flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-semibold text-zinc-900">Tags:</span>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                    <a href="{{ route('siaran-pers', ['tags' => [$tag->slug]]) }}" class="px-3 py-1 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-600 hover:text-white transition-colors">#{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3">
                            @include('partials.share-buttons', ['title' => $post->title])
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar (Right Content) -->
            <div class="w-full lg:w-[350px] flex-shrink-0 lg:-mt-24 relative z-20">
                @include('partials.post-sidebar', [
                    'searchRoute' => route('siaran-pers'),
                    'relatedPosts' => $relatedPosts ?? collect()
                ])
            </div>
            
        </div>
    </div>
</section>
@endsection
