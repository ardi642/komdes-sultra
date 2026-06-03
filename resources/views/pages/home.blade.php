@extends('layouts.public')

@section('title', 'Beranda - Komdes Sultra')

@section('content')

<!-- 1. HERO SECTION (Latar Gambar dengan Overlay Hijau Gelap) -->
<section class="relative h-[85vh] min-h-[600px] flex items-center bg-[#0d3b29] overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1498623116890-37e912163d5d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Komdes Sultra" class="w-full h-full object-cover mix-blend-overlay opacity-50" />
    </div>

    <!-- Ambient Glow Putih (Subtle) -->
    <div class="absolute right-0 bottom-0 w-[600px] h-[600px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 translate-y-1/4 bg-white"></div>

    <div class="relative z-10 max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-3xl">
            <!-- Tipografi Diperkecil -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white leading-snug mb-6 drop-shadow-md tracking-wide uppercase">
                Menjaga Ekosistem Pesisir,<br>
                Memberdayakan Masyarakat.
            </h1>
            <p class="text-base md:text-lg text-white/90 mb-10 max-w-2xl drop-shadow-sm font-light leading-relaxed">
                Simpul pergerakan dan kolaborasi untuk perlindungan ruang hidup nelayan tradisional di Sulawesi Tenggara.
            </p>

        </div>
    </div>
</section>

<!-- 2. TENTANG KAMI (HIJAU SOLID) -->
<section class="py-28 lg:py-36 bg-[#165a3f] relative overflow-hidden">
    <!-- Ambient Glow Putih -->
    <div class="absolute left-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 -translate-x-1/3 -translate-y-1/4 bg-white"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-20">
            <!-- Teks Kiri -->
            <div class="lg:w-1/2">
                <!-- Aksen Garis & Judul Elegan -->
                <div class="mb-10">
                    <div class="w-32 h-[1px] bg-white mb-4"></div>
                    <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest">
                        Tentang Komdes Sultra
                    </h2>
                </div>

                <div class="text-white/90 text-base md:text-lg font-light leading-loose space-y-6">
                    <p>
                        KOMUNITAS MASYARAKAT DESA-SULAWESI TENGGARA (Komdes Sultra) adalah organisasi masyarakat sipil yang memfokuskan diri pada isu-isu pesisir, laut, dan pulau-pulau kecil. Berdiri sebagai respons terhadap tantangan degradasi ekosistem dan ketidakadilan ruang yang dialami oleh masyarakat pesisir.
                    </p>
                    <p>
                        Melalui pengorganisasian akar rumput, riset partisipatif, dan kampanye kebijakan, kami berupaya memastikan hak-hak nelayan tradisional terlindungi dan sumber daya alam dikelola secara adil dan berkelanjutan bagi generasi mendatang.
                    </p>
                </div>
                
                <div class="mt-12 flex flex-wrap gap-4">
                    <a href="{{ route('tentang-kami') }}" class="inline-flex items-center px-8 py-3 bg-white border border-white text-[#165a3f] text-sm uppercase tracking-widest font-bold rounded-full hover:bg-zinc-100 transition-all duration-300 shadow-lg">
                        Tentang Kami
                    </a>
                    <a href="{{ route('kontak') }}" class="inline-flex items-center px-8 py-3 border border-white/60 text-white text-sm uppercase tracking-widest font-medium rounded-full hover:bg-white hover:text-[#165a3f] hover:border-white transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Gambar Kanan -->
            <div class="lg:w-1/2 w-full">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-video group border-4 border-white/10 bg-black/20">
                    <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kegiatan Komdes Sultra" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-in-out">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. ANGGOTA JARING (PUTIH) -->
<section class="py-28 lg:py-36 bg-white relative overflow-hidden">
    <!-- Ambient Glow Hijau (Meniru kontak.blade.php) -->
    <div class="absolute right-0 top-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full blur-[120px] pointer-events-none opacity-40 translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>
    <div class="absolute left-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-30 -translate-x-1/3 translate-y-1/3" style="background-color: var(--color-primary-50, #f0fdf4);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-20 text-center">
            <div class="w-32 h-[1px] bg-primary-600 mx-auto mb-4"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-4">
                Anggota Jaring Komdes Sultra
            </h2>
            <p class="text-zinc-500 text-base md:text-lg font-light">Jejaring komunitas dan organisasi lokal yang bergerak bersama kami.</p>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-12 lg:gap-20 items-center justify-items-center mb-20">
            @for($i=1; $i<=8; $i++)
            <div class="w-28 h-28 md:w-40 md:h-40 flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-500 hover:scale-110 relative z-20">
                <img src="https://ui-avatars.com/api/?name=Logo+{{$i}}&background=random&color=fff&size=200&font-size=0.3&rounded=true&bold=true" alt="Logo Anggota {{$i}}" class="w-full h-full object-contain opacity-70 hover:opacity-100">
            </div>
            @endfor
        </div>
        
        <div class="text-center relative z-20">
            <!-- Tombol Outline Hijau -->
            <a href="{{ route('anggota') }}" class="inline-flex items-center px-8 py-3 border border-primary-600 text-primary-600 text-sm uppercase tracking-widest font-medium rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

<!-- 4. FOKUS ISU (HIJAU SOLID) -->
<section class="py-28 lg:py-36 bg-[#165a3f] relative overflow-hidden">
    <!-- Ambient Glow Putih -->
    <div class="absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    <div class="absolute left-0 bottom-0 w-[400px] h-[400px] rounded-full blur-[100px] pointer-events-none opacity-5 -translate-x-1/4 translate-y-1/4 bg-white"></div>
    
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-20 text-center lg:text-left">
            <div class="w-32 h-[1px] bg-white mb-4 mx-auto lg:mx-0"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest">
                Fokus Isu
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-16 mb-20">
            <!-- Issue 1 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Transparansi<br>Dana Desa</h3>
            </a>
            
            <!-- Issue 2 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Perubahan<br>Iklim</h3>
            </a>
            
            <!-- Issue 3 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Inklusi Sosial &<br>Gender</h3>
            </a>

            <!-- Issue 4 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Ekonomi Kreatif<br>Pedesaan</h3>
            </a>

            <!-- Issue 5 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Literasi &<br>Pendidikan</h3>
            </a>

            <!-- Issue 6 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Infrastruktur &<br>Pelayanan</h3>
            </a>

            <!-- Issue 7 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Keadilan Ekologis<br>Pesisir</h3>
            </a>

            <!-- Issue 8 -->
            <a href="{{ route('isu.detail') }}" class="group flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#165a3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                </div>
                <h3 class="font-heading font-semibold text-sm md:text-base text-white group-hover:text-primary-200 transition-colors">Digitalisasi<br>Desa</h3>
            </a>
        </div>

        <div class="text-center">
            <a href="{{ route('isu') }}" class="inline-flex items-center px-8 py-3 border border-white text-white text-sm uppercase tracking-widest font-medium rounded-full hover:bg-white hover:text-[#165a3f] transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
        
    </div>
</section>


<!-- 5. AGENDA ACARA (PUTIH) -->
<section class="py-28 lg:py-36 bg-zinc-50 relative overflow-hidden">
    <!-- Ambient Glow Hijau -->
    <div class="absolute left-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-40 -translate-x-1/4 -translate-y-1/4" style="background-color: var(--color-primary-50, #f0fdf4);"></div>
    <div class="absolute right-0 bottom-0 w-[600px] h-[600px] rounded-full blur-[120px] pointer-events-none opacity-30 translate-x-1/3 translate-y-1/4" style="background-color: var(--color-primary-100, #dcfce7);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-20 text-center lg:text-left">
            <div class="w-32 h-[1px] bg-primary-600 mb-4 mx-auto lg:mx-0"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-4">
                Agenda Acara
            </h2>
            <p class="text-zinc-500 text-base md:text-lg font-light">Ikuti berbagai kegiatan edukasi, diskusi, dan pelatihan bersama kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-20 relative z-20">
            
            <!-- Event Card 1 -->
            <article class="bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group relative">
                <div class="relative aspect-video overflow-hidden bg-zinc-100">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Seminar Nasional" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-primary-900/10 group-hover:bg-transparent transition-colors duration-300"></div>
                </div>
                
                <div class="p-8 flex flex-col flex-grow">
                    <div class="mb-4">
                        <span class="text-xs font-bold text-primary-700 bg-primary-50 px-3 py-1.5 rounded-full uppercase tracking-widest">Seminar</span>
                    </div>
                    
                    <a href="{{ route('acara.detail') }}" class="block group-hover:text-primary-600 transition-colors mb-6">
                        <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug">Strategi Pengembangan Ekonomi Sirkular di Wilayah Pedesaan</h3>
                    </a>
                    
                    <div class="mt-auto space-y-3 border-t border-zinc-100 pt-6">
                        <div class="flex items-center text-sm text-zinc-500">
                            <div class="w-10 h-10 rounded-full bg-zinc-50 flex items-center justify-center mr-4 text-primary-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium">20 Mei 2024</span>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Event Card 2 -->
            <article class="bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group relative">
                <div class="relative aspect-video overflow-hidden bg-zinc-100">
                    <img src="https://images.unsplash.com/photo-1591115765373-5207764f72e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Diskusi Online" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-primary-900/10 group-hover:bg-transparent transition-colors duration-300"></div>
                </div>
                
                <div class="p-8 flex flex-col flex-grow">
                    <div class="mb-4">
                        <span class="text-xs font-bold text-primary-700 bg-primary-50 px-3 py-1.5 rounded-full uppercase tracking-widest">Diskusi</span>
                    </div>
                    
                    <a href="{{ route('acara.detail') }}" class="block group-hover:text-primary-600 transition-colors mb-6">
                        <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug">Webinar: Tantangan Perubahan Iklim bagi Petani Pesisir</h3>
                    </a>
                    
                    <div class="mt-auto space-y-3 border-t border-zinc-100 pt-6">
                        <div class="flex items-center text-sm text-zinc-500">
                            <div class="w-10 h-10 rounded-full bg-zinc-50 flex items-center justify-center mr-4 text-primary-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium">25 Mei 2024</span>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Event Card 3 -->
            <article class="bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group relative md:hidden lg:flex">
                <div class="relative aspect-video overflow-hidden bg-zinc-100">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pelatihan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-primary-900/10 group-hover:bg-transparent transition-colors duration-300"></div>
                </div>
                
                <div class="p-8 flex flex-col flex-grow">
                    <div class="mb-4">
                        <span class="text-xs font-bold text-primary-700 bg-primary-50 px-3 py-1.5 rounded-full uppercase tracking-widest">Pelatihan</span>
                    </div>
                    
                    <a href="{{ route('acara.detail') }}" class="block group-hover:text-primary-600 transition-colors mb-6">
                        <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug">Pelatihan Literasi Digital & Pembuatan Website Desa</h3>
                    </a>
                    
                    <div class="mt-auto space-y-3 border-t border-zinc-100 pt-6">
                        <div class="flex items-center text-sm text-zinc-500">
                            <div class="w-10 h-10 rounded-full bg-zinc-50 flex items-center justify-center mr-4 text-primary-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium">10 April 2024</span>
                        </div>
                    </div>
                </div>
            </article>

        </div>
        
        <div class="text-center relative z-20">
            <!-- Tombol Outline Hijau -->
            <a href="{{ route('acara') }}" class="inline-flex items-center px-8 py-3 border border-primary-600 text-primary-600 text-sm uppercase tracking-widest font-medium rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

<!-- 6. PUSAT PUBLIKASI (HIJAU SOLID) -->
<section class="py-28 lg:py-36 bg-[#165a3f] relative overflow-hidden" x-data="{ activeTab: 'berita' }">
    <!-- Ambient Glow Putih -->
    <div class="absolute left-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 -translate-x-1/4 translate-y-1/4 bg-white"></div>
    <div class="absolute right-0 top-0 w-[400px] h-[400px] rounded-full blur-[100px] pointer-events-none opacity-5 translate-x-1/3 -translate-y-1/4 bg-white"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-16 text-center">
            <div class="w-32 h-[1px] bg-white mx-auto mb-4"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest mb-4">
                Pusat Publikasi
            </h2>
            <p class="text-white/80 text-base md:text-lg font-light">Kabar terbaru, artikel opini, dan laporan riset dari kami.</p>
        </div>
        
        <!-- Tab Navigation -->
        <div class="flex flex-wrap justify-center gap-3 mb-16 overflow-x-auto pb-4 scrollbar-hide">
            <button @click="activeTab = 'berita'" :class="{ 'bg-white text-[#165a3f] shadow-lg': activeTab === 'berita', 'bg-transparent text-white border border-white/50 hover:bg-white/10': activeTab !== 'berita' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Berita</button>
            <button @click="activeTab = 'artikel'" :class="{ 'bg-white text-[#165a3f] shadow-lg': activeTab === 'artikel', 'bg-transparent text-white border border-white/50 hover:bg-white/10': activeTab !== 'artikel' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Artikel</button>
            <button @click="activeTab = 'riset'" :class="{ 'bg-white text-[#165a3f] shadow-lg': activeTab === 'riset', 'bg-transparent text-white border border-white/50 hover:bg-white/10': activeTab !== 'riset' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Riset</button>
            <button @click="activeTab = 'siaran'" :class="{ 'bg-white text-[#165a3f] shadow-lg': activeTab === 'siaran', 'bg-transparent text-white border border-white/50 hover:bg-white/10': activeTab !== 'siaran' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Siaran Pers</button>
        </div>

        @php
        $posts = [
            ['id' => 1, 'category' => 'berita', 'title' => 'Komdes Sultra Serahkan Bantuan Bibit Mangrove', 'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=800&q=80', 'date' => '12 Okt 2023'],
            ['id' => 2, 'category' => 'berita', 'title' => 'Pertemuan Jaringan Nelayan se-Kawasan Timur', 'image' => 'https://images.unsplash.com/photo-1516934816041-9df602a657e8?auto=format&fit=crop&w=800&q=80', 'date' => '05 Okt 2023'],
            ['id' => 3, 'category' => 'berita', 'title' => 'Dialog Publik: Mengurai Konflik Ruang Laut', 'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'date' => '28 Sep 2023'],
            
            ['id' => 4, 'category' => 'artikel', 'title' => 'Masa Depan Karbon Biru dan Hak Masyarakat Adat', 'image' => 'https://images.unsplash.com/photo-1526976663112-0050854d1937?auto=format&fit=crop&w=800&q=80', 'date' => '15 Sep 2023'],
            ['id' => 5, 'category' => 'artikel', 'title' => 'Tantangan Ekologis Pulau Kabaena di Tengah Tambang', 'image' => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?auto=format&fit=crop&w=800&q=80', 'date' => '02 Sep 2023'],
            ['id' => 6, 'category' => 'artikel', 'title' => 'Pentingnya Keterlibatan Perempuan dalam Konservasi', 'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80', 'date' => '20 Agu 2023'],
            
            ['id' => 7, 'category' => 'riset', 'title' => 'Laporan Tahunan: Kondisi Terumbu Karang Wakatobi 2023', 'image' => 'https://images.unsplash.com/photo-1591115765373-5207764f72e7?auto=format&fit=crop&w=800&q=80', 'date' => '10 Agu 2023'],
            ['id' => 8, 'category' => 'riset', 'title' => 'Policy Brief: Perlindungan Hak Tenurial Masyarakat Pesisir', 'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'date' => '01 Agu 2023'],
            ['id' => 9, 'category' => 'riset', 'title' => 'Buku Panduan Advokasi Tata Ruang Laut', 'image' => 'https://images.unsplash.com/photo-1498623116890-37e912163d5d?auto=format&fit=crop&w=800&q=80', 'date' => '15 Jul 2023'],
            
            ['id' => 10, 'category' => 'siaran', 'title' => 'Pernyataan Sikap Menolak Privatisasi Pulau Kecil', 'image' => null, 'date' => '10 Jul 2023'],
            ['id' => 11, 'category' => 'siaran', 'title' => 'Desakan Transparansi Dokumen AMDAL Pertambangan', 'image' => null, 'date' => '25 Jun 2023'],
            ['id' => 12, 'category' => 'siaran', 'title' => 'Dukungan untuk Gugatan Warga Pesisir Kendari', 'image' => null, 'date' => '12 Jun 2023'],
        ];
        @endphp

        <!-- Tab Contents -->
        <div class="relative min-h-[350px] mb-20">
            <!-- Berita -->
            <div x-show="activeTab === 'berita'" class="absolute inset-0 z-10" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach(collect($posts)->where('category', 'berita') as $post)
                    <a href="{{ route('berita.detail') }}" class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 h-full border border-zinc-100 relative">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <img src="{{ $post['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-xs font-bold text-primary-600 mb-3">{{ $post['date'] }}</span>
                            <h3 class="font-heading text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors leading-snug">{{ $post['title'] }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Artikel -->
            <div x-show="activeTab === 'artikel'" class="absolute inset-0 z-10" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach(collect($posts)->where('category', 'artikel') as $post)
                    <a href="{{ route('artikel.detail') }}" class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 h-full border border-zinc-100">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <img src="{{ $post['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-xs font-bold text-secondary-600 mb-3">{{ $post['date'] }}</span>
                            <h3 class="font-heading text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors leading-snug">{{ $post['title'] }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Riset -->
            <div x-show="activeTab === 'riset'" class="absolute inset-0 z-10" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach(collect($posts)->where('category', 'riset') as $post)
                    <a href="{{ route('riset.detail') }}" class="group flex flex-col bg-white rounded-2xl p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 h-full border border-zinc-100 relative overflow-hidden">
                        <div class="mb-5 text-primary-500 bg-primary-50 w-14 h-14 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-zinc-500 mb-2">{{ $post['date'] }}</span>
                        <h3 class="font-heading text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors leading-snug">{{ $post['title'] }}</h3>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Siaran Pers -->
            <div x-show="activeTab === 'siaran'" class="absolute inset-0 z-10" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(collect($posts)->where('category', 'siaran') as $post)
                    <a href="{{ route('siaran-pers.detail') }}" class="group block bg-white rounded-xl p-6 shadow-sm hover:shadow-xl transition-all border-l-4 border-primary-500">
                        <span class="text-xs text-zinc-500 font-bold mb-2 block">{{ $post['date'] }}</span>
                        <h3 class="font-heading text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors">{{ $post['title'] }}</h3>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('berita') }}" class="inline-flex items-center px-8 py-3 border border-white text-white text-sm uppercase tracking-widest font-medium rounded-full hover:bg-white hover:text-[#165a3f] transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

<!-- 7. GALERI KEGIATAN (PUTIH) -->
<section class="py-28 lg:py-36 bg-white overflow-hidden relative">
    <!-- Ambient Glow Hijau -->
    <div class="absolute right-0 top-1/2 w-[700px] h-[700px] rounded-full blur-[120px] pointer-events-none opacity-40 translate-x-1/4 -translate-y-1/2" style="background-color: var(--color-primary-100, #dcfce7);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-20 text-center lg:text-left">
            <div class="w-32 h-[1px] bg-primary-600 mb-4 mx-auto lg:mx-0"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-4">
                Galeri Kegiatan
            </h2>
            <p class="text-zinc-500 text-base md:text-lg font-light">Dokumentasi aksi lapangan dan advokasi bersama masyarakat.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-20 relative z-20">
            <!-- Galeri Card 1 -->
            <a href="{{ route('galeri.detail') }}" class="bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Galeri" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/10 transition-colors duration-300"></div>
                </div>

                <div class="p-8 flex flex-col flex-grow bg-white">
                    <div class="flex items-center gap-6 text-sm text-zinc-500 mb-4 font-medium">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            15 April 2023
                        </span>
                    </div>

                    <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors duration-300">
                        Aksi Tanam Mangrove Serentak se-Sultra
                    </h3>
                </div>
            </a>

            <!-- Galeri Card 2 -->
            <a href="{{ route('galeri.detail') }}" class="bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Galeri" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/10 transition-colors duration-300"></div>
                </div>

                <div class="p-8 flex flex-col flex-grow bg-white">
                    <div class="flex items-center gap-6 text-sm text-zinc-500 mb-4 font-medium">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            22 Mei 2023
                        </span>
                    </div>

                    <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors duration-300">
                        Diskusi Komunitas Nelayan Tradisional
                    </h3>
                </div>
            </a>

            <!-- Galeri Card 3 -->
            <a href="{{ route('galeri.detail') }}" class="bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group md:hidden lg:flex">
                <div class="relative aspect-video overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574046664972-e565980fcbc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Galeri" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/10 transition-colors duration-300"></div>
                </div>

                <div class="p-8 flex flex-col flex-grow bg-white">
                    <div class="flex items-center gap-6 text-sm text-zinc-500 mb-4 font-medium">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            12 Agustus 2023
                        </span>
                    </div>

                    <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors duration-300">
                        Pelatihan Pengelolaan Pesisir Berkelanjutan
                    </h3>
                </div>
            </a>
        </div>
        
        <div class="text-center relative z-20">
            <!-- Tombol Outline Hijau -->
            <a href="{{ route('galeri') }}" class="inline-flex items-center px-8 py-3 border border-primary-600 text-primary-600 text-sm uppercase tracking-widest font-medium rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

@endsection
