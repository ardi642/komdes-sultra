@extends('layouts.public')

@section('title', 'Keadilan Ekologis Pesisir - Komdes Sultra')

@section('content')
<!-- Page Header / Issue Overview -->
<div class="bg-zinc-50 pt-32 pb-16 relative border-b border-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row items-center gap-8">
        <!-- Logo -->
        <div class="w-32 h-32 md:w-40 md:h-40 flex-shrink-0 bg-white rounded-2xl shadow-sm border border-zinc-100 flex items-center justify-center text-primary-600 p-6">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
        
        <!-- Text -->
        <div>
            <!-- Breadcrumb -->
            <nav class="flex text-sm text-zinc-500 mb-4" aria-label="Breadcrumb">
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
                </ol>
            </nav>
            
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-extrabold text-zinc-900 mb-4">
                Keadilan Ekologis Pesisir
            </h1>
            <p class="text-lg text-zinc-600 max-w-3xl leading-relaxed">
                Mendampingi masyarakat pesisir di Sulawesi Tenggara dalam menghadapi dampak krisis iklim dan proyek ekstraktif, serta mengadvokasi perlindungan sumber daya alam yang berkelanjutan dan pengakuan wilayah kelola rakyat.
            </p>
        </div>
    </div>
</div>

<!-- Aggregated Content Section -->
<div class="bg-white py-12" x-data="{ activeTab: 'semua' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter & Search Bar -->
        <div class="mb-8 bg-zinc-50 p-5 rounded-2xl border border-zinc-100 shadow-sm" x-data="{ selectedYear: '' }">
            <form action="#" method="GET" class="flex flex-col lg:flex-row flex-wrap gap-5 justify-between items-start lg:items-center">
                
                <!-- Select Dropdowns (Left Side) -->
                <div class="flex flex-col sm:flex-row flex-wrap gap-4 w-full lg:w-auto">
                    <!-- Tahun Dropdown -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3">
                        <span class="text-sm font-semibold text-zinc-700 flex-shrink-0">Tahun:</span>
                        <select name="tahun" x-model="selectedYear" class="bg-white border border-zinc-200 text-zinc-700 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-32 p-2.5 transition-colors cursor-pointer outline-none shadow-sm">
                            <option value="">Semua Tahun</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>

                    <!-- Bulan Dropdown -->
                    <div x-show="selectedYear !== ''" style="display: none;" class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3">
                        <span class="text-sm font-semibold text-zinc-700 flex-shrink-0">Bulan:</span>
                        <select name="bulan" class="bg-white border border-zinc-200 text-zinc-700 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-32 p-2.5 transition-colors cursor-pointer outline-none shadow-sm">
                            <option value="">Semua Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                
                <!-- Search and Action Buttons (Right Side) -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full lg:w-auto flex-grow justify-end">
                    <div class="relative w-full sm:w-64 lg:w-72">
                        <input type="text" name="search" placeholder="Cari di isu ini..." class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-zinc-200 bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm shadow-sm">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 w-full sm:w-auto mt-2 sm:mt-0">
                        <button type="reset" class="px-4 py-2.5 text-sm font-semibold text-zinc-600 bg-white hover:bg-zinc-100 border border-zinc-200 rounded-xl transition-colors w-full sm:w-auto flex-shrink-0">Reset</button>
                        <button type="submit" class="px-4 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-500 rounded-xl transition-colors shadow-sm w-full sm:w-auto flex-shrink-0">Terapkan</button>
                    </div>
                </div>
                
            </form>
        </div>

        <!-- Tabs Navigation -->
        <div class="border-b border-zinc-200 mb-8 overflow-x-auto hide-scrollbar">
            <ul class="flex space-x-8 min-w-max px-1">
                <li>
                    <button @click="activeTab = 'semua'" :class="{'border-primary-600 text-primary-600': activeTab === 'semua', 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300': activeTab !== 'semua'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors">
                        Semua Konten <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs" :class="{'bg-primary-50 text-primary-600': activeTab === 'semua'}">24</span>
                    </button>
                </li>
                <li>
                    <button @click="activeTab = 'berita'" :class="{'border-primary-600 text-primary-600': activeTab === 'berita', 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300': activeTab !== 'berita'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors">
                        Berita <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs" :class="{'bg-primary-50 text-primary-600': activeTab === 'berita'}">12</span>
                    </button>
                </li>
                <li>
                    <button @click="activeTab = 'artikel'" :class="{'border-primary-600 text-primary-600': activeTab === 'artikel', 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300': activeTab !== 'artikel'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors">
                        Artikel <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs" :class="{'bg-primary-50 text-primary-600': activeTab === 'artikel'}">5</span>
                    </button>
                </li>
                <li>
                    <button @click="activeTab = 'riset'" :class="{'border-primary-600 text-primary-600': activeTab === 'riset', 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300': activeTab !== 'riset'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors">
                        Publikasi Riset <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs" :class="{'bg-primary-50 text-primary-600': activeTab === 'riset'}">3</span>
                    </button>
                </li>
                <li>
                    <button @click="activeTab = 'siaran'" :class="{'border-primary-600 text-primary-600': activeTab === 'siaran', 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300': activeTab !== 'siaran'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors">
                        Siaran Pers <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs" :class="{'bg-primary-50 text-primary-600': activeTab === 'siaran'}">2</span>
                    </button>
                </li>
                <li>
                    <button @click="activeTab = 'acara'" :class="{'border-primary-600 text-primary-600': activeTab === 'acara', 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300': activeTab !== 'acara'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-colors">
                        Acara <span class="ml-2 bg-zinc-100 text-zinc-600 py-0.5 px-2 rounded-full text-xs" :class="{'bg-primary-50 text-primary-600': activeTab === 'acara'}">2</span>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Contents -->
        <div class="min-h-[500px]">
            
            <!-- "Semua" Tab (Mixed content layout) -->
            <div x-show="activeTab === 'semua'" x-transition.opacity.duration.300ms>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <!-- Content Card (Berita) -->
                    <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                        <div class="relative h-56 overflow-hidden">
                            <span class="absolute top-4 left-4 z-10 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">Berita</span>
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Thumb" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <a href="{{ route('berita.detail') }}" class="block group-hover:text-primary-600 transition-colors">
                                <h3 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Nelayan Konawe Kepulauan Tuntut Pemulihan Lingkungan Pesisir</h3>
                            </a>
                            <p class="text-zinc-500 mb-6 line-clamp-3 text-sm leading-relaxed">Ratusan nelayan melakukan aksi damai menyuarakan dampak kerusakan terumbu karang akibat aktivitas penambangan pasir laut.</p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-zinc-100">
                                <span class="text-xs font-semibold text-zinc-900">Komdes Sultra</span>
                                <span class="text-xs text-zinc-400">12 Mei 2024</span>
                            </div>
                        </div>
                    </article>

                    <!-- Content Card (Riset) -->
                    <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                        <div class="relative h-56 overflow-hidden bg-zinc-100 flex items-center justify-center">
                            <span class="absolute top-4 left-4 z-10 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">Publikasi Riset</span>
                            <div class="w-24 h-32 bg-white shadow-md border border-zinc-200 rounded flex flex-col items-center justify-center p-2 transform group-hover:-rotate-3 transition-transform duration-300">
                                <div class="w-full h-2 bg-indigo-100 rounded-sm mb-1"></div>
                                <div class="w-3/4 h-2 bg-indigo-100 rounded-sm mb-auto"></div>
                                <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center mb-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <a href="{{ route('riset.detail') }}" class="block group-hover:text-primary-600 transition-colors">
                                <h3 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Pemetaan Deforestasi Hutan Mangrove Sultra 2023</h3>
                            </a>
                            <p class="text-zinc-500 mb-6 line-clamp-3 text-sm leading-relaxed">Laporan komprehensif mengenai laju penyusutan hutan mangrove di pesisir Sulawesi Tenggara beserta rekomendasi kebijakan restorasi.</p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-zinc-100">
                                <span class="text-xs font-semibold text-zinc-900">Jurnal Akademik</span>
                                <span class="text-xs text-zinc-400">01 Apr 2024</span>
                            </div>
                        </div>
                    </article>

                    <!-- Content Card (Artikel) -->
                    <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                        <div class="relative h-56 overflow-hidden">
                            <span class="absolute top-4 left-4 z-10 bg-rose-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">Artikel</span>
                            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Thumb" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <a href="{{ route('artikel.detail') }}" class="block group-hover:text-primary-600 transition-colors">
                                <h3 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug line-clamp-2">Perempuan Pesisir Menjadi Ujung Tombak Resiliensi Iklim</h3>
                            </a>
                            <p class="text-zinc-500 mb-6 line-clamp-3 text-sm leading-relaxed">Analisis tentang peran vital perempuan nelayan dalam menghadapi anomali cuaca ekstrim dan menjaga ketahanan pangan keluarga.</p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-zinc-100">
                                <span class="text-xs font-semibold text-zinc-900">Opini</span>
                                <span class="text-xs text-zinc-400">10 Mei 2024</span>
                            </div>
                        </div>
                    </article>

                </div>
                
                <div class="mt-10 text-center">
                    <button class="bg-zinc-100 hover:bg-zinc-200 text-zinc-700 font-semibold py-3 px-6 rounded-xl transition-colors">
                        Muat Lebih Banyak Konten
                    </button>
                </div>
            </div>

            <!-- "Berita" Tab -->
            <div x-show="activeTab === 'berita'" style="display: none;" x-transition.opacity.duration.300ms>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Placeholder cards for Berita -->
                    <div class="bg-zinc-50 rounded-2xl h-80 flex flex-col items-center justify-center border-2 border-dashed border-zinc-200">
                        <span class="text-zinc-400 font-semibold">Berita Terkait 1</span>
                    </div>
                    <div class="bg-zinc-50 rounded-2xl h-80 flex flex-col items-center justify-center border-2 border-dashed border-zinc-200">
                        <span class="text-zinc-400 font-semibold">Berita Terkait 2</span>
                    </div>
                </div>
            </div>

            <!-- "Artikel" Tab -->
            <div x-show="activeTab === 'artikel'" style="display: none;" x-transition.opacity.duration.300ms>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-zinc-50 rounded-2xl h-80 flex flex-col items-center justify-center border-2 border-dashed border-zinc-200">
                        <span class="text-zinc-400 font-semibold">Artikel Terkait 1</span>
                    </div>
                </div>
            </div>
            
            <!-- Other tabs just empty placeholders for now -->
            <div x-show="activeTab === 'riset' || activeTab === 'siaran' || activeTab === 'acara'" style="display: none;" x-transition.opacity.duration.300ms>
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-zinc-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <p class="text-zinc-500 font-medium">Belum ada konten di kategori ini yang menggunakan tag isu ini.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
