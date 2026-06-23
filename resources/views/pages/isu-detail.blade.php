@extends('layouts.public')

@section('title', 'Keadilan Ekologis Pesisir - Komdes Sultra')

@section('content')
<!-- Page Header / Issue Overview -->
<div class="relative pt-64 pb-48 overflow-hidden bg-[#165a3f]">
    <div class="hidden md:block absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row items-center gap-12">
        <!-- Logo -->
        <div class="w-32 h-32 md:w-40 md:h-40 flex-shrink-0 bg-white/10 rounded-2xl shadow-sm border border-white/20 flex items-center justify-center text-white backdrop-blur-sm overflow-hidden" data-aos="fade-right">
            @if($issue->cover_image)
            <img src="{{ asset($issue->cover_image) }}" alt="{{ $issue->title }}" class="w-full h-full object-cover">
            @elseif($issue->icon_svg)
            <div class="w-full h-full p-6 [&>svg]:w-full [&>svg]:h-full">{!! $issue->icon_svg !!}</div>
            @else
            <svg class="w-full h-full p-6" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            @endif
        </div>
        
        <!-- Text -->
        <div data-aos="fade-left" data-aos-delay="100">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white mb-4 uppercase tracking-widest drop-shadow-md">
                {{ $issue->title }}
            </h1>
            <p class="text-base md:text-lg text-white/90 font-light max-w-3xl leading-relaxed drop-shadow-sm">
                {{ $issue->description }}
            </p>
        </div>
    </div>
</div>

<!-- Aggregated Content Section -->
<div class="bg-white pt-10 pb-24 lg:pt-14 lg:pb-32 relative overflow-hidden" x-data="{ activeTab: 'semua' }">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <!-- Search & Filter Toggle Area -->
        <div x-data="{ showFilter: false }" class="relative z-10 mb-6" data-aos="fade-up">
            
            <div class="flex flex-col md:flex-row justify-between items-end gap-4">
                
                <!-- Breadcrumb (Kiri) -->
                <div class="w-full md:w-auto mb-2 md:mb-0 self-center md:self-end">
                    <nav class="flex text-sm text-zinc-500 font-medium" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    <a href="{{ route('isu') }}" class="ml-1 md:ml-2 hover:text-primary-600 transition-colors">Isu</a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    <span class="ml-1 md:ml-2 text-zinc-400 truncate max-w-[150px] sm:max-w-xs">{{ $issue->title }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <!-- Search & Filter Controls (Kanan) -->
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                    
                    <!-- Search Input Form -->
                    <form action="{{ route('isu.detail', $issue->slug) }}" method="GET" class="w-full sm:w-72 relative">
                        <!-- Persist existing filters when searching -->
                        @if(request('type')) <input type="hidden" name="type" value="{{ request('type') }}"> @endif
                        @if(request('tahun')) <input type="hidden" name="tahun" value="{{ request('tahun') }}"> @endif
                        @if(request('tag')) <input type="hidden" name="tag" value="{{ request('tag') }}"> @endif
                        
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tulisan..." class="w-full pl-4 pr-12 py-3 rounded-xl border border-zinc-200 bg-zinc-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm shadow-sm">
                        <button type="submit" class="absolute right-1 top-1 bottom-1 px-3 bg-white hover:bg-zinc-100 text-zinc-500 rounded-lg flex items-center justify-center transition-colors border border-transparent hover:border-zinc-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>

                    <!-- Filter Toggle Button -->
                    <button @click="showFilter = !showFilter" 
                            class="w-full sm:w-auto flex items-center justify-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl transition-all shadow-sm border"
                            :class="showFilter ? 'bg-primary-50 border-primary-200 text-primary-700' : 'bg-white border-zinc-200 text-zinc-700 hover:bg-zinc-50'">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        <span x-text="showFilter ? 'Tutup Filter' : 'Filter'"></span>
                    </button>
                </div>
            </div>

            <!-- Active Filter Pills -->
            @if(request()->hasAny(['tahun', 'tags', 'search']))
            <div x-show="!showFilter" x-transition class="flex flex-wrap justify-end items-center gap-2 mt-4 px-1">
                <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest mr-2">Filter Aktif:</span>
                
                @if(request('search'))
                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors shadow-sm gap-1.5 group">
                    Pencarian: "{{ request('search') }}"
                    <svg class="w-3.5 h-3.5 text-primary-400 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
                @endif
                
                @if(request('tahun'))
                <a href="{{ request()->fullUrlWithQuery(['tahun' => null]) }}" class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors shadow-sm gap-1.5 group">
                    Tahun: {{ request('tahun') }}
                    <svg class="w-3.5 h-3.5 text-primary-400 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
                @endif
                
                @if(request('tags'))
                @php 
                    $activeTagNames = \App\Models\Tag::whereIn('slug', (array)request('tags'))->pluck('name', 'slug');
                @endphp
                @foreach((array)request('tags') as $tagSlug)
                @php
                    $tagsArray = array_diff((array)request('tags'), [$tagSlug]);
                @endphp
                <a href="{{ request()->fullUrlWithQuery(['tags' => empty($tagsArray) ? null : $tagsArray]) }}" class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors shadow-sm gap-1.5 group">
                    Tag: {{ $activeTagNames[$tagSlug] ?? $tagSlug }}
                    <svg class="w-3.5 h-3.5 text-primary-400 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
                @endforeach
                @endif

                <a href="{{ route('isu.detail', $issue->slug) }}" class="ml-1 inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-100 hover:text-zinc-900 transition-colors shadow-sm uppercase tracking-wider">Reset Semua</a>
            </div>
            @endif

            <!-- Expanded Filter Form -->
            <div x-show="showFilter" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="bg-white rounded-2xl p-6 shadow-xl border border-zinc-200 mt-4 relative overflow-visible" 
                 style="display: none;">
                
                <form action="{{ route('isu.detail', $issue->slug) }}" method="GET" class="flex flex-col gap-6">
                    <!-- Hidden input for search to persist -->
                    @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <!-- Hidden input for type to persist since it's now handled by tabs -->
                    @if(request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif

                    <div class="flex flex-col md:flex-row items-end gap-5 w-full">
                        
                        <!-- Tahun Dropdown -->
                        <div class="flex flex-col gap-2 w-full md:w-1/4">
                            <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest pl-1">Tahun Publikasi</label>
                            <div class="relative">
                                <select name="tahun" class="appearance-none bg-white border border-zinc-200 text-zinc-700 text-sm font-medium rounded-2xl shadow-sm focus:ring-2 focus:ring-primary-500 focus:outline-none block w-full py-3 pl-4 pr-10 transition-all cursor-pointer hover:border-primary-300">
                                    <option value="">Semua Tahun</option>
                                    @foreach($availableYears as $year)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-zinc-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Smart Tags Select (Alpine Component) -->
                        <div class="flex flex-col gap-2 w-full md:w-2/5 relative" x-data="tagSelect()">
                            <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest pl-1">Cari & Pilih Tag</label>
                            
                            <!-- Render existing tags as hidden inputs -->
                            <template x-for="(tag, index) in selectedTags" :key="index">
                                <input type="hidden" name="tags[]" :value="tag.slug">
                            </template>

                            <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 min-h-[46px] p-1.5 flex flex-wrap gap-2 items-center cursor-text transition-all focus-within:ring-2 focus-within:ring-primary-500 hover:border-primary-300" @click="$refs.tagInput.focus()">
                                
                                <!-- Selected Tags Display -->
                                <template x-for="(tag, index) in selectedTags" :key="index">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100 shadow-sm animate-fade-in-up">
                                        #<span x-text="tag.name"></span>
                                        <button type="button" @click.stop="removeTag(index)" class="ml-1.5 text-primary-400 hover:text-primary-800 transition-colors focus:outline-none">
                                            <svg class="h-3.5 w-3.5" stroke="currentColor" fill="none" viewBox="0 0 8 8"><path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path></svg>
                                        </button>
                                    </span>
                                </template>

                                <!-- Smart Input Field -->
                                <div class="relative flex-grow min-w-[120px]">
                                    <input x-ref="tagInput" 
                                           x-model="newTag" 
                                           @input="updateSuggestions()"
                                           @focus="showSuggestions = true; updateSuggestions()"
                                           @click.away="showSuggestions = false"
                                           @keydown.enter.prevent="addTagFromInput()" 
                                           @keydown.backspace="if(newTag === '' && selectedTags.length > 0) removeTag(selectedTags.length - 1)"
                                           type="text" 
                                           placeholder="Ketik tag pilihanmu..." 
                                           class="bg-transparent border-none focus:ring-0 text-sm w-full p-1 text-zinc-800 placeholder-zinc-400 font-medium outline-none">
                                    
                                    <!-- Autocomplete Dropdown -->
                                    <div x-show="showSuggestions && suggestions.length > 0" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 translate-y-1"
                                         x-transition:enter-end="opacity-100 translate-y-0"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 translate-y-0"
                                         x-transition:leave-end="opacity-0 translate-y-1"
                                         class="absolute z-50 left-0 top-full mt-2 w-full min-w-[250px] max-w-sm bg-white rounded-2xl shadow-[0_10px_40px_rgb(0,0,0,0.08)] border border-zinc-100 overflow-hidden" 
                                         style="display: none;">
                                        <ul class="py-2 max-h-60 overflow-y-auto">
                                            <template x-for="suggestion in suggestions" :key="suggestion.slug">
                                                <li>
                                                    <button type="button" @click.stop="addTag(suggestion)" class="w-full text-left px-4 py-2.5 hover:bg-primary-50 transition-colors flex items-center justify-between group">
                                                        <span class="text-sm font-semibold text-zinc-700 group-hover:text-primary-700" x-text="'#' + suggestion.name"></span>
                                                        <svg class="w-4 h-4 text-primary-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                    </button>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end items-center gap-3 w-full md:flex-1 pt-4 md:pt-0">
                            <a href="{{ route('isu.detail', $issue->slug) }}" class="px-6 py-3 text-sm font-bold text-zinc-500 hover:text-zinc-700 hover:bg-zinc-100 rounded-xl transition-colors w-full sm:w-auto text-center border border-transparent hover:border-zinc-200">Reset</a>
                            <button type="submit" class="px-6 py-3 text-sm font-bold text-white bg-primary-600 hover:bg-primary-500 rounded-xl transition-colors shadow-sm w-full sm:w-auto">
                                Terapkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabs Navigation for Content Type -->
        <div class="border-b border-zinc-200 mb-8 overflow-x-auto hide-scrollbar" data-aos="fade-up">
            <ul class="flex space-x-8 min-w-max px-1">
                @php
                    $activeType = request('type', 'semua');
                @endphp
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['type' => null, 'page' => null]) }}" class="block whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $activeType === 'semua' ? 'border-primary-600 text-primary-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Semua Konten <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs {{ $activeType === 'semua' ? 'bg-primary-50 text-primary-600' : '' }}">{{ $typeCounts['semua'] ?? 0 }}</span>
                    </a>
                </li>
                @if(($typeCounts['berita'] ?? 0) > 0)
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['type' => 'berita', 'page' => null]) }}" class="block whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $activeType === 'berita' ? 'border-primary-600 text-primary-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Berita <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs {{ $activeType === 'berita' ? 'bg-primary-50 text-primary-600' : '' }}">{{ $typeCounts['berita'] ?? 0 }}</span>
                    </a>
                </li>
                @endif
                @if(($typeCounts['artikel'] ?? 0) > 0)
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['type' => 'artikel', 'page' => null]) }}" class="block whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $activeType === 'artikel' ? 'border-primary-600 text-primary-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Artikel <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs {{ $activeType === 'artikel' ? 'bg-primary-50 text-primary-600' : '' }}">{{ $typeCounts['artikel'] ?? 0 }}</span>
                    </a>
                </li>
                @endif
                @if(($typeCounts['riset'] ?? 0) > 0)
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['type' => 'riset', 'page' => null]) }}" class="block whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $activeType === 'riset' ? 'border-primary-600 text-primary-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Publikasi Riset <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs {{ $activeType === 'riset' ? 'bg-primary-50 text-primary-600' : '' }}">{{ $typeCounts['riset'] ?? 0 }}</span>
                    </a>
                </li>
                @endif
                @if(($typeCounts['siaran_pers'] ?? 0) > 0)
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['type' => 'siaran_pers', 'page' => null]) }}" class="block whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $activeType === 'siaran_pers' ? 'border-primary-600 text-primary-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Siaran Pers <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs {{ $activeType === 'siaran_pers' ? 'bg-primary-50 text-primary-600' : '' }}">{{ $typeCounts['siaran_pers'] ?? 0 }}</span>
                    </a>
                </li>
                @endif
                @if(($typeCounts['acara'] ?? 0) > 0)
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['type' => 'acara', 'page' => null]) }}" class="block whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $activeType === 'acara' ? 'border-primary-600 text-primary-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Acara <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs {{ $activeType === 'acara' ? 'bg-primary-50 text-primary-600' : '' }}">{{ $typeCounts['acara'] ?? 0 }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="200">
            @forelse($relatedPosts as $post)
            <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <span class="absolute top-4 left-4 z-10 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">{{ ucfirst(str_replace('_', ' ', $post->type)) }}</span>
                    @if($post->cover_image)
                        <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-zinc-50 flex flex-col items-center justify-center text-zinc-300 group-hover:bg-zinc-100 group-hover:scale-105 transition-all duration-500">
                            <svg class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Komdes Sultra</span>
                        </div>
                    @endif                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <a href="{{ route(str_replace('_', '-', $post->type) . '.detail', $post->slug) }}" class="block group-hover:text-primary-600 transition-colors">
                        <h3 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">{{ Str::limit($post->title, 60) }}</h3>
                    </a>
                    <p class="text-zinc-500 mb-6 line-clamp-3 text-sm leading-relaxed">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-zinc-100">
                        <span class="text-xs font-semibold text-zinc-900">{{ $post->author->name ?? 'Admin' }}</span>
                        <span class="text-xs text-zinc-400">{{ \Carbon\Carbon::parse($post->published_at)->locale('id')->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20">
                <svg class="w-16 h-16 text-zinc-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <p class="text-zinc-500 font-medium">Belum ada konten terkait filter ini.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $relatedPosts->links() }}
        </div>
    </div>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tagSelect', () => ({
            newTag: '',
            // Fetch all global tags directly to ensure availability
            availableTags: @json(\App\Models\Tag::all(['name', 'slug'])),
            selectedTagSlugs: @json((array) request('tags', [])),
            selectedTags: [],
            suggestions: [],
            showSuggestions: false,
            
            init() {
                // Pre-fill selectedTags object array from URL slugs
                this.selectedTags = this.availableTags.filter(tag => this.selectedTagSlugs.includes(tag.slug));
            },

            updateSuggestions() {
                const query = this.newTag.trim().toLowerCase();
                if (query === '') {
                    this.suggestions = this.availableTags.filter(t => !this.selectedTagSlugs.includes(t.slug)).slice(0, 8);
                } else {
                    this.suggestions = this.availableTags.filter(t => 
                        !this.selectedTagSlugs.includes(t.slug) && 
                        (t.name.toLowerCase().includes(query) || t.slug.toLowerCase().includes(query))
                    ).slice(0, 8);
                }
            },
            
            addTag(tagObj) {
                if (!this.selectedTagSlugs.includes(tagObj.slug)) {
                    this.selectedTags.push(tagObj);
                    this.selectedTagSlugs.push(tagObj.slug);
                }
                this.newTag = '';
                this.showSuggestions = false;
                this.$refs.tagInput.focus();
                this.updateSuggestions();
            },

            addTagFromInput() {
                const query = this.newTag.trim().toLowerCase();
                if (query !== '') {
                    const found = this.availableTags.find(t => t.name.toLowerCase() === query || t.slug.toLowerCase() === query);
                    if (found) {
                        this.addTag(found);
                    } else if (this.suggestions.length > 0) {
                        this.addTag(this.suggestions[0]);
                    }
                }
            },
            
            removeTag(index) {
                this.selectedTags.splice(index, 1);
                this.selectedTagSlugs.splice(index, 1);
                this.updateSuggestions();
            }
        }));
    });
</script>
@endsection
