@extends('layouts.public')

@section('title', 'Tentang Kami - Komdes Sultra')

@section('content')

@php

@endphp

<!-- Wrap Entire Page in Alpine for Anggota Modal functionality -->
<div x-data="{
        isOpen: false,
        selectedMember: null,
        members: {{ json_encode($members) }},
        openModal(id) {
            this.selectedMember = this.members.find(m => m.id === id);
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.isOpen = false;
            setTimeout(() => this.selectedMember = null, 300);
            document.body.style.overflow = 'auto';
        }
    }" class="font-sans">

    <!-- Hero Section (Green Solid) -->
    <div class="relative pt-40 pb-32 overflow-hidden bg-[#165a3f]">
        <div class="absolute right-0 bottom-0 w-[600px] h-[600px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 translate-y-1/4 bg-white"></div>
        <div class="max-w-[90rem] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="text-center mt-10 mb-8 max-w-6xl mx-auto" data-aos="fade-up">
                <div class="w-32 h-[1px] bg-white mx-auto mb-6 opacity-50"></div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold mb-6 tracking-widest uppercase text-white drop-shadow-md">Tentang Kami</h1>
                <p class="text-base md:text-lg text-white/90 leading-relaxed drop-shadow-sm font-light">
                    {{ $about?->hero_description ?? 'Mengenal lebih dekat KOMUNITAS MASYARAKAT DESA-SULAWESI TENGGARA (Komdes Sultra) sebagai wadah kolaborasi untuk kelestarian alam dan kesejahteraan masyarakat pesisir.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Section 1: Profil Singkat (White with hint of green) -->
    <section class="relative py-28 lg:py-36 overflow-hidden bg-white">
        <!-- Ambient Glow Elements -->
        <div class="absolute right-0 top-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full blur-[120px] pointer-events-none opacity-40 translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>
        <div class="absolute left-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-30 -translate-x-1/3 translate-y-1/3" style="background-color: var(--color-primary-50, #f0fdf4);"></div>

        <div class="max-w-[90rem] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="max-w-6xl" data-aos="fade-up">
                <div class="w-32 h-[1px] bg-primary-600 mb-4"></div>
                <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-8">Profil Singkat Komdes Sultra</h2>
                
                <div class="text-zinc-700 text-justify md:text-left space-y-6 leading-loose text-base md:text-lg font-light">
                    {!! nl2br(e($about?->profil_singkat ?? 'Belum ada profil singkat.')) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Mengapa Komdes Sultra (Green Solid) -->
    <section class="relative py-28 lg:py-36 overflow-hidden bg-[#165a3f]">
        <!-- Ambient Glow Putih -->
        <div class="absolute left-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 -translate-x-1/3 -translate-y-1/4 bg-white"></div>
        <div class="max-w-[90rem] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="max-w-6xl" data-aos="fade-up">
                <div class="w-32 h-[1px] bg-white mb-4"></div>
                <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest mb-8">Mengapa Komdes Sultra</h2>
                
                <div class="text-white text-justify md:text-left space-y-6 leading-loose text-base md:text-lg font-light opacity-95">
                    {!! nl2br(e($about?->mengapa_komdes ?? 'Belum ada penjelasan mengapa Komdes Sultra.')) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Tujuan & Intensi (White with hint of green) -->
    <section class="relative py-28 lg:py-36 overflow-hidden bg-white">
        <!-- Ambient Glow Elements -->
        <div class="absolute left-0 top-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full blur-[120px] pointer-events-none opacity-40 -translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>
        <div class="absolute right-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-30 translate-x-1/3 translate-y-1/3" style="background-color: var(--color-primary-50, #f0fdf4);"></div>

        <div class="max-w-[90rem] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            
            <!-- Tujuan (Right Aligned to the container bounds) -->
            <div class="mb-32 flex justify-end" data-aos="fade-left">
                <div class="max-w-6xl w-full flex flex-col md:items-end text-left md:text-right">
                    <div class="w-32 h-[1px] bg-primary-600 mb-4"></div>
                    <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-6">Tujuan Komdes Sultra</h2>
                    
                    <p class="italic text-lg mb-6 font-medium text-primary-600">
                        "{{ $about?->tujuan_quote ?? 'Sebagai ruang belajar, berbagi ide dan pengetahuan serta melahirkan aksi dan produk belajar terkait pesisir dan pulau kecil di Sulawesi Tenggara' }}"
                    </p>
                    
                    <ul class="space-y-4 text-zinc-700 text-base md:text-lg font-light md:max-w-3xl w-full">
                        @if($about && is_array($about->tujuan_list))
                            @foreach($about->tujuan_list as $tujuan)
                            <li class="flex flex-row md:flex-row-reverse items-start gap-4">
                                <svg class="w-6 h-6 mt-1 flex-shrink-0 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-justify md:text-right leading-loose flex-grow">{{ $tujuan }}</span>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Spacer to guarantee vertical distance -->
            <div class="h-20 md:h-32 w-full block" style="height: 6rem;"></div>

            <!-- Intensi (Left Aligned to the container bounds) -->
            <div class="flex justify-start" data-aos="fade-right">
                <div class="max-w-7xl w-full">
                    <div class="w-32 h-[1px] bg-primary-600 mb-4"></div>
                    <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest mb-8">Intensi Bersama Komdes Sultra</h2>
                    
                    <ul class="space-y-6 text-zinc-700 text-base md:text-lg font-light">
                        @if($about && is_array($about->intensi_list))
                            @foreach($about->intensi_list as $intensi)
                            <li class="flex items-start gap-4">
                                <svg class="w-6 h-6 mt-1 flex-shrink-0 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-justify md:text-left leading-loose">{{ $intensi }}</span>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Sikap dan Deklarasi (Green Solid) -->
    <section class="relative py-28 lg:py-36 overflow-hidden bg-[#165a3f]">
        <!-- Ambient Glow Putih -->
        <div class="absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>

        <div class="max-w-[90rem] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="w-32 h-[1px] bg-white mb-4" data-aos="fade-up"></div>
            <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest mb-12" data-aos="fade-up">Sikap dan Deklarasi Komdes Sultra</h2>
            
            <div class="space-y-4 max-w-6xl">
                @if($about && is_array($about->sikap_list))
                    @foreach($about->sikap_list as $index => $sikap)
                    <div class="flex flex-col md:flex-row" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="w-16 h-16 md:w-24 md:h-auto flex-shrink-0 border border-white flex items-center justify-center text-white font-bold text-2xl mr-4 md:mr-6 mb-4 md:mb-0">
                            {{ $index + 1 }}.
                        </div>
                        <div class="bg-white p-6 md:p-8 flex-grow shadow-sm">
                            <p class="text-base md:text-lg leading-loose text-justify md:text-left font-light text-primary-700">
                                <strong class="font-bold">{{ $sikap['title'] ?? '' }}</strong> {{ $sikap['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Section 5: Anggota (White) -->
    <section class="relative py-28 lg:py-36 overflow-hidden bg-white">
        <!-- Ambient Glow Elements -->
        <div class="absolute right-0 top-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full blur-[120px] pointer-events-none opacity-40 translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>
        
        <div class="max-w-[90rem] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="mb-16 flex flex-col md:items-end text-left md:text-right" data-aos="fade-up">
                <div class="w-32 h-[1px] bg-primary-600 mb-4"></div>
                <h2 class="text-xl md:text-2xl font-heading font-bold text-primary-700 uppercase tracking-widest">Profil Anggota Komdes Sultra</h2>
            </div>

            <!-- Clean grid, no borders, just logos -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 items-center justify-items-center relative z-20" data-aos="zoom-in" data-aos-delay="200">
                <template x-for="member in members" :key="member.id">
                    <button @click="openModal(member.id)" :title="member.name" class="group focus:outline-none flex flex-col items-center h-full">
                        <template x-if="member.logo">
                            <img :src="member.logo.startsWith('http') ? member.logo : `{{ rtrim(asset(''), '/') }}${member.logo}`" :alt="member.name" class="w-40 h-40 md:w-48 md:h-48 object-contain transition-transform duration-300 transform group-hover:scale-110">
                        </template>
                        <template x-if="!member.logo">
                            <div class="w-40 h-40 md:w-48 md:h-48 flex items-center justify-center bg-zinc-100 rounded-full text-zinc-400 border border-zinc-200 transition-transform duration-300 transform group-hover:scale-110">
                                <span class="text-xs text-center px-2" x-text="member.name"></span>
                            </div>
                        </template>
                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <h3 class="text-sm md:text-base font-semibold text-primary-700 text-center line-clamp-2" x-text="member.name"></h3>
                        </div>
                    </button>
                </template>
            </div>
        </div>
    </section>

    <!-- Modal Overlay -->
    <div x-show="isOpen" 
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
         
        <div x-show="isOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-zinc-900/60 backdrop-blur-sm transition-opacity" 
             @click="closeModal"></div>

        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0 relative z-50" @click="closeModal">
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-zinc-100"
                 @click.stop>
                
                <button @click="closeModal" class="absolute top-5 right-5 text-zinc-400 hover:text-zinc-900 transition-colors focus:outline-none bg-zinc-50 hover:bg-zinc-100 rounded-full p-2">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="p-8 sm:p-10">
                    <template x-if="selectedMember">
                        <div class="flex flex-col items-center">
                            <div class="w-48 h-48 md:w-56 md:h-56 mb-8 flex items-center justify-center">
                                <template x-if="selectedMember.logo">
                                    <img :src="selectedMember.logo.startsWith('http') ? selectedMember.logo : `{{ rtrim(asset(''), '/') }}${selectedMember.logo}`" :alt="selectedMember.name" class="max-w-full max-h-full object-contain">
                                </template>
                            </div>
                            
                            <h3 class="text-xl md:text-2xl font-bold mb-4 text-center text-[#165a3f] uppercase tracking-wide" x-text="selectedMember.name"></h3>
                            <p class="text-sm text-zinc-500 text-center leading-relaxed mb-8" x-text="selectedMember.description"></p>
                            
                            <div class="flex items-center justify-center gap-4">
                                <template x-if="selectedMember.website">
                                    <a :href="selectedMember.website" target="_blank" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none bg-[#165a3f]" title="Kunjungi Website">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                    </a>
                                </template>
                                
                                <template x-if="selectedMember.instagram">
                                    <a :href="selectedMember.instagram" target="_blank" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none bg-[#165a3f]" title="Instagram">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </template>
                                
                                <template x-if="selectedMember.email">
                                    <a :href="selectedMember.email" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none bg-[#165a3f]" title="Kirim Email">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </a>
                                </template>

                                <template x-if="selectedMember.phone">
                                    <a :href="selectedMember.phone" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none bg-[#165a3f]" title="Telepon">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
