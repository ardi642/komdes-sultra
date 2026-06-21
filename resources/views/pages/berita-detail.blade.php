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
                        <a href="{{ route('berita') }}" class="ml-1 md:ml-2 hover:text-white transition-colors">Berita</a>
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
                                    <a href="{{ route('berita', ['tags' => [$tag->slug]]) }}" class="px-3 py-1 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-600 hover:text-white transition-colors">#{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-semibold text-zinc-900">Bagikan:</span>
                                <div class="flex gap-2">
                                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Share to Facebook"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                                    <a href="#" class="w-8 h-8 rounded-full bg-sky-100 text-sky-500 flex items-center justify-center hover:bg-sky-500 hover:text-white transition-colors" title="Share to Twitter"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                                    <a href="#" class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition-colors" title="Share to WhatsApp"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar (Right Content) -->
            <div class="lg:w-[350px] flex-shrink-0 lg:-mt-24 relative z-20">
                @include('partials.post-sidebar', [
                    'searchRoute' => route('berita'),
                    'relatedPosts' => $relatedPosts ?? collect()
                ])
            </div>
            
        </div>
    </div>
</section>
@endsection
