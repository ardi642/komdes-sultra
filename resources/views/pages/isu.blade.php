@extends('layouts.public')

@section('title', 'Fokus Isu - Komdes Sultra')

@section('content')
<!-- Page Header / Hero -->
<div class="bg-zinc-50 pt-32 pb-16 relative border-b border-zinc-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-extrabold text-zinc-900 mb-4">
            Fokus Isu
        </h1>
        <p class="text-lg text-zinc-500 max-w-2xl mx-auto">
            Temukan berbagai berita, artikel, siaran pers, dan riset berdasarkan topik dan fokus advokasi utama kami.
        </p>
    </div>
</div>

<!-- Main Content Area -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Grid of Issues (Icon-based like Jaring Nusa) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
            
            <!-- Issue Card 1 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Transparansi Dana Desa
                </h3>
            </a>

            <!-- Issue Card 2 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Perubahan Iklim
                </h3>
            </a>

            <!-- Issue Card 3 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Kesetaraan Gender & Inklusi Sosial
                </h3>
            </a>

            <!-- Issue Card 4 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Ekonomi Kreatif Pedesaan
                </h3>
            </a>

            <!-- Issue Card 5 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Literasi & Pendidikan Desa
                </h3>
            </a>

            <!-- Issue Card 6 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Infrastruktur & Pelayanan Publik
                </h3>
            </a>

            <!-- Issue Card 7 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Keadilan Ekologis Pesisir
                </h3>
            </a>
            
            <!-- Issue Card 8 -->
            <a href="{{ route('isu.detail') }}" class="group bg-white rounded-xl p-6 border border-zinc-200 hover:border-primary-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-primary-600 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-primary-600 transition-colors leading-tight">
                    Digitalisasi Desa
                </h3>
            </a>

        </div>
        
    </div>
</div>

@endsection
