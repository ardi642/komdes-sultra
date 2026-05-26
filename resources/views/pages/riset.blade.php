@extends('layouts.public')

@section('title', 'Riset dan Publikasi - Komdes Sultra')

@section('content')
<!-- Hero Section (Split Layout like Greenpeace) -->
<div class="bg-white pt-32 pb-20 border-b border-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <!-- Text Content -->
            <div class="lg:w-1/2">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-extrabold text-zinc-900 mb-6 tracking-tight">Riset dan Publikasi</h1>
                <p class="text-lg text-zinc-600 leading-relaxed max-w-xl">
                    Kerja advokasi Komdes Sultra selalu berdasarkan pada temuan hasil investigasi, pemetaan lapangan, dan riset ilmiah. Berikut ini adalah kumpulan publikasi yang menjadi panduan dan referensi dalam perjuangan kami.
                </p>
            </div>
            <!-- Image Content -->
            <div class="lg:w-1/2 w-full">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] border border-zinc-200">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Riset Lapangan" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Campaigns Section -->
<div class="bg-zinc-50 py-16 border-b border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Bar -->
        <div class="max-w-3xl mx-auto mb-16">
            <form action="#" method="GET" class="relative shadow-md rounded-full overflow-hidden border border-zinc-200 bg-white flex transition-shadow hover:shadow-lg focus-within:shadow-lg focus-within:ring-2 focus-within:ring-primary-500">
                <input type="text" placeholder="Cari dokumen, jurnal, atau laporan riset..." class="w-full pl-8 pr-4 py-4 md:py-5 focus:outline-none focus:ring-0 border-none text-zinc-700 bg-transparent text-lg">
                <button type="submit" class="px-8 md:px-12 bg-primary-600 hover:bg-primary-700 text-white font-bold transition-colors text-lg flex items-center gap-2">
                    Cari
                </button>
            </form>
        </div>

        <!-- Topic Categories Icons -->
        <div class="text-center mb-8">
            <h2 class="font-heading font-extrabold text-2xl text-zinc-900 mb-10">Telusuri Berdasarkan Topik Riset</h2>
            <div class="flex flex-wrap justify-center gap-6 md:gap-12">
                <!-- Icon 1 -->
                <a href="#topik-tata-kelola" class="group flex flex-col items-center gap-4 w-28">
                    <div class="w-24 h-24 rounded-full border-[3px] border-primary-500 text-primary-600 flex items-center justify-center bg-white group-hover:bg-primary-600 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-sm">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-sm text-zinc-800 group-hover:text-primary-600 transition-colors flex items-center justify-center gap-1 text-center leading-tight">Tata Kelola Desa <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></span>
                </a>
                
                <!-- Icon 2 -->
                <a href="#topik-lingkungan" class="group flex flex-col items-center gap-4 w-28">
                    <div class="w-24 h-24 rounded-full border-[3px] border-primary-500 text-primary-600 flex items-center justify-center bg-white group-hover:bg-primary-600 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-sm">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <span class="font-bold text-sm text-zinc-800 group-hover:text-primary-600 transition-colors flex items-center justify-center gap-1 text-center leading-tight">Lingkungan Hidup <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></span>
                </a>

                <!-- Icon 3 -->
                <a href="#topik-agraria" class="group flex flex-col items-center gap-4 w-28">
                    <div class="w-24 h-24 rounded-full border-[3px] border-primary-500 text-primary-600 flex items-center justify-center bg-white group-hover:bg-primary-600 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-sm">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-bold text-sm text-zinc-800 group-hover:text-primary-600 transition-colors flex items-center justify-center gap-1 text-center leading-tight">Agraria & Sumber Daya <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></span>
                </a>

                <!-- Icon 4 -->
                <a href="#topik-kebijakan" class="group flex flex-col items-center gap-4 w-28">
                    <div class="w-24 h-24 rounded-full border-[3px] border-primary-500 text-primary-600 flex items-center justify-center bg-white group-hover:bg-primary-600 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-sm">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="font-bold text-sm text-zinc-800 group-hover:text-primary-600 transition-colors flex items-center justify-center gap-1 text-center leading-tight">Kebijakan Publik <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Sections (By Campaign) -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
        
        <!-- Category Section: Tata Kelola Desa -->
        <section id="topik-tata-kelola" class="scroll-mt-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-8 border-b border-zinc-200 pb-4 gap-4">
                <h2 class="font-heading font-extrabold text-3xl text-zinc-900">Tata Kelola Desa</h2>
                <a href="{{ route('riset.kategori') }}" class="font-bold text-sm text-zinc-600 hover:text-primary-600 transition-colors flex items-center gap-1 pb-1">
                    Lihat semua publikasi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
                <!-- Card 1 -->
                <article class="flex flex-col group cursor-pointer h-full">
                    <div class="relative w-full aspect-[4/3] overflow-hidden mb-4 bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Hutan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="text-primary-600 font-bold text-xs uppercase tracking-wider mb-2">Policy Brief</p>
                    <a href="{{ route('riset.detail') }}" class="block">
                        <h3 class="font-heading font-bold text-lg text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors mb-3">Deforestasi Lahan Kritis di Konawe Utara</h3>
                    </a>
                    <p class="text-zinc-600 text-sm line-clamp-3 mb-4 flex-grow">Analisis data satelit mengenai laju pembukaan lahan hutan yang berdampak pada krisis hidrologi dan mitigasi bencananya.</p>
                    <div class="text-xs font-semibold text-zinc-500 pt-3">Divisi Lingkungan &bull; 12 Mei 2024</div>
                </article>

                <!-- Card 2 -->
                <article class="flex flex-col group cursor-pointer h-full">
                    <div class="relative w-full aspect-[4/3] overflow-hidden mb-4 bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Sungai" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="text-primary-600 font-bold text-xs uppercase tracking-wider mb-2">Jurnal</p>
                    <a href="{{ route('riset.detail') }}" class="block">
                        <h3 class="font-heading font-bold text-lg text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors mb-3">Kualitas Air Sungai Landawe Pasca Tambang</h3>
                    </a>
                    <p class="text-zinc-600 text-sm line-clamp-3 mb-4 flex-grow">Pengujian kadar logam berat di sepanjang aliran sungai yang menjadi tumpuan warga akibat resiko iklim ekstrem.</p>
                    <div class="text-xs font-semibold text-zinc-500 pt-3">Tim Riset Independen &bull; 05 Apr 2024</div>
                </article>

                <!-- Card 3 -->
                <article class="flex flex-col group cursor-pointer h-full">
                    <div class="relative w-full aspect-[4/3] overflow-hidden mb-4 bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1591115765373-5207764f72e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Kebakaran" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="text-primary-600 font-bold text-xs uppercase tracking-wider mb-2">Laporan Tahunan</p>
                    <a href="{{ route('riset.detail') }}" class="block">
                        <h3 class="font-heading font-bold text-lg text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors mb-3">Rekapitulasi Emisi Karbon Sultra 2023</h3>
                    </a>
                    <p class="text-zinc-600 text-sm line-clamp-3 mb-4 flex-grow">Perhitungan estimasi peningkatan emisi dari sektor ekstraktif di wilayah Sulawesi Tenggara dan dampaknya terhadap masyarakat lokal.</p>
                    <div class="text-xs font-semibold text-zinc-500 pt-3">Komdes Sultra &bull; Jan 2024</div>
                </article>

                <!-- Card 4 -->
                <article class="flex flex-col group cursor-pointer h-full">
                    <div class="relative w-full aspect-[4/3] overflow-hidden mb-4 bg-zinc-100 flex items-center justify-center p-6 border border-zinc-200">
                        <!-- Book Cover Mockup -->
                        <div class="w-28 h-36 bg-white shadow-xl border border-zinc-200 flex flex-col p-2 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="h-2.5 w-full bg-primary-200 mb-1.5"></div>
                            <div class="h-2.5 w-2/3 bg-primary-200 mb-4"></div>
                            <div class="w-full bg-zinc-50 flex-grow rounded flex items-center justify-center text-zinc-400">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-primary-600 font-bold text-xs uppercase tracking-wider mb-2">Buku Panduan</p>
                    <a href="{{ route('riset.detail') }}" class="block">
                        <h3 class="font-heading font-bold text-lg text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors mb-3">Mitigasi Bencana Berbasis Desa</h3>
                    </a>
                    <p class="text-zinc-600 text-sm line-clamp-3 mb-4 flex-grow">Panduan lengkap bagi aparatur desa dalam memetakan potensi bencana hidrometeorologi secara komprehensif.</p>
                    <div class="text-xs font-semibold text-zinc-500 pt-3">Divisi Pemberdayaan &bull; Okt 2023</div>
                </article>
            </div>
        </section>

        <!-- Category Section: Lingkungan Hidup -->
        <section id="topik-lingkungan" class="scroll-mt-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-8 border-b border-zinc-200 pb-4 gap-4">
                <h2 class="font-heading font-extrabold text-3xl text-zinc-900">Lingkungan Hidup</h2>
                <a href="{{ route('riset.kategori') }}" class="font-bold text-sm text-zinc-600 hover:text-primary-600 transition-colors flex items-center gap-1 pb-1">
                    Lihat semua publikasi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
                <!-- Card 1 -->
                <article class="flex flex-col group cursor-pointer h-full">
                    <div class="relative w-full aspect-[4/3] overflow-hidden mb-4 bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Laut" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="text-primary-600 font-bold text-xs uppercase tracking-wider mb-2">Jurnal</p>
                    <a href="{{ route('riset.detail') }}" class="block">
                        <h3 class="font-heading font-bold text-lg text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors mb-3">Dampak Penambangan Pasir Laut terhadap Terumbu Karang Wawonii</h3>
                    </a>
                    <p class="text-zinc-600 text-sm line-clamp-3 mb-4 flex-grow">Investigasi menyeluruh atas berkurangnya tangkapan nelayan akibat sedimentasi pesisir yang merusak jaring rantai makanan.</p>
                    <div class="text-xs font-semibold text-zinc-500 pt-3">Universitas Haluoleo &bull; Feb 2024</div>
                </article>

                <!-- Card 2 -->
                <article class="flex flex-col group cursor-pointer h-full">
                    <div class="relative w-full aspect-[4/3] overflow-hidden mb-4 bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1574046664972-e565980fcbc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Mangrove" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="text-primary-600 font-bold text-xs uppercase tracking-wider mb-2">Policy Brief</p>
                    <a href="{{ route('riset.detail') }}" class="block">
                        <h3 class="font-heading font-bold text-lg text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors mb-3">Strategi Perlindungan Hutan Mangrove Teluk Kendari</h3>
                    </a>
                    <p class="text-zinc-600 text-sm line-clamp-3 mb-4 flex-grow">Rekomendasi penetapan kawasan konservasi mangrove untuk mencegah intrusi air laut dan abrasi lahan warga.</p>
                    <div class="text-xs font-semibold text-zinc-500 pt-3">Divisi Hukum & Advokasi &bull; Nov 2023</div>
                </article>

                <!-- Empty space to simulate partial row -->
                <div class="hidden lg:block"></div>
                <div class="hidden lg:block"></div>
            </div>
        </section>

    </div>
</div>

@endsection
