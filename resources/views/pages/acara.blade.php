@extends('layouts.public')

@section('title', 'Agenda Acara - Komdes Sultra')

@section('content')
<!-- Page Header -->
<div class="relative pt-40 pb-32 overflow-hidden bg-[#165a3f]">
    <div class="absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <div class="w-32 h-[1px] bg-white mx-auto mb-6 opacity-50"></div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white uppercase tracking-widest mb-6 drop-shadow-md">Agenda Acara</h1>
            <p class="text-white/90 text-base md:text-lg max-w-2xl mx-auto font-light leading-relaxed drop-shadow-sm">Ikuti berbagai kegiatan edukasi, diskusi, dan pelatihan bersama Komdes Sultra.</p>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="relative bg-white py-28 lg:py-36 overflow-hidden">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
    
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
        
        <!-- Main Content (Daftar Acara) -->
        <div class="flex-1">
            
            <div class="mb-10">
                <div class="w-32 h-[1px] bg-[#165a3f] mb-4"></div>
                <h2 class="font-heading font-bold text-xl md:text-2xl text-[#165a3f] uppercase tracking-widest">Semua Acara</h2>
            </div>

            <!-- Poster Grid (2 Columns on Desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                
                @forelse($events as $event)
                <!-- Event Card -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                    <div class="relative aspect-[4/5] overflow-hidden bg-zinc-100">
                        <img src="{{ $event->cover_image ? asset($event->cover_image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-bold text-secondary-600 bg-secondary-50 px-2.5 py-1 rounded-md uppercase tracking-wider">Acara</span>
                        </div>
                        
                        @if($event->issues->isNotEmpty())
                        <a href="{{ route('isu.detail', $event->issues->first()->slug) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 mb-2 rounded-lg bg-primary-50 text-primary-700 text-xs font-bold border border-primary-100 hover:bg-primary-100 transition-colors w-fit">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            {{ $event->issues->first()->title }}
                        </a>
                        @endif

                        <a href="{{ route('acara.detail', $event->slug) }}" class="block group-hover:text-primary-600 transition-colors mb-4">
                            <h3 class="font-heading text-xl font-bold text-zinc-900 leading-snug">{{ $event->title }}</h3>
                        </a>
                        
                        <div class="mt-auto space-y-2.5 border-t border-zinc-100 pt-4">
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-medium">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center text-sm text-zinc-600">
                                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span>{{ $event->location ?? 'Virtual' }}</span>
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-1 md:col-span-2 text-center py-12">
                    <p class="text-zinc-500">Belum ada acara yang dijadwalkan.</p>
                </div>
                @endforelse

            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                {{ $events->links() }}
            </div>
        </div>

        <!-- Sidebar (Widget) -->
        <div class="lg:w-[350px] flex-shrink-0">
            <div class="sticky top-28 space-y-8">
                
                <!-- Search Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Cari Acara</h3>
                    <form action="#" method="GET" class="relative">
                        <input type="text" placeholder="Masukkan kata kunci..." class="w-full pl-4 pr-12 py-3 rounded-xl border border-zinc-200 bg-zinc-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm">
                        <button type="submit" class="absolute right-2 top-1.5 bottom-1.5 aspect-square bg-primary-600 hover:bg-primary-500 text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                <!-- Acara Mendatang Widget -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
                    <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Acara Mendatang</h3>
                    <div class="space-y-4">
                        <a href="#" class="flex gap-4 group">
                            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0">
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-sm text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors line-clamp-2 mb-1">Strategi Pengembangan Ekonomi Sirkular</h4>
                                <p class="text-xs text-primary-600 font-medium">20 Mei 2024</p>
                            </div>
                        </a>
                        <a href="#" class="flex gap-4 group">
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
