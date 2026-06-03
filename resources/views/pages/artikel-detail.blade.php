@extends('layouts.public')

@section('title', 'Membangun Kemandirian Ekonomi Desa - Komdes Sultra')

@section('content')
<!-- Main Content Area -->
<div class="bg-white py-28 lg:py-36 relative overflow-hidden">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
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
                        <span class="ml-1 md:ml-2 text-zinc-700 truncate max-w-[150px] sm:max-w-[300px]">Membangun Kemandirian Ekono...</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <!-- Main Article Content (Left) -->
            <div class="flex-1">
                <article class="bg-white rounded-2xl p-6 md:p-12 border border-zinc-100 shadow-sm">
                    <!-- Article Header Info -->
                    <div class="mb-8">
                        <div class="mb-4 flex items-center gap-3">
                            <span class="bg-secondary-500 text-zinc-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Esai</span>
                            <span class="text-sm text-zinc-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 
                                14 Mei 2024
                            </span>
                        </div>
                        
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-zinc-900 mb-6 leading-tight">Membangun Kemandirian Ekonomi Desa Lewat Koperasi Modern</h1>
                        
                        <div class="flex items-center gap-4 text-sm">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="Penulis" class="w-10 h-10 rounded-full shadow-sm border border-zinc-100">
                                <div class="text-left">
                                    <p class="font-bold text-zinc-900">Budi Santoso</p>
                                    <p class="text-xs text-zinc-500">Peneliti Senior Komdes</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cover Image -->
                    <div class="rounded-xl overflow-hidden mb-10 shadow-sm">
                        <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Menulis Esai" class="w-full object-cover max-h-[400px]">
                    </div>

                    <!-- Article Body (Typographic Focus) -->
                    <div class="text-zinc-700 leading-relaxed space-y-6 text-lg">
                        <p class="text-xl text-zinc-600 font-medium mb-8">Koperasi desa tidak lagi bisa hanya bergantung pada iuran anggota tradisional. Di era digital, inovasi dan digitalisasi pelayanan menjadi kunci utama kebangkitan ekonomi pedesaan.</p>

                        <p>Dalam kurun waktu satu dekade terakhir, penyaluran Dana Desa telah memberikan stimulus yang signifikan bagi pembangunan infrastruktur dasar di pedesaan. Namun, pertanyaan kritis yang sering muncul adalah: sejauh mana stimulus fiskal tersebut mampu melahirkan kemandirian ekonomi yang berkelanjutan?</p>
                        
                        <p>Jawabannya seringkali bermuara pada kelembagaan ekonomi tingkat lokal, dan koperasi adalah salah satu institusi yang memiliki pijakan historis serta filosofis paling kuat di Indonesia.</p>

                        <h3 class="font-heading font-bold text-2xl text-zinc-900 mt-10 mb-4">Tantangan Koperasi Konvensional</h3>
                        <p>Kenyataan di lapangan menunjukkan bahwa banyak koperasi desa (termasuk KUD di masa lalu) yang mati suri atau berjalan sekadar memenuhi kewajiban administratif. Penyebabnya beragam, mulai dari kurangnya kapasitas manajerial pengurus, minimnya inovasi produk, hingga kegagalan beradaptasi dengan perubahan perilaku konsumen yang semakin digital.</p>
                        
                        <div class="pl-6 border-l-4 border-primary-500 my-8 py-4 bg-primary-50 rounded-r-lg">
                            <p class="text-xl italic text-zinc-800 font-medium">
                                "Koperasi modern bukan berarti membuang nilai kekeluargaan, melainkan memperkuat nilai tersebut dengan instrumen teknologi dan tata kelola yang transparan."
                            </p>
                        </div>

                        <p>Membangun kemandirian ekonomi tidak bisa lagi dilakukan dengan pendekatan linear. Kita membutuhkan lompatan pemikiran, dan di sinilah konsep "Koperasi Modern" menemukan relevansinya.</p>

                        <h3 class="font-heading font-bold text-2xl text-zinc-900 mt-10 mb-4">Langkah Strategis Modernisasi</h3>
                        <p>Berdasarkan kajian lapangan di beberapa desa binaan Komdes Sultra, terdapat tiga pilar utama untuk membangkitkan kembali kekuatan koperasi desa:</p>
                        <ol class="list-decimal pl-6 space-y-3 mt-4">
                            <li><strong class="text-zinc-900">Digitalisasi Sistem Pelaporan:</strong> Transparansi adalah kunci kepercayaan. Penggunaan aplikasi pembukuan sederhana yang dapat diakses oleh anggota setiap saat akan menumbuhkan rasa kepemilikan yang kuat.</li>
                            <li><strong class="text-zinc-900">Diversifikasi Usaha Berbasis Potensi Lokal:</strong> Koperasi tidak boleh hanya terjebak pada simpan-pinjam konvensional. Mereka harus mulai melirik sektor riil, seperti pengemasan produk turunan hasil hutan bukan kayu (HHBK) atau pengelolaan pariwisata desa terpadu.</li>
                            <li><strong class="text-zinc-900">Pelibatan Kaum Muda:</strong> Regenerasi kepengurusan adalah mutlak. Pemuda desa membawa literasi digital dan jejaring pasar yang lebih luas.</li>
                        </ol>

                        <p class="mt-6">Kesimpulannya, desa-desa di Sulawesi Tenggara memiliki potensi sumber daya yang melimpah. Jika dikelola melalui institusi koperasi yang modern, inklusif, dan adaptif, kemandirian ekonomi desa bukan lagi sekadar slogan, melainkan realitas yang bisa segera diwujudkan.</p>
                    </div>

                    <!-- Tags -->
                    <div class="mt-12 pt-8 border-t border-zinc-100">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-zinc-900">Topik Terkait:</span>
                            <div class="flex flex-wrap gap-2">
                                <a href="#" class="px-3 py-1 bg-zinc-50 border border-zinc-200 text-zinc-600 text-xs rounded-lg hover:border-primary-500 hover:text-primary-600 transition-colors">#EkonomiDesa</a>
                                <a href="#" class="px-3 py-1 bg-zinc-50 border border-zinc-200 text-zinc-600 text-xs rounded-lg hover:border-primary-500 hover:text-primary-600 transition-colors">#Koperasi</a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Author Bio Box -->
                <div class="mt-8 bg-white rounded-2xl p-8 border border-zinc-100 shadow-sm flex flex-col md:flex-row gap-6 items-center md:items-start">
                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="Budi Santoso" class="w-20 h-20 rounded-full shadow-md">
                    <div class="text-center md:text-left">
                        <h4 class="font-heading font-bold text-lg text-zinc-900 mb-1">Budi Santoso</h4>
                        <p class="text-primary-600 text-sm font-semibold mb-3">Peneliti Senior di Divisi Pemberdayaan Komdes Sultra</p>
                        <p class="text-zinc-600 text-sm leading-relaxed">Fokus pada kajian sosiologi pedesaan dan ekonomi kerakyatan. Memiliki pengalaman lebih dari 10 tahun dalam mendampingi kelompok tani dan koperasi di berbagai daerah di Sulawesi Tenggara.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right Content) -->
            <div class="lg:w-[350px] flex-shrink-0">
                <div class="sticky top-28 space-y-8">
                    
                    <!-- Related Articles Widget -->
                    <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                        <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Tulisan Terkait</h3>
                        <div class="space-y-4">
                            <!-- Related Item 1 -->
                            <a href="#" class="group flex gap-4 items-start pb-4 border-b border-zinc-50">
                                <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1498623116890-37e912163d5d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Related" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-900 text-sm leading-snug line-clamp-2 group-hover:text-primary-600 transition-colors mb-2">Perempuan dan Akses Keadilan Ekologis di Pesisir Sultra</h4>
                                    <div class="flex items-center gap-2 text-xs text-zinc-500">
                                        <span class="font-medium">Siti Aisyah</span> • <span>10 Mei</span>
                                    </div>
                                </div>
                            </a>

                            <!-- Related Item 2 -->
                            <a href="#" class="group flex gap-4 items-start pb-4 border-b border-zinc-50">
                                <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Related" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div>
                                    <h4 class="font-bold text-zinc-900 text-sm leading-snug line-clamp-2 group-hover:text-primary-600 transition-colors mb-2">Langkah Taktis Menyusun RPJMDes yang Inklusif</h4>
                                    <div class="flex items-center gap-2 text-xs text-zinc-500">
                                        <span class="font-medium">Admin</span> • <span>05 Mei</span>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- View More Link -->
                            <div class="pt-2">
                                <a href="{{ route('artikel') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center justify-center w-full py-2 hover:bg-primary-50 rounded-lg transition-colors">
                                    Lihat Tulisan Serupa Lainnya
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
                        <h3 class="font-heading font-bold text-lg text-zinc-900 mb-4 border-b border-zinc-100 pb-2">Arsip Artikel</h3>
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
