@extends('layouts.public')

@section('title', 'Beranda - Komdes Sultra')

@section('content')
<!-- Hero Section -->
<section class="relative bg-zinc-900 overflow-hidden min-h-[85vh] flex items-center">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Masyarakat Desa" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-900 via-zinc-900/80 to-transparent"></div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="hidden md:block absolute top-1/4 right-0 w-96 h-96 bg-primary-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
    <div class="hidden md:block absolute bottom-1/4 right-1/4 w-72 h-72 bg-secondary-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20" style="animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-3xl">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-secondary-500 text-secondary-950 mb-6">
                <span class="w-2 h-2 rounded-full bg-secondary-900 mr-2 animate-ping"></span>
                Bersama Membangun Desa
            </span>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-tight mb-6">
                Suara Komunitas untuk <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-secondary-400">Keadilan</span> & Kesejahteraan
            </h1>
            <p class="text-lg md:text-xl text-zinc-300 mb-10 leading-relaxed max-w-2xl">
                Komdes Sultra hadir mengadvokasi hak-hak masyarakat sipil, melakukan riset aksi, dan mendorong kebijakan pembangunan berkelanjutan di Sulawesi Tenggara.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#" class="px-8 py-4 rounded-full text-base font-bold text-zinc-900 bg-secondary-400 hover:bg-secondary-300 shadow-lg shadow-secondary-500/30 hover:shadow-xl hover:shadow-secondary-500/40 hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                    Pelajari Isu Kami
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <a href="#" class="px-8 py-4 rounded-full text-base font-bold text-white bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 hover:-translate-y-1 transition-all duration-300">
                    Dukung Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Isu Tematik (Campaign Issues) -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
                <h2 class="text-secondary-600 font-bold tracking-wider uppercase text-sm mb-2">Fokus Advokasi</h2>
                <h3 class="font-heading text-4xl font-bold text-zinc-900 tracking-tight">Isu Tematik</h3>
                <p class="mt-4 text-zinc-600 text-lg">Area fokus kerja kami dalam mendorong perubahan struktural dan kebijakan yang berpihak pada masyarakat sipil.</p>
            </div>
            <a href="#" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors group">
                Lihat Semua Isu
                <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Isu 1 -->
            <div class="group relative rounded-3xl overflow-hidden bg-zinc-100 aspect-square">
                <img src="https://images.unsplash.com/photo-1621504450181-5d356f002206?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Keadilan Iklim" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 via-zinc-900/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center mb-4 text-white shadow-lg shadow-primary-500/40">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-heading text-2xl font-bold text-white mb-2 group-hover:text-primary-300 transition-colors">Keadilan Iklim & Ekologi</h4>
                    <p class="text-zinc-300 text-sm line-clamp-2 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0">Mendorong transisi energi berkeadilan dan pelestarian lingkungan berbasis kearifan lokal.</p>
                    <a href="#" class="inline-flex items-center text-secondary-400 font-medium text-sm hover:text-secondary-300">
                        Pelajari <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Isu 2 -->
            <div class="group relative rounded-3xl overflow-hidden bg-zinc-100 aspect-square">
                <img src="https://images.unsplash.com/photo-1558522195-e1201b090344?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Demokrasi Desa" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 via-zinc-900/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="w-12 h-12 bg-secondary-500 rounded-xl flex items-center justify-center mb-4 text-zinc-900 shadow-lg shadow-secondary-500/40">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="font-heading text-2xl font-bold text-white mb-2 group-hover:text-secondary-400 transition-colors">Demokrasi & Tata Kelola Desa</h4>
                    <p class="text-zinc-300 text-sm line-clamp-2 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0">Meningkatkan partisipasi warga dalam perencanaan dan penganggaran pembangunan desa.</p>
                    <a href="#" class="inline-flex items-center text-primary-400 font-medium text-sm hover:text-primary-300">
                        Pelajari <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Isu 3 -->
            <div class="group relative rounded-3xl overflow-hidden bg-zinc-100 aspect-square">
                <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Hak Perempuan" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 via-zinc-900/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center mb-4 text-white shadow-lg shadow-primary-600/40">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="font-heading text-2xl font-bold text-white mb-2 group-hover:text-primary-300 transition-colors">Pemberdayaan Perempuan</h4>
                    <p class="text-zinc-300 text-sm line-clamp-2 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0">Mendorong kesetaraan gender dan pemenuhan hak-hak perempuan serta kelompok rentan.</p>
                    <a href="#" class="inline-flex items-center text-secondary-400 font-medium text-sm hover:text-secondary-300">
                        Pelajari <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini -->
<section class="py-24 bg-zinc-50 border-t border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-primary-600 font-bold tracking-wider uppercase text-sm mb-2">Pusat Informasi</h2>
            <h3 class="font-heading text-4xl font-bold text-zinc-900 tracking-tight">Berita Terkini</h3>
            <p class="mt-4 text-zinc-600">Ikuti perkembangan terbaru mengenai kegiatan, advokasi, dan kabar terkini dari komunitas desa.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- News Card 1 -->
            <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574046664972-e565980fcbc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Rapat Desa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Berita</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 12 Mei 2024</span>
                        <span class="text-primary-600 font-medium">Kategori A</span>
                    </div>
                    <a href="#" class="block group-hover:text-primary-600 transition-colors">
                        <h4 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug line-clamp-2">Dialog Warga: Menyoroti Transparansi Dana Desa di Kabupaten Konawe</h4>
                    </a>
                    <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Komdes Sultra bersama tokoh masyarakat di Kabupaten Konawe menggelar dialog publik untuk mengevaluasi penggunaan dana desa tahun anggaran 2023.</p>
                    <a href="#" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                        Baca Selengkapnya
                        <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>

            <!-- News Card 2 -->
            <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Konservasi Hutan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Berita</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 08 Mei 2024</span>
                        <span class="text-primary-600 font-medium">Kategori B</span>
                    </div>
                    <a href="#" class="block group-hover:text-primary-600 transition-colors">
                        <h4 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug line-clamp-2">Pelatihan Pengelolaan Hasil Hutan Bukan Kayu (HHBK) untuk Kelompok Tani</h4>
                    </a>
                    <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Meningkatkan kapasitas ekonomi masyarakat pesisir hutan melalui pelatihan pengelolaan dan pemasaran produk turunan HHBK secara berkelanjutan.</p>
                    <a href="#" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                        Baca Selengkapnya
                        <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>

            <!-- News Card 3 -->
            <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Pemuda Desa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Berita</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center text-sm text-zinc-500 mb-3 gap-4">
                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 02 Mei 2024</span>
                        <span class="text-primary-600 font-medium">Kategori C</span>
                    </div>
                    <a href="#" class="block group-hover:text-primary-600 transition-colors">
                        <h4 class="font-heading text-xl font-bold text-zinc-900 mb-3 leading-snug line-clamp-2">Sekolah Pemuda Penggerak Desa Angkatan ke-5 Resmi Dibuka</h4>
                    </a>
                    <p class="text-zinc-600 mb-6 line-clamp-3 text-sm flex-grow">Sebanyak 30 pemuda dari berbagai kabupaten di Sultra mengikuti sekolah kepemimpinan untuk menjadi motor penggerak perubahan di desanya masing-masing.</p>
                    <a href="#" class="inline-flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                        Baca Selengkapnya
                        <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>
        </div>

        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center justify-center px-8 py-3.5 border-2 border-primary-600 text-primary-600 font-bold rounded-full hover:bg-primary-600 hover:text-white transition-colors duration-300">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- Beragam Konten (Publikasi, Riset, Agenda) -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Publikasi & Riset (Left Col, Span 8) -->
            <div class="lg:col-span-8">
                <div class="flex items-center justify-between mb-8 pb-4 border-b-2 border-zinc-100">
                    <h3 class="font-heading text-3xl font-bold text-zinc-900 flex items-center gap-3">
                        <div class="w-3 h-8 bg-secondary-500 rounded-full"></div>
                        Publikasi & Riset
                    </h3>
                    <a href="#" class="text-primary-600 font-medium hover:text-primary-700 flex items-center text-sm">
                        Semua Publikasi <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <div class="space-y-6">
                    <!-- Item Publikasi -->
                    <div class="group flex flex-col sm:flex-row gap-6 p-4 rounded-2xl hover:bg-zinc-50 border border-transparent hover:border-zinc-200 transition-all duration-300">
                        <div class="w-full sm:w-48 h-48 sm:h-32 rounded-xl overflow-hidden flex-shrink-0 relative">
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Riset" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-2 left-2 bg-zinc-900/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Publikasi Riset</div>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-xs font-semibold text-secondary-600 mb-1">Riset Tahunan</div>
                            <h4 class="font-heading text-lg font-bold text-zinc-900 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">Laporan Kajian Dampak Pertambangan Nikel terhadap Kesejahteraan Masyarakat Pesisir</h4>
                            <p class="text-sm text-zinc-500 line-clamp-2">Kajian komprehensif mengenai aspek sosial, ekonomi, dan ekologi pada tiga desa di lingkar tambang.</p>
                            <div class="mt-3 flex items-center text-xs text-zinc-400">
                                <span class="mr-4">20 April 2024</span>
                                <a href="#" class="text-primary-600 font-medium flex items-center hover:underline">
                                    Unduh PDF <svg class="ml-1 w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item Artikel -->
                    <div class="group flex flex-col sm:flex-row gap-6 p-4 rounded-2xl hover:bg-zinc-50 border border-transparent hover:border-zinc-200 transition-all duration-300">
                        <div class="w-full sm:w-48 h-48 sm:h-32 rounded-xl overflow-hidden flex-shrink-0 relative">
                            <img src="https://images.unsplash.com/photo-1455390582262-044cdead27d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Artikel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-2 left-2 bg-zinc-900/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Artikel</div>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-xs font-semibold text-secondary-600 mb-1">Opini</div>
                            <h4 class="font-heading text-lg font-bold text-zinc-900 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">Pentingnya Pelibatan Perempuan dalam Musyawarah Rencana Pembangunan Desa</h4>
                            <p class="text-sm text-zinc-500 line-clamp-2">Perspektif perempuan seringkali terabaikan, padahal mereka adalah pengelola utama ekonomi rumah tangga pedesaan.</p>
                            <div class="mt-3 flex items-center text-xs text-zinc-400">
                                <span>15 April 2024</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item Siaran Pers -->
                    <div class="group flex flex-col sm:flex-row gap-6 p-4 rounded-2xl hover:bg-zinc-50 border border-transparent hover:border-zinc-200 transition-all duration-300">
                        <div class="w-full sm:w-48 h-48 sm:h-32 rounded-xl bg-primary-50 flex-shrink-0 relative flex items-center justify-center border border-primary-100 text-primary-500">
                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                            <div class="absolute top-2 left-2 bg-primary-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Siaran Pers</div>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-xs font-semibold text-secondary-600 mb-1">Pernyataan Sikap</div>
                            <h4 class="font-heading text-lg font-bold text-zinc-900 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">Koalisi Masyarakat Sipil Menolak RUU Pertanahan yang Menindas Petani</h4>
                            <p class="text-sm text-zinc-500 line-clamp-2">Pernyataan bersama menyoroti pasal-pasal bermasalah yang berpotensi melanggengkan konflik agraria.</p>
                            <div class="mt-3 flex items-center text-xs text-zinc-400">
                                <span>10 April 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Acara (Right Col, Span 4) -->
            <div class="lg:col-span-4 mt-12 lg:mt-0">
                <div class="bg-primary-50 rounded-3xl p-8 border border-primary-100">
                    <h3 class="font-heading text-2xl font-bold text-zinc-900 mb-8 flex items-center gap-3">
                        <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Agenda Mendatang
                    </h3>

                    <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-primary-200 before:to-transparent">
                        
                        <!-- Event 1 -->
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <!-- Icon -->
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-primary-500 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 absolute left-0 md:left-1/2 -ml-5 md:ml-0 group-hover:scale-110 transition-transform">
                                <span class="text-xs font-bold">25</span>
                            </div>
                            <!-- Card -->
                            <div class="w-[calc(100%-3rem)] md:w-[calc(50%-2.5rem)] p-4 rounded border border-primary-100 bg-white shadow-sm hover:shadow-md transition-shadow ml-12 md:ml-0">
                                <div class="flex items-center justify-between space-x-2 mb-1">
                                    <div class="font-bold text-zinc-900 text-sm">Mei 2024</div>
                                    <time class="text-xs font-medium text-primary-600">09:00 WITA</time>
                                </div>
                                <div class="text-sm font-semibold text-zinc-800 mb-1 leading-tight group-hover:text-primary-600 transition-colors">Diskusi Publik: Masa Depan Hutan Mangrove</div>
                                <div class="text-xs text-zinc-500 flex items-start gap-1 mt-2">
                                    <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Hotel Claro, Kendari</span>
                                </div>
                            </div>
                        </div>

                        <!-- Event 2 -->
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                            <!-- Icon -->
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-zinc-200 text-zinc-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 absolute left-0 md:left-1/2 -ml-5 md:ml-0 group-hover:scale-110 group-hover:bg-primary-500 group-hover:text-white transition-all">
                                <span class="text-xs font-bold">12</span>
                            </div>
                            <!-- Card -->
                            <div class="w-[calc(100%-3rem)] md:w-[calc(50%-2.5rem)] p-4 rounded border border-zinc-100 bg-white shadow-sm hover:shadow-md transition-shadow ml-12 md:ml-0">
                                <div class="flex items-center justify-between space-x-2 mb-1">
                                    <div class="font-bold text-zinc-900 text-sm">Jun 2024</div>
                                    <time class="text-xs font-medium text-zinc-500">08:00 WITA</time>
                                </div>
                                <div class="text-sm font-semibold text-zinc-800 mb-1 leading-tight group-hover:text-primary-600 transition-colors">Pelatihan Pemetaan Partisipatif Wilayah Adat</div>
                                <div class="text-xs text-zinc-500 flex items-start gap-1 mt-2">
                                    <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Sekretariat Komdes</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <a href="#" class="mt-8 block text-center w-full py-3 rounded-xl bg-white border border-primary-200 text-primary-600 font-bold hover:bg-primary-600 hover:text-white transition-all duration-300 shadow-sm">
                        Lihat Seluruh Agenda
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 relative overflow-hidden bg-primary-600">
    <div class="absolute inset-0 z-0">
        <div class="hidden md:block absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-primary-500 opacity-50 blur-3xl"></div>
        <div class="hidden md:block absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-secondary-400 opacity-30 blur-3xl"></div>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6 tracking-tight">Mari Bergabung Menjadi Bagian dari Perubahan</h2>
        <p class="text-primary-100 text-lg mb-10 max-w-2xl mx-auto">Bersama kita bisa membangun tatanan sosial masyarakat desa yang lebih adil, mandiri, dan berdaulat atas sumber dayanya.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#" class="px-8 py-4 rounded-full text-base font-bold text-primary-700 bg-white hover:bg-zinc-50 shadow-lg hover:-translate-y-1 transition-all duration-300">
                Daftar Relawan
            </a>
            <a href="#" class="px-8 py-4 rounded-full text-base font-bold text-zinc-900 bg-secondary-400 hover:bg-secondary-300 shadow-lg hover:-translate-y-1 transition-all duration-300">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection
