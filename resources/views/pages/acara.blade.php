@extends('layouts.public')

@section('title', 'Agenda Acara - Komdes Sultra')

@section('content')
<!-- Page Header -->
<div class="bg-primary-600 pt-32 pb-32 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-primary-500 opacity-50 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-secondary-400 opacity-30 blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white mb-4 tracking-tight">Agenda Acara</h1>
            <p class="text-primary-100 text-lg max-w-2xl mx-auto">Ikuti berbagai kegiatan edukasi, diskusi, dan pelatihan bersama Komdes Sultra.</p>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20 relative z-20">
    
    <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- Main Content (Daftar Acara) -->
        <div class="lg:w-2/3">
            
            <div class="flex justify-between items-center mb-8 border-b border-zinc-100 pb-4">
                <h2 class="font-heading font-bold text-2xl text-zinc-900">Semua Acara</h2>
            </div>

            <!-- Poster Grid (2 Columns on Desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                
                <!-- Event Card 1 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                    <div class="relative aspect-[4/5] overflow-hidden bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Seminar Nasional" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-secondary-600 bg-secondary-50 px-2.5 py-1 rounded-md uppercase tracking-wider">Seminar</span>
                        </div>
                        
                        <!-- Isu Badge Mockup (Conditionally Rendered) -->
                        <a href="{{ route('isu.detail') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 mb-2 rounded-lg bg-primary-50 text-primary-700 text-xs font-bold border border-primary-100 hover:bg-primary-100 transition-colors w-fit">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            Ekonomi Kreatif Pedesaan
                        </a>

                        <a href="{{ route('acara.detail') }}" class="block group-hover:text-primary-600 transition-colors mb-4">
                            <h3 class="font-heading text-xl font-bold text-zinc-900 leading-snug">Strategi Pengembangan Ekonomi Sirkular di Wilayah Pedesaan</h3>
                        </a>
                        
                        <div class="mt-auto space-y-2.5 border-t border-zinc-100 pt-4">
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-medium">20 Mei 2024</span>
                            </div>
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span>Hotel Claro, Kendari</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Event Card 2 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                    <div class="relative aspect-[4/5] overflow-hidden bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1591115765373-5207764f72e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Diskusi Online" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-primary-600 bg-primary-50 px-2.5 py-1 rounded-md uppercase tracking-wider">Diskusi Publik</span>
                        </div>
                        
                        <a href="{{ route('acara.detail') }}" class="block group-hover:text-primary-600 transition-colors mb-4">
                            <h3 class="font-heading text-xl font-bold text-zinc-900 leading-snug">Webinar: Tantangan Perubahan Iklim bagi Petani Pesisir</h3>
                        </a>
                        
                        <div class="mt-auto space-y-2.5 border-t border-zinc-100 pt-4">
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-medium">25 Mei 2024</span>
                            </div>
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <span>Zoom Meeting</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Event Card 3 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                    <div class="relative aspect-[4/5] overflow-hidden bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pelatihan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-zinc-600 bg-zinc-100 px-2.5 py-1 rounded-md uppercase tracking-wider">Pelatihan</span>
                        </div>
                        
                        <a href="{{ route('acara.detail') }}" class="block group-hover:text-primary-600 transition-colors mb-4">
                            <h3 class="font-heading text-xl font-bold text-zinc-900 leading-snug">Pelatihan Literasi Digital & Pembuatan Website Desa</h3>
                        </a>
                        
                        <div class="mt-auto space-y-2.5 border-t border-zinc-100 pt-4">
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-medium">10 - 12 April 2024</span>
                            </div>
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span>Kabupaten Muna</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Event Card 4 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                    <div class="relative aspect-[4/5] overflow-hidden bg-zinc-100">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Rapat Kerja" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-zinc-600 bg-zinc-100 px-2.5 py-1 rounded-md uppercase tracking-wider">Rapat Kerja</span>
                        </div>
                        
                        <a href="{{ route('acara.detail') }}" class="block group-hover:text-primary-600 transition-colors mb-4">
                            <h3 class="font-heading text-xl font-bold text-zinc-900 leading-snug">Rapat Konsolidasi Pengurus Komdes se-Sulawesi Tenggara</h3>
                        </a>
                        
                        <div class="mt-auto space-y-2.5 border-t border-zinc-100 pt-4">
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-medium">05 Maret 2024</span>
                            </div>
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span>Sekretariat Komdes Sultra</span>
                            </div>
                        </div>
                    </div>
                </article>

            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center mb-12 lg:mb-0">
                <nav class="inline-flex items-center gap-1 bg-white p-1 rounded-full border border-zinc-200 shadow-sm">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-500 hover:bg-zinc-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-600 text-white font-bold shadow-sm">1</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">2</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-700 hover:bg-zinc-100 transition-colors">3</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-zinc-500 hover:bg-zinc-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Sidebar (Widget) -->
        <div class="lg:w-1/3">
            <div class="sticky top-28 space-y-8">
                
                <!-- Search Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-zinc-900 mb-4 border-b border-zinc-100 pb-2">Cari Acara</h3>
                    <form action="#" method="GET" class="relative">
                        <input type="text" placeholder="Masukkan kata kunci..." class="w-full pl-4 pr-12 py-3 rounded-xl border border-zinc-200 bg-zinc-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm">
                        <button type="submit" class="absolute right-2 top-1.5 bottom-1.5 aspect-square bg-primary-600 hover:bg-primary-500 text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                <!-- Acara Mendatang Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-zinc-900 mb-4 border-b border-zinc-100 pb-2">Acara Mendatang</h3>
                    <div class="space-y-4">
                        <a href="{{ route('acara.detail') }}" class="flex gap-4 group">
                            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0">
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-sm text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors line-clamp-2 mb-1">Strategi Pengembangan Ekonomi Sirkular</h4>
                                <p class="text-xs text-primary-600 font-medium">20 Mei 2024</p>
                            </div>
                        </a>
                        <a href="{{ route('acara.detail') }}" class="flex gap-4 group">
                            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0">
                                <img src="https://images.unsplash.com/photo-1591115765373-5207764f72e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-sm text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors line-clamp-2 mb-1">Webinar: Tantangan Perubahan Iklim</h4>
                                <p class="text-xs text-primary-600 font-medium">25 Mei 2024</p>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>
@endsection
