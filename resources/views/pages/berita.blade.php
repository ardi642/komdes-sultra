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
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
        
        <!-- Articles Grid (Left Content) -->
        <div class="flex-1" x-data="{ showFilter: false }">
            
            <!-- Header & Toggle Button -->
            <div class="flex justify-between items-center mb-10">
                <div>
                    <div class="w-20 md:w-32 h-[1px] bg-[#165a3f] mb-4"></div>
                    <h2 class="font-heading font-bold text-xl md:text-2xl text-[#165a3f] uppercase tracking-widest">Semua Berita</h2>
                </div>
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
                        <!-- Kategori Dropdown -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3">
                            <span class="text-sm font-semibold text-zinc-700 flex-shrink-0">Kategori:</span>
                            <select name="kategori" class="bg-zinc-50 border border-zinc-200 text-zinc-700 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-40 p-2.5 transition-colors cursor-pointer outline-none">
                                <option value="">Semua Kategori</option>
                                <option value="pemberdayaan">Pemberdayaan</option>
                                <option value="lingkungan">Lingkungan & Ekologi</option>
                                <option value="gender">Gender & Sosial</option>
                                <option value="pendidikan">Pendidikan</option>
                            </select>
                        </div>

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
                    
                    <!-- Multi-Tags Select (UI Mockup) -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 w-full lg:w-auto flex-grow">
                        <span class="text-sm font-semibold text-zinc-700 flex-shrink-0">Tags:</span>
                        <div class="relative w-full">
                            <!-- Visual representation of selected tags -->
                            <div class="bg-zinc-50 border border-zinc-200 min-h-[42px] p-1.5 rounded-xl flex flex-wrap gap-1.5 items-center cursor-text transition-colors hover:border-primary-300">
                                <!-- Selected Tag 1 -->
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-primary-100 text-primary-700">
                                    #DanaDesa
                                    <button type="button" class="ml-1 text-primary-500 hover:text-primary-800 focus:outline-none">
                                        <svg class="h-3 w-3" stroke="currentColor" fill="none" viewBox="0 0 8 8"><path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path></svg>
                                    </button>
                                </span>
                                <!-- Selected Tag 2 -->
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-primary-100 text-primary-700">
                                    #Konawe
                                    <button type="button" class="ml-1 text-primary-500 hover:text-primary-800 focus:outline-none">
                                        <svg class="h-3 w-3" stroke="currentColor" fill="none" viewBox="0 0 8 8"><path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path></svg>
                                    </button>
                                </span>
                                <!-- Input Field -->
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
                
                <!-- News Item 1 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1574046664972-e565980fcbc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Rapat Desa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Pemberdayaan</div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 12 Mei 2024</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Admin</span>
                        </div>
                        
                        <!-- Isu Badge Mockup (Conditionally Rendered) -->
                        <a href="{{ route('isu.detail') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 mb-2 rounded-lg bg-primary-50 text-primary-700 text-xs font-bold border border-primary-100 hover:bg-primary-100 transition-colors w-fit">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            Keadilan Ekologis Pesisir
                        </a>

                        <a href="#" class="block group-hover:text-primary-600 transition-colors">
                            <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Dialog Warga: Menyoroti Transparansi Dana Desa di Kabupaten Konawe</h2>
                        </a>
                        <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Komdes Sultra bersama tokoh masyarakat di Kabupaten Konawe menggelar dialog publik untuk mengevaluasi penggunaan dana desa tahun anggaran 2023 dan mendorong partisipasi aktif warga.</p>
                        <a href="#" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </article>

                <!-- News Item 2 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Konservasi Hutan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Lingkungan</div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 08 Mei 2024</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Tim Peneliti</span>
                        </div>
                        <a href="#" class="block group-hover:text-primary-600 transition-colors">
                            <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Pelatihan Pengelolaan Hasil Hutan Bukan Kayu (HHBK) untuk Kelompok Tani</h2>
                        </a>
                        <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Meningkatkan kapasitas ekonomi masyarakat pesisir hutan melalui pelatihan pengelolaan dan pemasaran produk turunan HHBK secara berkelanjutan tanpa merusak ekosistem hutan lokal.</p>
                        <a href="#" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </article>

                <!-- News Item 3 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Pemuda Desa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Pendidikan</div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 02 Mei 2024</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Admin</span>
                        </div>
                        <a href="#" class="block group-hover:text-primary-600 transition-colors">
                            <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Sekolah Pemuda Penggerak Desa Angkatan ke-5 Resmi Dibuka</h2>
                        </a>
                        <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Sebanyak 30 pemuda dari berbagai kabupaten di Sultra mengikuti sekolah kepemimpinan untuk menjadi motor penggerak perubahan di desanya masing-masing dan belajar dasar advokasi kebijakan.</p>
                        <a href="#" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </article>

                <!-- News Item 4 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Diskusi Perempuan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Gender & Sosial</div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 28 April 2024</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Kontributor</span>
                        </div>
                        <a href="#" class="block group-hover:text-primary-600 transition-colors">
                            <h2 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug">Mendorong Keterwakilan Perempuan di BPD: Tantangan dan Harapan</h2>
                        </a>
                        <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Pentingnya mengawal kuota minimal keterwakilan perempuan dalam Badan Permusyawaratan Desa agar aspirasi dan kebutuhan kelompok rentan dapat diakomodasi dengan baik.</p>
                        <a href="#" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                            Baca Selengkapnya
                            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
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
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Cari Berita</h3>
                    <form action="#" method="GET" class="relative">
                        <input type="text" placeholder="Masukkan kata kunci..." class="w-full pl-4 pr-12 py-3 rounded-xl border border-zinc-200 bg-zinc-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm">
                        <button type="submit" class="absolute right-2 top-1.5 bottom-1.5 aspect-square bg-primary-600 hover:bg-primary-500 text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
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
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Arsip Berita</h3>
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
</div>
@endsection
