@extends('layouts.public')

@section('title', 'Agenda Acara - Komdes Sultra')

@section('content')
<!-- Page Header -->
<div class="relative pt-64 pb-48 overflow-hidden bg-[#165a3f]">
    <div class="absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
    
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center" data-aos="fade-up">

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white uppercase tracking-widest mb-6 drop-shadow-md">Agenda Acara</h1>
            <p class="text-white/90 text-base md:text-lg max-w-2xl mx-auto font-light leading-relaxed drop-shadow-sm">{{ \App\Models\SiteSetting::where('key', 'hero_event_text')->value('value') }}</p>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="relative bg-white py-28 lg:py-36 overflow-hidden">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
    
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">
        
        <!-- Main Content (Daftar Acara) -->
        <div class="flex-1" x-data="{ showFilter: false }">
            
            @include('partials.post-filter', ['title' => 'Semua Acara'])

            <!-- Poster Grid (2 Columns on Desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                
                @forelse($events as $event)
                <!-- Event Card -->
                <article class="bg-white rounded-2xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group relative" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="relative h-56 overflow-hidden bg-zinc-100">
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
        <div class="lg:w-[350px] flex-shrink-0" data-aos="fade-left" data-aos-delay="200">
            @include('partials.event-sidebar')
        </div>

    </div>
</div>
@endsection
