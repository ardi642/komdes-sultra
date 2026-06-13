@extends('layouts.public')

@section('title', 'Kategori: Tata Kelola Desa - Riset & Publikasi Komdes Sultra')

@section('content')
<!-- Page Header -->
<div class="relative pt-56 pb-40 overflow-hidden bg-[#165a3f]">
    <div class="absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

        <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white mb-6 uppercase tracking-widest drop-shadow-md">Tata Kelola Desa</h1>
        <p class="text-base md:text-lg text-white/90 font-light leading-relaxed drop-shadow-sm max-w-2xl mx-auto">Kumpulan publikasi terkait panduan administratif, perencanaan pembangunan (RPJMDes), dan transparansi anggaran.</p>
    </div>
</div>

<!-- Main Content Area -->
<div class="bg-white py-28 lg:py-36 relative overflow-hidden">
<div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
        
        <!-- Articles Grid (Left Content) -->
        <div class="flex-1" x-data="{ showFilter: false }">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-zinc-500 hover:text-primary-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-zinc-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('riset') }}" class="ml-1 md:ml-2 text-zinc-500 hover:text-primary-600 transition-colors">Publikasi Riset</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-zinc-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 md:ml-2 text-zinc-800 font-medium">Tata Kelola Desa</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header & Toggle Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-heading font-bold text-xl md:text-2xl text-[#165a3f] uppercase tracking-widest">Semua Publikasi</h2>
                <button @click="showFilter = !showFilter" 
                        class="flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-lg transition-colors border"
                        :class="showFilter ? 'bg-primary-50 border-primary-200 text-primary-700' : 'bg-white border-zinc-200 text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900'">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    <span x-text="showFilter ? 'Sembunyikan Filter' : 'Filter Lanjutan'">Filter Lanjutan</span>
                </button>
            </div>

            <!-- Active Filters Bar (Collapsible) -->
            <div x-show="showFilter" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="bg-white p-5 rounded-2xl border border-zinc-100 shadow-sm mb-8" style="display: none;">
                <form action="#" method="GET" class="flex flex-col lg:flex-row flex-wrap gap-5 justify-between items-start lg:items-center" x-data="{ selectedYear: '' }">
                    
                    <!-- Select Dropdowns (Left Side) -->
                    <div class="flex flex-col sm:flex-row flex-wrap gap-4 w-full lg:w-auto">
                        <!-- Tahun Dropdown -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3">
                            <span class="text-sm font-semibold text-zinc-700 flex-shrink-0">Tahun:</span>
                            <select name="tahun" x-model="selectedYear" class="bg-zinc-50 border border-zinc-200 text-zinc-700 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-32 p-2.5 transition-colors cursor-pointer outline-none">
                                <option value="">Semua Tahun</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                        
                        <!-- Bulan Dropdown (Muncul jika tahun dipilih) -->
                        <div x-show="selectedYear !== ''" style="display: none;" class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3">
                            <span class="text-sm font-semibold text-zinc-700 flex-shrink-0">Bulan:</span>
                            <select name="bulan" class="bg-zinc-50 border border-zinc-200 text-zinc-700 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-32 p-2.5 transition-colors cursor-pointer outline-none">
                                <option value="">Semua Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Multi-Tags Select (UI Mockup) -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 w-full lg:w-auto flex-grow">
                        <span class="text-sm font-semibold text-zinc-700 flex-shrink-0">Tags:</span>
                        <div class="relative w-full">
                            <!-- Visual representation of selected tags -->
                            <div class="bg-zinc-50 border border-zinc-200 min-h-[42px] p-1.5 rounded-xl flex flex-wrap gap-1.5 items-center cursor-text transition-colors hover:border-primary-300">
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-primary-100 text-primary-700">
                                    #DanaDesa
                                    <button type="button" class="ml-1 text-primary-500 hover:text-primary-800 focus:outline-none">
                                        <svg class="h-3 w-3" stroke="currentColor" fill="none" viewBox="0 0 8 8"><path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path></svg>
                                    </button>
                                </span>
                                <input type="text" placeholder="Ketik tag..." class="bg-transparent border-none focus:ring-0 text-sm w-24 p-1 text-zinc-700 placeholder-zinc-400 outline-none">
                            </div>
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 w-full sm:w-auto mt-2 lg:mt-0">
                        <button type="reset" class="px-5 py-2.5 text-sm font-semibold text-zinc-600 bg-zinc-100 hover:bg-zinc-200 rounded-xl transition-colors w-full sm:w-auto flex-shrink-0">Reset</button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-500 rounded-xl transition-colors shadow-sm w-full sm:w-auto flex-shrink-0">Terapkan</button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                
                <!-- Riset Item 1 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1574046664972-e565980fcbc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Rapat Desa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 12 Mei 2024</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Divisi Riset</span>
                        </div>
                        
                        <!-- Isu Badge Mockup (Conditionally Rendered) -->
                        <a href="{{ route('isu.detail') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 mb-2 rounded-lg bg-primary-50 text-primary-700 text-xs font-bold border border-primary-100 hover:bg-primary-100 transition-colors w-fit">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            Transparansi Dana Desa
                        </a>

                        <a href="{{ route('riset.detail') }}" class="block group-hover:text-primary-600 transition-colors">
                            <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Panduan Transparansi Dana Desa</h2>
                        </a>
                        <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Langkah demi langkah bagi pengurus BPD dan aparat desa untuk menyajikan laporan yang terbuka dan dapat diakses oleh semua warga.</p>
                        
                        <!-- Tags List (Card level) -->
                        <div class="mt-auto pt-4 border-t border-zinc-100">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2 py-1 bg-zinc-100 text-zinc-500 text-xs rounded-md">#DanaDesa</span>
                                <span class="px-2 py-1 bg-zinc-100 text-zinc-500 text-xs rounded-md">#RPJMDes</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Riset Item 2 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Jurnal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 08 Mei 2024</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Akademisi</span>
                        </div>
                        <a href="{{ route('riset.detail') }}" class="block group-hover:text-primary-600 transition-colors">
                            <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Efektivitas BUMDes dalam Pemulihan Ekonomi</h2>
                        </a>
                        <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Analisis kuantitatif mengenai peran BUMDes dalam menggerakkan ekonomi lokal pasca pandemi di berbagai daerah Sultra.</p>
                        
                        <!-- Tags List (Card level) -->
                        <div class="mt-auto pt-4 border-t border-zinc-100">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2 py-1 bg-zinc-100 text-zinc-500 text-xs rounded-md">#BUMDes</span>
                                <span class="px-2 py-1 bg-zinc-100 text-zinc-500 text-xs rounded-md">#EkonomiLokal</span>
                            </div>
                        </div>
                    </div>
                </article>
                
            </div>

            <!-- Pagination (Static Placeholder) -->
            <div class="flex justify-center mb-12">
                <nav class="inline-flex items-center gap-1 bg-white p-1 rounded-full border border-zinc-200 shadow-sm">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-500 hover:bg-zinc-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-600 text-white font-bold shadow-sm">1</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">2</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">3</a>
                    <span class="w-10 h-10 flex items-center justify-center text-zinc-400">...</span>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">8</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-500 hover:bg-zinc-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Sidebar (Right Content) -->
        <div class="lg:w-[350px] flex-shrink-0">
            <div class="sticky top-28 space-y-8">
                
                <!-- Search Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Cari Riset</h3>
                    <form action="#" method="GET" class="relative">
                        <input type="text" placeholder="Masukkan kata kunci..." class="w-full pl-4 pr-12 py-3 rounded-xl border border-zinc-200 bg-zinc-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm">
                        <button type="submit" class="absolute right-2 top-1.5 bottom-1.5 aspect-square bg-primary-600 hover:bg-primary-500 text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                <!-- Tags Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#DanaDesa</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#RPJMDes</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#BUMDes</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#Transparansi</a>
                        <a href="#" class="px-3 py-1.5 bg-zinc-100 text-zinc-600 text-xs rounded-lg hover:bg-primary-500 hover:text-white transition-colors">#EkonomiLokal</a>
                    </div>
                </div>

                <!-- Arsip Widget (Collapsible Accordion) -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Arsip Riset: Tata Kelola Desa</h3>
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
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div>
</div>
@endsection
