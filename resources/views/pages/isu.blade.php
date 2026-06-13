@extends('layouts.public')

@section('title', 'Fokus Isu - Komdes Sultra')

@section('content')

<!-- Page Header / Hero -->
<div class="relative pt-56 pb-40 overflow-hidden bg-[#165a3f]">
    <div class="absolute right-0 bottom-0 w-[600px] h-[600px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 translate-y-1/4 bg-white"></div>
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">

        <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white uppercase tracking-widest mb-6 drop-shadow-md">
            Fokus Isu
        </h1>
        <p class="text-base md:text-lg text-white/90 max-w-2xl mx-auto drop-shadow-sm font-light leading-relaxed">
            Temukan berbagai berita, artikel, siaran pers, dan riset berdasarkan topik dan fokus advokasi utama kami.
        </p>
    </div>
</div>

<!-- Main Content Area -->
<div class="relative bg-white py-24 overflow-hidden">
    <!-- Ambient Glow Elements -->
    <div class="absolute left-0 top-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full blur-[120px] pointer-events-none opacity-40 -translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>
    <div class="absolute right-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-30 translate-x-1/3 translate-y-1/3" style="background-color: var(--color-primary-50, #f0fdf4);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Grid of Issues -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6" data-aos="fade-up" data-aos-delay="200">
            
            @forelse($issues as $issue)
            <!-- Issue Card -->
            <a href="{{ route('isu.detail', $issue->slug) }}" class="group bg-white rounded-xl p-6 border border-zinc-100 hover:border-[#165a3f] hover:shadow-2xl transition-all duration-500 flex flex-col items-center text-center h-full">
                <div class="w-20 h-20 mb-5 text-[#165a3f] group-hover:scale-110 transition-transform duration-500 flex items-center justify-center">
                    @if($issue->cover_image)
                    <img src="{{ asset($issue->cover_image) }}" alt="{{ $issue->title }}" class="w-full h-full object-cover rounded-full">
                    @elseif($issue->icon_svg)
                    <div class="w-full h-full [&>svg]:w-full [&>svg]:h-full">{!! $issue->icon_svg !!}</div>
                    @else
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                    @endif
                </div>
                <h3 class="font-heading font-bold text-zinc-800 text-sm md:text-base group-hover:text-[#165a3f] transition-colors leading-tight">
                    {{ $issue->title }}
                </h3>
            </a>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-zinc-500">Belum ada isu yang terdaftar.</p>
            </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $issues->links() }}
        </div>
        
    </div>
</div>

@endsection
