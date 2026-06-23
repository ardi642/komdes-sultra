@extends('layouts.public')

@section('title', 'Beranda - Komdes Sultra')

@section('content')

<!-- 1. HERO SECTION (Carousel Horizontal dengan Ken Burns & Smart Hover) -->
<section class="relative mt-24 w-full aspect-square sm:aspect-video md:aspect-auto md:h-[85vh] md:min-h-[550px] bg-[#0d3b29] overflow-hidden group" 
    x-data="{ 
        activeSlide: 0, 
        slides: {{ $sliders->count() > 0 ? $sliders->count() : 1 }},
        hovered: false,
        autoPlayInterval: null,
        isAutoplay: {{ ($sliderSetting && $sliderSetting->is_autoplay) ? 'true' : 'false' }},
        intervalMs: {{ $sliderSetting->autoplay_interval ?? 6000 }},
        startAutoPlay() {
            if (!this.isAutoplay) return;
            this.stopAutoPlay(); // Pastikan tidak ada duplikat interval
            this.autoPlayInterval = setInterval(() => {
                this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1;
            }, this.intervalMs);
        },
        stopAutoPlay() {
            if (this.autoPlayInterval) clearInterval(this.autoPlayInterval);
        },
        next() {
            this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1;
            if (this.isAutoplay) this.startAutoPlay(); // Reset timer saat diklik manual
        },
        prev() {
            this.activeSlide = this.activeSlide === 0 ? this.slides - 1 : this.activeSlide - 1;
            if (this.isAutoplay) this.startAutoPlay(); // Reset timer saat diklik manual
        },
        goToSlide(index) {
            this.activeSlide = index;
            if (this.isAutoplay) this.startAutoPlay(); // Reset timer saat dot diklik
        }
    }" 
    x-init="startAutoPlay()"
    @mouseenter="hovered = true"
    @mouseleave="hovered = false"
    @touchstart="hovered = true">

    @if($sliders->count() > 0)
        <!-- Background Image Container (Horizontal Sliding) -->
        <div class="absolute inset-0 z-0 flex transition-transform ease-in-out" style="transition-duration: {{ $sliderSetting->animation_duration ?? 1000 }}ms; transform: translateX(-${activeSlide * 100}%)" :style="`transition-duration: {{ $sliderSetting->animation_duration ?? 1000 }}ms; transform: translateX(-${activeSlide * 100}%)`">
            @foreach($sliders as $index => $slider)
                <div class="w-full h-full flex-shrink-0 relative overflow-hidden">
                    <!-- Ken Burns Effect Image -->
                    <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->title ?? 'Hero Komdes' }}" 
                         class="w-full h-full object-cover mix-blend-overlay opacity-50 transform transition-transform duration-[10000ms] ease-out origin-center"
                         :class="activeSlide === {{ $index }} ? 'scale-110' : 'scale-100'" />
                </div>
            @endforeach
        </div>
        
        <!-- Overlay Gelap Merata -->
        <div class="absolute inset-0 bg-black/20 z-0 pointer-events-none"></div>

        <!-- Text Content Container -->
        <div class="absolute inset-0 z-10 pointer-events-none">
            <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 w-full h-full relative">
                @foreach($sliders as $index => $slider)
                    <div x-show="activeSlide === {{ $index }}"
                         x-transition:enter="transition-all ease-out"
                         x-transition:enter-start="opacity-0 translate-x-32"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition-all ease-in"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-16"
                         class="absolute inset-y-0 flex flex-col justify-center w-full max-w-3xl pointer-events-auto"
                         style="display: none;"
                         :style="activeSlide === {{ $index }} ? 'transition-duration: {{ $sliderSetting->animation_duration ?? 1000 }}ms; transition-delay: {{ $sliderSetting->text_delay ?? 1000 }}ms;' : 'transition-duration: {{ ($sliderSetting->animation_duration ?? 1000) / 2 }}ms; transition-delay: 0ms;'">
                        
                        @if($slider->title)
                            <h1 class="text-2xl md:text-3xl lg:text-4xl font-heading font-bold text-white leading-snug mb-5 tracking-wide uppercase">
                                {{ $slider->title }}
                            </h1>
                        @endif
                        
                        @if($slider->subtitle)
                            <p class="text-sm md:text-base text-white/90 mb-8 max-w-2xl font-light leading-relaxed">
                                {{ $slider->subtitle }}
                            </p>
                        @endif

                        <div class="flex flex-wrap gap-4">
                            @if($slider->btn1_text)
                                <a href="{{ $slider->btn1_url ?? '#' }}" {!! str_starts_with($slider->btn1_url ?? '', 'http') ? 'target="_blank" rel="noopener noreferrer"' : '' !!} 
                                   class="inline-flex items-center px-6 py-2.5 border-2 border-white/80 text-white font-medium text-sm rounded-full hover:bg-white hover:text-[#0d3b29] hover:border-white transition-all shadow-lg backdrop-blur-sm">
                                    {{ $slider->btn1_text }}
                                </a>
                            @endif
                            @if($slider->btn2_text)
                                <a href="{{ $slider->btn2_url ?? '#' }}" {!! str_starts_with($slider->btn2_url ?? '', 'http') ? 'target="_blank" rel="noopener noreferrer"' : '' !!} 
                                   class="inline-flex items-center px-6 py-2.5 border-2 border-white/80 text-white font-medium text-sm rounded-full hover:bg-white hover:text-[#0d3b29] hover:border-white transition-all shadow-lg backdrop-blur-sm">
                                    {{ $slider->btn2_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Navigasi Dots (Dikecilkan) -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
            @foreach($sliders as $index => $slider)
                <button @click="goToSlide({{ $index }})" 
                        class="h-1.5 rounded-full transition-all duration-300"
                        :class="activeSlide === {{ $index }} ? 'bg-white w-6' : 'bg-white/40 w-1.5 hover:bg-white/80'">
                </button>
            @endforeach
        </div>

        <!-- Navigasi Panah Kiri (Smart Hover) -->
        <button @click="prev()" 
                x-show="hovered"
                x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute left-4 md:left-8 top-1/2 transform -translate-y-1/2 z-20 p-3 rounded-full bg-black/20 text-white/80 hover:bg-black/60 hover:text-white border border-white/20 transition-all backdrop-blur-sm"
                style="display: none;">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        <!-- Navigasi Panah Kanan (Smart Hover) -->
        <button @click="next()" 
                x-show="hovered"
                x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute right-4 md:right-8 top-1/2 transform -translate-y-1/2 z-20 p-3 rounded-full bg-black/20 text-white/80 hover:bg-black/60 hover:text-white border border-white/20 transition-all backdrop-blur-sm"
                style="display: none;">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    @else
        <!-- Fallback Statis Jika Tidak Ada Slider -->
        <div class="absolute inset-0 z-0 flex items-center">
            <div class="absolute inset-0 z-0 bg-black">
                <img src="https://images.unsplash.com/photo-1498623116890-37e912163d5d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Komdes Sultra" class="w-full h-full object-cover mix-blend-overlay opacity-50 transform scale-105" />
            </div>
            <!-- Overlay Gelap Merata -->
            <div class="absolute inset-0 bg-black/20 z-0"></div>
            <div class="hidden md:block absolute right-0 bottom-0 w-[600px] h-[600px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 translate-y-1/4 bg-white"></div>
            
            <div class="relative z-10 max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-3xl">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-heading font-bold text-white leading-snug mb-5 tracking-wide uppercase">
                        Menjaga Ekosistem Pesisir,<br>
                        Memberdayakan Masyarakat.
                    </h1>
                    <p class="text-sm md:text-base text-white/90 mb-8 max-w-2xl font-light leading-relaxed">
                        Simpul pergerakan dan kolaborasi untuk perlindungan ruang hidup nelayan tradisional di Sulawesi Tenggara.
                    </p>
                </div>
            </div>
        </div>
    @endif
</section>

<!-- 2. TENTANG KAMI (HIJAU SOLID) -->
<section class="py-28 lg:py-36 bg-[#165a3f] relative overflow-hidden">
    <!-- Ambient Glow Putih -->
    <div class="hidden md:block absolute left-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 -translate-x-1/3 -translate-y-1/4 bg-white"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col {{ (!$homepageSetting || $homepageSetting->about_media_type !== 'none') ? 'lg:flex-row' : '' }} items-center gap-16 lg:gap-20">
            <!-- Teks Kiri -->
            <div class="{{ (!$homepageSetting || $homepageSetting->about_media_type !== 'none') ? 'lg:w-7/12' : 'w-full' }}">
                <!-- Aksen Garis & Judul Elegan -->
                <div class="mb-10" data-aos="fade-up">
                    <div class="w-32 h-[1px] bg-white mb-4"></div>
                    <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest">
                        Tentang Komdes Sultra
                    </h2>
                </div>

                <div class="text-white/90 text-base md:text-lg font-light leading-loose space-y-6" data-aos="fade-up" data-aos-delay="200">
                    @if($homepageSetting && $homepageSetting->about_description)
                        {!! nl2br(e($homepageSetting->about_description)) !!}
                    @endif
                </div>
                
                <div class="mt-12 flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="400">
                    @if($homepageSetting)
                        @if($homepageSetting->about_btn1_text)
                            <a href="{{ $homepageSetting->about_btn1_url ?? '#' }}" class="inline-flex items-center px-8 py-3 bg-white border border-white text-[#165a3f] text-sm uppercase tracking-widest font-bold rounded-full hover:bg-zinc-100 transition-all duration-300 shadow-lg">
                                {{ $homepageSetting->about_btn1_text }}
                            </a>
                        @endif
                        @if($homepageSetting->about_btn2_text)
                            <a href="{{ $homepageSetting->about_btn2_url ?? '#' }}" class="inline-flex items-center px-8 py-3 border border-white/60 text-white text-sm uppercase tracking-widest font-medium rounded-full hover:bg-white hover:text-[#165a3f] hover:border-white transition-all duration-300">
                                {{ $homepageSetting->about_btn2_text }}
                            </a>
                        @endif
                    @else
                        <a href="{{ route('tentang-kami') }}" class="inline-flex items-center px-8 py-3 bg-white border border-white text-[#165a3f] text-sm uppercase tracking-widest font-bold rounded-full hover:bg-zinc-100 transition-all duration-300 shadow-lg">
                            Tentang Kami
                        </a>
                        <a href="{{ route('kontak') }}" class="inline-flex items-center px-8 py-3 border border-white/60 text-white text-sm uppercase tracking-widest font-medium rounded-full hover:bg-white hover:text-[#165a3f] hover:border-white transition-all duration-300">
                            Hubungi Kami
                        </a>
                    @endif
                </div>
            </div>

            <!-- Media Kanan -->
            @if($homepageSetting && $homepageSetting->about_media_type === 'image' && $homepageSetting->about_image_path)
                <div class="lg:w-5/12 w-full">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-video group border-4 border-white/10 bg-black/20" data-aos="fade-left" data-aos-delay="300">
                        <img src="{{ asset($homepageSetting->about_image_path) }}" alt="Kegiatan Komdes Sultra" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-in-out">
                    </div>
                </div>
            @elseif($homepageSetting && $homepageSetting->about_media_type === 'youtube' && $homepageSetting->about_youtube_url)
                <div class="lg:w-5/12 w-full">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-video group border-4 border-white/10 bg-black/20" data-aos="fade-left" data-aos-delay="300">
                        <iframe src="{{ $homepageSetting->about_youtube_url }}" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            @elseif(!$homepageSetting || $homepageSetting->about_media_type === 'image')
                <div class="lg:w-5/12 w-full">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-video group border-4 border-white/10 bg-black/20" data-aos="fade-left" data-aos-delay="300">
                        <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kegiatan Komdes Sultra" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-in-out">
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- 3. ANGGOTA JARING (PUTIH) -->
<section class="py-28 lg:py-36 bg-white relative overflow-hidden">
    <!-- Ambient Glow Hijau -->
    <div class="hidden md:block absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-40 translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10" x-data="{ modalOpen: false, selectedMember: null }">
        
        <div class="mb-20 text-center lg:text-left" data-aos="fade-up">
            <div class="w-32 h-[1px] bg-primary-600 mx-auto lg:mx-0 mb-4"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-4">
                Anggota Jaring Komdes Sultra
            </h2>
            <p class="text-zinc-500 text-base md:text-lg font-light">{{ $homepageSetting->network_subtitle }}</p>
        </div>
        
        <div class="flex flex-wrap justify-center lg:justify-start gap-6 lg:gap-10 items-center mb-20" data-aos="zoom-in" data-aos-delay="200">
            @foreach($members as $member)
            <div @click="selectedMember = {{ json_encode(['name' => $member->name, 'description' => $member->description, 'logo' => asset($member->logo), 'website' => $member->website, 'instagram' => $member->instagram, 'email' => $member->email, 'phone' => $member->phone]) }}; modalOpen = true" 
                 class="w-40 h-40 md:w-48 md:h-48 p-2 flex flex-col items-center justify-center transition-all duration-300 hover:scale-110 relative z-20 cursor-pointer group"
                 title="{{ $member->name }}">
                <img src="{{ asset($member->logo) }}" alt="Logo {{ $member->name }}" class="w-full h-full object-contain drop-shadow-sm group-hover:drop-shadow-lg transition-all duration-300">
                <span class="absolute -bottom-4 left-0 right-0 text-center text-sm font-bold text-primary-700 opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 py-1 rounded-md">{{ $member->name }}</span>
            </div>
            @endforeach
        </div>

        <!-- Modal Popup Anggota (Menggunakan Teleport agar tidak terpotong z-index parent) -->
        <template x-teleport="body">
            <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 transition-opacity bg-zinc-900/80 backdrop-blur-sm" aria-hidden="true" @click="modalOpen = false"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative z-50 inline-block overflow-hidden text-left align-bottom transition-all transform bg-white shadow-2xl sm:my-8 sm:align-middle w-full sm:max-w-2xl sm:rounded-3xl border border-zinc-100 p-8 sm:p-10">
                        <div class="absolute top-4 right-4 z-[60]">
                            <button type="button" @click="modalOpen = false" class="p-2 text-zinc-400 bg-white rounded-full hover:text-zinc-700 hover:bg-zinc-100 focus:outline-none transition-colors">
                                <span class="sr-only">Tutup</span>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <template x-if="selectedMember">
                            <div class="flex flex-col items-center">
                                <!-- Logo -->
                                <div class="w-48 h-48 md:w-56 md:h-56 mb-6 flex items-center justify-center">
                                    <template x-if="selectedMember.logo">
                                        <img :src="selectedMember.logo" :alt="selectedMember.name" class="max-w-full max-h-full object-contain">
                                    </template>
                                </div>
                                
                                <!-- Member Name -->
                                <h3 class="text-xl md:text-2xl font-bold mb-4 text-center text-[#165a3f] uppercase tracking-wide" x-text="selectedMember.name"></h3>
                                
                                <!-- Description -->
                                <div class="text-sm text-zinc-500 text-center leading-relaxed mb-8 max-w-xl" x-html="selectedMember.description || '<p>Tidak ada deskripsi tersedia.</p>'"></div>
                                
                                <!-- Social & Contact Links -->
                                <div class="flex items-center justify-center gap-3">
                                    <!-- Website -->
                                    <template x-if="selectedMember.website">
                                        <a :href="selectedMember.website" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="Kunjungi Website">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                        </a>
                                    </template>
                                    <!-- Instagram -->
                                    <template x-if="selectedMember.instagram">
                                        <a :href="selectedMember.instagram" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="Instagram">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </template>
                                    <!-- Email -->
                                    <template x-if="selectedMember.email">
                                        <a :href="'mailto:' + selectedMember.email" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="Kirim Email">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </a>
                                    </template>
                                    <!-- Phone -->
                                    <template x-if="selectedMember.phone">
                                        <a :href="'tel:' + selectedMember.phone" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="Telepon">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </div>
</section>

<!-- 4. FOKUS ISU (HIJAU GELAP) -->
<section class="py-28 lg:py-36 bg-[#165a3f] relative overflow-hidden">
    <!-- Ambient Glow Putih -->
    <div class="hidden md:block absolute left-0 bottom-0 w-[400px] h-[400px] rounded-full blur-[100px] pointer-events-none opacity-5 -translate-x-1/4 translate-y-1/4 bg-white"></div>
    
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-20 text-center lg:text-left" data-aos="fade-up">
            <div class="w-32 h-[1px] bg-white mb-4 mx-auto lg:mx-0"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest mb-4">
                Fokus Isu
            </h2>
            <p class="text-white/80 text-base md:text-lg font-light">{{ $homepageSetting->issue_subtitle }}</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-12 md:gap-x-8 md:gap-y-16 mb-20 justify-items-center lg:justify-items-start">
            @foreach($issues as $issue)
            <a href="{{ route('isu.detail', $issue->slug) }}" class="group flex flex-col items-center text-center w-full max-w-xs" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="w-full max-w-[140px] md:max-w-none aspect-square md:w-48 md:h-48 rounded-2xl overflow-hidden mb-4 md:mb-6 shadow-xl group-hover:-translate-y-2 transition-transform duration-300 bg-white flex items-center justify-center">
                    @if($issue->cover_image)
                        <img src="{{ asset($issue->cover_image) }}" alt="{{ $issue->title }}" class="w-full h-full object-cover">
                    @else
                        {!! $issue->icon_svg !!}
                    @endif
                </div>
                <h3 class="font-heading font-semibold text-xs sm:text-sm md:text-base text-white group-hover:text-zinc-200 transition-colors">{{ $issue->title }}</h3>
            </a>
            @endforeach
        </div>
        
    </div>
</section>

<!-- 5. PUSAT PUBLIKASI (PUTIH) -->
<section class="py-28 lg:py-36 bg-white relative overflow-hidden" x-data="{ activeTab: 'berita' }">
    <!-- Ambient Glow Hijau -->
    <div class="hidden md:block absolute left-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-40 -translate-x-1/4 translate-y-1/4" style="background-color: var(--color-primary-50, #f0fdf4);"></div>
    <div class="hidden md:block absolute right-0 top-0 w-[400px] h-[400px] rounded-full blur-[100px] pointer-events-none opacity-30 translate-x-1/3 -translate-y-1/4" style="background-color: var(--color-primary-100, #dcfce7);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-16 text-center" data-aos="fade-up">
            <div class="w-32 h-[1px] bg-primary-600 mx-auto mb-4"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-4">
                Pusat Publikasi
            </h2>
            <p class="text-zinc-500 text-base md:text-lg font-light">{{ $homepageSetting->publication_subtitle }}</p>
        </div>
        
        <!-- Tab Navigation -->
        <div class="flex flex-wrap justify-center gap-3 mb-16 overflow-x-auto pb-4 scrollbar-hide" data-aos="fade-up" data-aos-delay="200">
            <button @click="activeTab = 'berita'" :class="{ 'bg-primary-600 text-white shadow-lg': activeTab === 'berita', 'bg-transparent text-primary-700 border border-primary-200 hover:bg-primary-50': activeTab !== 'berita' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Berita</button>
            <button @click="activeTab = 'artikel'" :class="{ 'bg-primary-600 text-white shadow-lg': activeTab === 'artikel', 'bg-transparent text-primary-700 border border-primary-200 hover:bg-primary-50': activeTab !== 'artikel' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Artikel</button>
            <button @click="activeTab = 'riset'" :class="{ 'bg-primary-600 text-white shadow-lg': activeTab === 'riset', 'bg-transparent text-primary-700 border border-primary-200 hover:bg-primary-50': activeTab !== 'riset' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Riset</button>
            <button @click="activeTab = 'siaran'" :class="{ 'bg-primary-600 text-white shadow-lg': activeTab === 'siaran', 'bg-transparent text-primary-700 border border-primary-200 hover:bg-primary-50': activeTab !== 'siaran' }" class="px-6 py-2.5 rounded-full font-medium text-sm transition-all whitespace-nowrap uppercase tracking-widest">Siaran Pers</button>
        </div>

        <!-- Tab Contents -->
        <div class="relative min-h-[350px] mb-20" data-aos="fade-up" data-aos-delay="400">
            <!-- Berita -->
            <div x-show="activeTab === 'berita'" class="z-10" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($berita as $post)
                    <a href="{{ route('berita.detail', $post->slug) }}" class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 h-full border border-zinc-100 relative">
                        <div class="aspect-video w-full overflow-hidden relative bg-zinc-50 flex items-center justify-center">
                            @if($post->cover_image)
                                <img src="{{ asset($post->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="text-zinc-300 flex flex-col items-center group-hover:scale-110 transition-transform duration-700">
                                    <svg class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Komdes Sultra</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-xs font-bold text-primary-600 mb-3">{{ \Carbon\Carbon::parse($post->published_at)->locale('id')->translatedFormat('d F Y') }}</span>
                            <h3 class="font-heading text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors leading-snug">{{ $post->title }}</h3>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-3 text-center text-white/70 py-10">Belum ada berita.</div>
                    @endforelse
                </div>
            </div>

            <!-- Artikel -->
            <div x-show="activeTab === 'artikel'" class="z-10" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($artikel as $post)
                    <a href="{{ route('artikel.detail', $post->slug) }}" class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 h-full border border-zinc-100">
                        <div class="aspect-video w-full overflow-hidden relative bg-zinc-50 flex items-center justify-center">
                            @if($post->cover_image)
                                <img src="{{ asset($post->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="text-zinc-300 flex flex-col items-center group-hover:scale-110 transition-transform duration-700">
                                    <svg class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Komdes Sultra</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-xs font-bold text-secondary-600 mb-3">{{ \Carbon\Carbon::parse($post->published_at)->locale('id')->translatedFormat('d F Y') }}</span>
                            <h3 class="font-heading text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors leading-snug">{{ $post->title }}</h3>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-3 text-center text-white/70 py-10">Belum ada artikel.</div>
                    @endforelse
                </div>
            </div>

            <!-- Riset -->
            <div x-show="activeTab === 'riset'" class="z-10" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($riset as $post)
                    <a href="{{ route('riset.detail', $post->slug) }}" class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 h-full border border-zinc-100 relative">
                        <div class="aspect-video w-full overflow-hidden relative bg-zinc-50 flex items-center justify-center">
                            @if($post->cover_image)
                                <img src="{{ asset($post->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="text-zinc-300 flex flex-col items-center group-hover:scale-110 transition-transform duration-700">
                                    <svg class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Komdes Sultra</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-xs font-bold text-zinc-500 mb-3">{{ \Carbon\Carbon::parse($post->published_at)->locale('id')->translatedFormat('d F Y') }}</span>
                            <h3 class="font-heading text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors leading-snug">{{ $post->title }}</h3>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-3 text-center text-white/70 py-10">Belum ada riset.</div>
                    @endforelse
                </div>
            </div>

            <!-- Siaran Pers -->
            <div x-show="activeTab === 'siaran'" class="z-10" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($siaran as $post)
                    <a href="{{ route('siaran-pers.detail', $post->slug) }}" class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 h-full border border-zinc-100 relative">
                        <div class="aspect-video w-full overflow-hidden relative bg-zinc-50 flex items-center justify-center">
                            @if($post->cover_image)
                            <img src="{{ asset($post->cover_image) }}" class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700 p-4">
                            @else
                            <div class="text-zinc-300 flex flex-col items-center group-hover:scale-110 transition-transform duration-700">
                                <svg class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Komdes Sultra</span>
                            </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col justify-center flex-grow">
                            <span class="text-xs text-zinc-500 font-bold mb-3 block">{{ \Carbon\Carbon::parse($post->published_at)->locale('id')->translatedFormat('d F Y') }}</span>
                            <h3 class="font-heading text-base md:text-lg font-bold text-zinc-900 group-hover:text-primary-600 transition-colors">{{ $post->title }}</h3>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-3 text-center text-white/70 py-10">Belum ada siaran pers.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="text-center" data-aos="zoom-in">
            <a :href="activeTab === 'berita' ? '{{ route('berita') }}' : (activeTab === 'artikel' ? '{{ route('artikel') }}' : (activeTab === 'riset' ? '{{ route('riset') }}' : '{{ route('siaran-pers') }}'))" 
               class="inline-flex items-center px-8 py-3 border border-primary-600 text-primary-600 text-sm uppercase tracking-widest font-medium rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

<!-- 6. AGENDA ACARA (HIJAU GELAP) -->
<section class="py-28 lg:py-36 bg-[#165a3f] relative overflow-hidden">
    <!-- Ambient Glow Putih -->
    <div class="hidden md:block absolute left-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-10 -translate-x-1/4 -translate-y-1/4 bg-white"></div>
    
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-20 text-center lg:text-left" data-aos="fade-up">
            <div class="w-32 h-[1px] bg-white mb-4 mx-auto lg:mx-0"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest mb-4">
                Agenda Acara
            </h2>
            <p class="text-white/80 text-base md:text-lg font-light">{{ $homepageSetting->agenda_subtitle }}</p>
        </div>

        <div class="flex flex-wrap justify-center lg:justify-start gap-10 mb-20 relative z-20">
            @foreach($events as $event)
            <article class="w-full sm:w-[calc(50%-1.25rem)] lg:w-[calc(33.333%-1.666rem)] bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group relative" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}">
                <div class="relative aspect-video overflow-hidden bg-zinc-100 flex items-center justify-center">
                    @if($event->cover_image)
                        <img src="{{ asset($event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="text-zinc-300 flex flex-col items-center group-hover:scale-110 transition-transform duration-700">
                            <svg class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Komdes Sultra</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-primary-900/10 group-hover:bg-transparent transition-colors duration-300"></div>
                </div>
                
                <div class="p-8 flex flex-col flex-grow">
                    <div class="mb-4">
                        <span class="text-xs font-bold text-primary-700 bg-primary-50 px-3 py-1.5 rounded-full uppercase tracking-widest">Agenda</span>
                    </div>
                    
                    <a href="{{ route('acara.detail', $event->slug) }}" class="block group-hover:text-primary-600 transition-colors mb-6">
                        <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug">{{ $event->title }}</h3>
                    </a>
                    
                    <div class="mt-auto space-y-3 border-t border-zinc-100 pt-6">
                        <div class="flex items-center text-sm text-zinc-500">
                            <div class="w-10 h-10 rounded-full bg-zinc-50 flex items-center justify-center mr-4 text-primary-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') }} - {{ $event->location }}</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center relative z-20" data-aos="zoom-in">
            <!-- Tombol Outline Putih -->
            <a href="{{ route('acara') }}" class="inline-flex items-center px-8 py-3 border border-white text-white text-sm uppercase tracking-widest font-medium rounded-full hover:bg-white hover:text-[#165a3f] transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

<!-- 7. GALERI KEGIATAN (PUTIH) -->
<section class="py-28 lg:py-36 bg-white overflow-hidden relative">
    <!-- Ambient Glow Hijau -->
    <div class="hidden md:block absolute right-0 top-1/2 w-[700px] h-[700px] rounded-full blur-[120px] pointer-events-none opacity-40 translate-x-1/4 -translate-y-1/2" style="background-color: var(--color-primary-100, #dcfce7);"></div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-20 text-center lg:text-left" data-aos="fade-up">
            <div class="w-32 h-[1px] bg-primary-600 mb-4 mx-auto lg:mx-0"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-4">
                Galeri Kegiatan
            </h2>
            <p class="text-zinc-500 text-base md:text-lg font-light">{{ $homepageSetting->gallery_subtitle }}</p>
        </div>

        <div class="flex flex-wrap justify-center lg:justify-start gap-10 mb-20 relative z-20">
            @foreach($galleries as $gallery)
            <!-- Galeri Card -->
            <a href="{{ route('galeri.detail', $gallery->slug) }}" class="w-full sm:w-[calc(50%-1.25rem)] lg:w-[calc(33.333%-1.666rem)] bg-white rounded-[2rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}">
                <div class="relative aspect-video overflow-hidden">
                    <img src="{{ asset($gallery->thumbnail ?? ($gallery->images->first()->image_path ?? 'images/placeholder-gallery.jpg')) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                    <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/10 transition-colors duration-300"></div>
                </div>

                <div class="p-8 flex flex-col flex-grow bg-white">
                    <div class="flex items-center gap-6 text-sm text-zinc-500 mb-4 font-medium">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $gallery->date->format('d F Y') }}
                        </span>
                    </div>

                    <h3 class="font-heading text-lg font-bold text-zinc-900 leading-snug group-hover:text-primary-600 transition-colors duration-300">
                        {{ $gallery->title }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center relative z-20" data-aos="zoom-in">
            <!-- Tombol Outline Hijau -->
            <a href="{{ route('galeri') }}" class="inline-flex items-center px-8 py-3 border border-primary-600 text-primary-600 text-sm uppercase tracking-widest font-medium rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

@endsection
