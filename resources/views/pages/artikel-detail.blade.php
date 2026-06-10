@extends('layouts.public')

@section('title', 'Dialog Warga: Menyoroti Transparansi Dana Desa - Komdes Sultra')

@section('content')
<!-- Main Content Area -->
<div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pt-40 pb-20 relative z-20">
    <!-- Breadcrumb -->
    <nav class="flex text-sm text-zinc-500 mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <a href="{{ route('artikel') }}" class="ml-1 md:ml-2 hover:text-primary-600 transition-colors">Artikel</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="ml-1 md:ml-2 text-zinc-700 truncate max-w-[150px] sm:max-w-[300px]">{{ Str::limit($post->title, 30) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
        
        <!-- Main Article Content (Left) -->
        <div class="flex-1">
            <article class="bg-white rounded-2xl p-6 md:p-10 border border-zinc-100 shadow-sm">
                <!-- Article Header Info -->
                <div class="mb-8">
                    <div class="mb-4 flex items-center gap-3">
                        @if($post->category)
                        <span class="bg-secondary-500 text-zinc-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">{{ $post->category->name }}</span>
                        @endif
                        <span class="text-sm text-zinc-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 
                            {{ $post->published_at->format('d M Y') }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-zinc-900 mb-6 leading-tight">{{ $post->title }}</h1>
                    
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name ?? 'Admin') }}&background=random" alt="Penulis" class="w-10 h-10 rounded-full shadow-sm border border-zinc-100">
                            <div class="text-left">
                                <p class="font-bold text-zinc-900">{{ $post->author->name ?? 'Admin' }}</p>
                                <p class="text-xs text-zinc-500">Tim Redaksi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cover Image -->
                @if($post->cover_image)
                <div class="rounded-xl overflow-hidden mb-10 shadow-sm bg-zinc-100">
                    <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover aspect-[16/9] hover:scale-105 transition-transform duration-700">
                </div>
                @endif
                
                <!-- Article Text (Prose) -->
                <!-- Note: using standard Tailwind classes since Typography plugin might not be installed -->
                <div class="text-zinc-700 leading-relaxed space-y-6 prose max-w-none">
                    {!! $post->content !!}
                </div>
                
                <!-- Tags & Share (Bottom of article) -->
                <div class="mt-12 pt-8 border-t border-zinc-100 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-zinc-900">Tags:</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                            <a href="#" class="px-3 py-1 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#{{ $tag->name }}</a>
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
            </article>
        </div>

        <!-- Sidebar (Right Content) -->
        <div class="lg:w-[350px] flex-shrink-0">
            <div class="sticky top-28 space-y-8">
                
                <!-- Search Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Cari Artikel</h3>
                    <form action="#" method="GET" class="relative">
                        <input type="text" placeholder="Masukkan kata kunci..." class="w-full pl-4 pr-12 py-3 rounded-xl border border-zinc-200 bg-zinc-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm">
                        <button type="submit" class="absolute right-2 top-1.5 bottom-1.5 aspect-square bg-primary-600 hover:bg-primary-500 text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                <!-- Related News Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Artikel Terkait</h3>
                    <div class="space-y-4">
                        @forelse($relatedPosts as $related)
                        <!-- Related Item -->
                        <a href="{{ route('artikel.detail', $related->slug) }}" class="flex gap-4 group">
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-zinc-100">
                                <img src="{{ $related->cover_image ? asset($related->cover_image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div>
                                <h4 class="font-bold text-zinc-900 text-sm leading-snug line-clamp-2 group-hover:text-primary-600 transition-colors mb-1">{{ $related->title }}</h4>
                                <span class="text-xs text-zinc-500">{{ $related->published_at->format('d M Y') }}</span>
                            </div>
                        </a>
                        @empty
                        <p class="text-xs text-zinc-500 italic">Belum ada Artikel Terkait.</p>
                        @endforelse

                        <!-- View More Link -->
                        <div class="pt-2 border-t border-zinc-100">
                            <a href="{{ route('artikel') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center justify-center w-full py-2 hover:bg-primary-50 rounded-lg transition-colors">
                                Lihat Artikel Serupa Lainnya
                                <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Kategori</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center justify-between group">
                                <span class="text-sm text-zinc-600 group-hover:text-primary-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4 text-secondary-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    Pemberdayaan
                                </span>
                                <span class="bg-zinc-100 text-zinc-500 text-xs py-1 px-2.5 rounded-full group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between group">
                                <span class="text-sm text-zinc-600 group-hover:text-primary-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4 text-secondary-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    Lingkungan & Ekologi
                                </span>
                                <span class="bg-zinc-100 text-zinc-500 text-xs py-1 px-2.5 rounded-full group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">8</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between group">
                                <span class="text-sm text-zinc-600 group-hover:text-primary-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4 text-secondary-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    Gender & Sosial
                                </span>
                                <span class="bg-zinc-100 text-zinc-500 text-xs py-1 px-2.5 rounded-full group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">15</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between group">
                                <span class="text-sm text-zinc-600 group-hover:text-primary-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4 text-secondary-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    Pendidikan
                                </span>
                                <span class="bg-zinc-100 text-zinc-500 text-xs py-1 px-2.5 rounded-full group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">6</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between group">
                                <span class="text-sm text-zinc-600 group-hover:text-primary-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4 text-secondary-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    Kebijakan Publik
                                </span>
                                <span class="bg-zinc-100 text-zinc-500 text-xs py-1 px-2.5 rounded-full group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">11</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tags Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#DanaDesa</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#Mangrove</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#Perempuan</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#Konawe</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#Pelatihan</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#Advokasi</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#KeadilanIklim</a>
                    </div>
                </div>

                <!-- Arsip Widget (Collapsible Accordion) -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Arsip Artikel</h3>
                    <div class="space-y-3">
                        
                        <!-- Accordion Item 2024 -->
                        <div x-data="{ expanded: true }" class="border border-zinc-100 rounded-xl overflow-hidden">
                            <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-3 bg-zinc-50 hover:bg-primary-50 transition-colors text-sm font-semibold text-zinc-700 hover:text-primary-600 focus:outline-none group">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-zinc-400 group-hover:text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Tahun 2024
                                </span>
                                <svg class="w-4 h-4 transition-transform duration-300 text-zinc-400 group-hover:text-primary-500" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="expanded" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="bg-white border-t border-zinc-100" style="display: none;">
                                <ul class="p-2 space-y-1">
                                    <li>
                                        <a href="#" class="flex justify-between items-center px-3 py-2 text-sm text-zinc-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors group">
                                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-300 group-hover:bg-primary-500 transition-colors"></span>Mei</span> 
                                            <span class="text-xs font-medium bg-zinc-100 text-zinc-500 px-2 py-0.5 rounded-full group-hover:bg-white group-hover:text-primary-600">12</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex justify-between items-center px-3 py-2 text-sm text-zinc-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors group">
                                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-300 group-hover:bg-primary-500 transition-colors"></span>April</span> 
                                            <span class="text-xs font-medium bg-zinc-100 text-zinc-500 px-2 py-0.5 rounded-full group-hover:bg-white group-hover:text-primary-600">8</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex justify-between items-center px-3 py-2 text-sm text-zinc-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors group">
                                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-300 group-hover:bg-primary-500 transition-colors"></span>Maret</span> 
                                            <span class="text-xs font-medium bg-zinc-100 text-zinc-500 px-2 py-0.5 rounded-full group-hover:bg-white group-hover:text-primary-600">15</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Accordion Item 2023 -->
                        <div x-data="{ expanded: false }" class="border border-zinc-100 rounded-xl overflow-hidden">
                            <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-3 bg-zinc-50 hover:bg-primary-50 transition-colors text-sm font-semibold text-zinc-700 hover:text-primary-600 focus:outline-none group">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-zinc-400 group-hover:text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Tahun 2023
                                </span>
                                <svg class="w-4 h-4 transition-transform duration-300 text-zinc-400 group-hover:text-primary-500" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="expanded" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="bg-white border-t border-zinc-100" style="display: none;">
                                <ul class="p-2 space-y-1">
                                    <li>
                                        <a href="#" class="flex justify-between items-center px-3 py-2 text-sm text-zinc-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors group">
                                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-300 group-hover:bg-primary-500 transition-colors"></span>Desember</span> 
                                            <span class="text-xs font-medium bg-zinc-100 text-zinc-500 px-2 py-0.5 rounded-full group-hover:bg-white group-hover:text-primary-600">10</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex justify-between items-center px-3 py-2 text-sm text-zinc-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors group">
                                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-300 group-hover:bg-primary-500 transition-colors"></span>November</span> 
                                            <span class="text-xs font-medium bg-zinc-100 text-zinc-500 px-2 py-0.5 rounded-full group-hover:bg-white group-hover:text-primary-600">14</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="w-full text-center block mt-2 text-xs font-semibold text-primary-600 hover:text-primary-700">Lihat Semua Bulan...</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div>
@endsection

