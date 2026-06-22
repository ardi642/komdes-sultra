@extends('layouts.public')

@section('title', 'Anggota Jaringan - Komdes Sultra')

@section('content')

@php

@endphp

<!-- Page Content wrapped in Alpine for Modal State -->
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
    }" 
    class="bg-zinc-50 min-h-screen pt-40 pb-36 relative">
    
    <!-- Decorative Background: Organic Blobs (Glassmorphism) -->
    <div class="hidden md:block absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Top Right Blob -->
        <div class="absolute -top-32 -right-32 w-[500px] md:w-[700px] h-[500px] md:h-[700px] rounded-[40%_60%_70%_30%] bg-primary-200/40 blur-[100px] md:blur-[140px] transform rotate-12"></div>
        
        <!-- Center Left Blob -->
        <div class="absolute top-1/4 -left-32 w-[400px] md:w-[600px] h-[500px] md:h-[800px] rounded-[60%_40%_30%_70%] bg-emerald-200/30 blur-[100px] md:blur-[150px] transform -rotate-12"></div>
        
        <!-- Bottom Center/Right Blob -->
        <div class="absolute -bottom-40 right-1/4 w-[600px] md:w-[900px] h-[400px] md:h-[600px] rounded-[50%_50%_20%_80%] bg-teal-100/50 blur-[120px] md:blur-[160px] transform rotate-45"></div>
    </div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-16 mt-10" data-aos="fade-up">

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-[#165a3f] mb-4 tracking-widest uppercase">Anggota Jaring Komdes Sultra</h1>
        </div>

        <!-- Members Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 gap-y-12 sm:gap-y-8" data-aos="zoom-in" data-aos-delay="200">
            <template x-for="member in members" :key="member.id">
                <button @click="openModal(member.id)" :title="member.name"
                        class="relative bg-transparent rounded-3xl flex flex-col items-center justify-start p-6 border border-transparent hover:bg-white hover:shadow-2xl hover:shadow-primary-500/10 hover:border-primary-100 transition-all duration-500 group focus:outline-none focus:ring-4 focus:ring-primary-500/20 hover:-translate-y-2 w-full h-full">
                    
                    <!-- Decorative background glow -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <!-- Logo Container -->
                    <div class="relative w-24 h-24 sm:w-32 sm:h-32 flex items-center justify-center mb-6 transform group-hover:scale-110 transition-transform duration-500 ease-out">
                        <template x-if="member.logo">
                            <img :src="member.logo.startsWith('http') ? member.logo : `{{ rtrim(asset(''), '/') }}${member.logo}`" :alt="member.name" class="max-w-full max-h-full object-contain transition-all duration-500 hover:scale-105">
                        </template>
                        <template x-if="!member.logo">
                            <div class="w-full h-full flex items-center justify-center bg-zinc-200 rounded-full text-zinc-500 font-bold border border-zinc-300">
                                <span class="text-xs text-center px-2 leading-tight" x-text="member.name"></span>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Member Name -->
                    <h3 class="text-sm font-semibold text-zinc-600/80 group-hover:text-primary-700 transition-colors duration-300 text-center line-clamp-2 px-2 z-10 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0" x-text="member.name"></h3>
                    
                </button>
            </template>
        </div>

    </div>

    <!-- Modal Overlay -->
    <div x-show="isOpen" 
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
         
        <!-- Backdrop -->
        <div x-show="isOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-zinc-900/60 backdrop-blur-sm transition-opacity" 
             @click="closeModal"></div>

        <!-- Modal Panel -->
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0" @click="closeModal">
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-zinc-200"
                 @click.stop>
                
                <!-- Close Button -->
                <button @click="closeModal" class="absolute top-4 right-4 text-zinc-400 hover:text-zinc-900 transition-colors focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="p-8 sm:p-10">
                    <template x-if="selectedMember">
                        <div class="flex flex-col items-center">
                            <!-- Logo -->
                            <div class="w-48 h-48 md:w-56 md:h-56 mb-6 flex items-center justify-center">
                                <template x-if="selectedMember.logo">
                                    <img :src="selectedMember.logo.startsWith('http') ? selectedMember.logo : `{{ rtrim(asset(''), '/') }}${selectedMember.logo}`" :alt="selectedMember.name" class="max-w-full max-h-full object-contain">
                                </template>
                            </div>
                            
                            <!-- Member Name -->
                            <h3 class="text-xl md:text-2xl font-bold mb-4 text-center text-[#165a3f] uppercase tracking-wide" x-text="selectedMember.name"></h3>
                            
                            <!-- Description -->
                            <p class="text-sm text-zinc-500 text-center leading-relaxed mb-8" x-text="selectedMember.description"></p>
                            
                            <!-- Social / Contact Links -->
                            <div class="flex items-center justify-center gap-3">
                                <!-- Website -->
                                <template x-if="selectedMember.website">
                                    <a :href="selectedMember.website" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="Kunjungi Website">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
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
                                
                                <!-- Instagram -->
                                <template x-if="selectedMember.instagram">
                                    <a :href="selectedMember.instagram" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="Instagram">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </template>

                                <!-- Facebook -->
                                <template x-if="selectedMember.facebook">
                                    <a :href="selectedMember.facebook" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="Facebook">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                    </a>
                                </template>

                                <!-- Twitter / X -->
                                <template x-if="selectedMember.twitter">
                                    <a :href="selectedMember.twitter" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="X / Twitter">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                </template>

                                <!-- TikTok -->
                                <template x-if="selectedMember.tiktok">
                                    <a :href="selectedMember.tiktok" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="TikTok">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-.9 4.41-2.4 6.02-1.6 1.7-3.9 2.71-6.24 2.89-2.3.16-4.66-.27-6.57-1.57-1.8-1.21-3.07-3.11-3.48-5.23-.42-2.15-.05-4.4 1.05-6.27 1.15-1.92 3.12-3.3 5.31-3.84 1.93-.47 3.99-.36 5.86.36v4.15c-1.17-.45-2.5-.52-3.7-.17-.99.28-1.86.9-2.41 1.76-.51.81-.7 1.8-.52 2.74.19.98.78 1.84 1.62 2.37.89.56 2.01.69 3.02.43 1.05-.27 1.93-.97 2.4-1.94.33-.68.45-1.44.47-2.19.01-4.73.01-9.45.02-14.18Z" /></svg>
                                    </a>
                                </template>

                                <!-- YouTube -->
                                <template x-if="selectedMember.youtube">
                                    <a :href="selectedMember.youtube" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="YouTube">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    </a>
                                </template>

                                <!-- LinkedIn -->
                                <template x-if="selectedMember.linkedin">
                                    <a :href="selectedMember.linkedin" target="_blank" class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg focus:outline-none" title="LinkedIn">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
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
