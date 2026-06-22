@extends('layouts.public')

@section('title', 'Galeri - Komdes Sultra')

@section('content')

<!-- Main Content Area -->
<main class="w-full">

    <!-- 1. Header Section -->
    <div class="relative pt-64 pb-48 overflow-hidden bg-[#165a3f]">
        <div class="absolute right-0 bottom-0 w-[600px] h-[600px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 translate-y-1/4 bg-white"></div>
        <div class="max-w-[90rem] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="text-center mt-10 mb-8 max-w-4xl mx-auto" data-aos="fade-up">

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold mb-6 tracking-widest uppercase text-white drop-shadow-md">Galeri Kegiatan</h1>
                <p class="text-base md:text-lg text-white/90 leading-relaxed drop-shadow-sm font-light">
                    Jelajahi berbagai momen dan aktivitas yang merekam semangat kolaborasi Komdes Sultra.
                </p>
            </div>
        </div>
    </div>

    <!-- 2. Grid Galeri & Filter (White Background) -->
    <section class="py-16 lg:py-24 relative overflow-hidden bg-white">
        
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Filters & Search Wrapper -->
            <div class="mb-12" x-data="{ showFilter: false }" data-aos="fade-up">
                
                <!-- Toggle Button -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-zinc-900">Kumpulan Galeri</h2>
                    
                    <button @click="showFilter = !showFilter" type="button" class="inline-flex items-center gap-2 bg-white border border-zinc-200 text-zinc-700 hover:bg-zinc-50 hover:text-primary-600 font-medium rounded-full text-sm px-5 py-2.5 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 transition-transform duration-300" :class="showFilter ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        <span x-text="showFilter ? 'Tutup Filter' : 'Cari & Filter'"></span>
                    </button>
                </div>

                <!-- Summary Filter Aktif -->
                @if(request()->filled('q') || request()->filled('tahun') || request()->filled('bulan'))
                <div x-show="!showFilter" x-transition class="flex items-center flex-wrap gap-4 mb-6">
                    <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest">Filter Aktif:</span>
                    <div class="flex flex-wrap items-center gap-2">
                        @if(request('q'))
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Pencarian: "{{ request('q') }}"</span>
                        @endif
                        @if(request('tahun') && !request('bulan'))
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Tahun: {{ request('tahun') }}</span>
                        @endif
                        @if(request('bulan') && request('tahun'))
                            @php 
                                $monthNames = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Bulan: {{ $monthNames[request('bulan')] ?? request('bulan') }} {{ request('tahun') }}</span>
                        @endif
                        @if(request('bulan') && !request('tahun'))
                            @php 
                                $monthNames = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Bulan: {{ $monthNames[request('bulan')] ?? request('bulan') }}</span>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Filters Form -->
                <div x-show="showFilter" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-4"
                     class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-zinc-100/50 relative z-20 origin-top mb-8"
                     style="display: none;">
                    
                    <form action="{{ route('galeri') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                        
                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto flex-grow max-w-4xl">
                            <!-- Search Box -->
                            <div class="relative w-full flex-grow sm:max-w-md">
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari galeri kegiatan..." class="w-full bg-zinc-50 border border-zinc-200 text-zinc-800 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block pl-10 p-3 transition-colors">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                            </div>

                            <!-- Month Filter -->
                            <div class="relative w-full sm:w-48">
                                <select name="bulan" class="w-full bg-zinc-50 border border-zinc-200 text-zinc-800 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block p-3 appearance-none transition-colors">
                                    <option value="">Semua Bulan</option>
                                    @php
                                        $months = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                        ];
                                    @endphp
                                    @foreach($months as $key => $name)
                                        <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>

                            <!-- Year Filter -->
                            <div class="relative w-full sm:w-48">
                                <select name="tahun" class="w-full bg-zinc-50 border border-zinc-200 text-zinc-800 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block p-3 appearance-none transition-colors">
                                    <option value="">Semua Tahun</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Search Button -->
                        <div class="flex items-center gap-3 w-full sm:w-auto mt-4 sm:mt-0">
                            @if(request()->filled('q') || request()->filled('tahun') || request()->filled('bulan'))
                                <a href="{{ route('galeri') }}" class="text-zinc-500 hover:text-red-500 text-sm font-medium transition-colors px-3">Reset</a>
                            @endif
                            <button type="submit" class="w-full sm:w-auto bg-[#165a3f] hover:bg-primary-700 text-white font-medium rounded-xl text-sm px-6 py-3 transition-colors shadow-sm whitespace-nowrap">
                                Terapkan Filter
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>

            <!-- Cards Grid -->
            @if($galleries->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12 mb-16">
                @foreach($galleries as $item)
                <a href="{{ route('galeri.detail', $item->slug) }}" class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <!-- Thumbnail with overlay -->
                    <div class="relative h-64 overflow-hidden bg-zinc-100">
                        @if($item->thumbnail)
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @elseif($item->images->count() > 0)
                            <img src="{{ asset($item->images->first()->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        


                        <!-- Overlay gradient on hover -->
                        <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/10 transition-colors duration-300"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 md:p-8 flex flex-col flex-grow bg-white">
                        <!-- Meta -->
                        <div class="flex items-center gap-4 text-sm text-zinc-500 mb-4 font-medium">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->date->format('d M Y') }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->images->count() }} Foto
                            </span>
                        </div>

                        <!-- Title -->
                        <h2 class="font-heading text-xl md:text-2xl font-bold text-zinc-900 leading-snug mb-6 group-hover:text-primary-600 transition-colors duration-300">
                            {{ $item->title }}
                        </h2>

                        <!-- Spacer -->
                        <div class="flex-grow"></div>

                        <!-- Action Link -->
                        <div class="mt-4 inline-flex items-center text-sm font-bold text-primary-600 group-hover:text-primary-700">
                            Lihat Detail
                            <svg class="ml-1 w-4 h-4 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-zinc-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <h3 class="text-xl font-bold text-zinc-900 mb-2">Galeri Tidak Ditemukan</h3>
                <p class="text-zinc-500">Belum ada galeri kegiatan untuk saat ini atau kata kunci pencarian tidak cocok.</p>
            </div>
            @endif
            
            <!-- Pagination -->
            <div class="flex justify-center mb-12">
                {{ $galleries->links() }}
            </div>
            
        </div>
    </section>
</main>
@endsection
