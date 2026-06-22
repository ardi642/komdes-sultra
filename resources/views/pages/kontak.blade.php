@extends('layouts.public')

@section('title', 'Kontak - Komdes Sultra')

@section('content')

<!-- Wrapper -->
<div class="w-full">

    <!-- 1. Hero Section: Info Kontak Utama -->
    <section class="relative text-white pt-64 pb-48 overflow-hidden bg-[#165a3f]">
        <!-- Ambient Glow Putih -->
        <div class="hidden md:block absolute right-0 top-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 translate-x-1/4 -translate-y-1/4 bg-white"></div>
        <div class="max-w-[90rem] mx-auto px-6 md:px-10 lg:px-12 relative z-10">
            <!-- Judul & Link Aduan -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6" data-aos="fade-up">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold uppercase tracking-widest drop-shadow-md m-0">Kontak Komdes Sultra</h1>
                
                <!-- Link Aduan Solid -->
                <a href="#aduan" class="inline-flex items-center text-sm font-bold text-[#165a3f] hover:text-[#0f3d2a] bg-[#FFD700] hover:bg-[#F0C800] px-6 py-3 rounded-full shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all group">
                    Sampaikan laporan, aduan, atau pertanyaan
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
            </div>

            <!-- Card Info Utama -->
            <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12 border border-zinc-100" data-aos="fade-up">
                <div class="flex flex-col lg:flex-row gap-8 items-center justify-between">
                    
                    <!-- Kolom Kiri: Info -->
                    <div class="w-full lg:w-2/3 space-y-6">
                        <h2 class="text-xl md:text-2xl font-bold text-primary-800 mb-6 hidden">Sekretariat Jaring Nusa KTI</h2>
                        
                        <div class="space-y-5">
                            <!-- Phone -->
                            <div class="flex items-start gap-4">
                                <div class="mt-1 text-primary-700 bg-primary-50 p-2 rounded-full">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div class="text-zinc-700 font-medium text-lg pt-1.5">{{ $contactSetting?->phone ?? 'Belum diatur' }}</div>
                            </div>
                            <!-- Email -->
                            <div class="flex items-start gap-4">
                                <div class="mt-1 text-primary-700 bg-primary-50 p-2 rounded-full">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="text-zinc-700 font-medium text-lg pt-1.5">{{ $contactSetting?->email ?? 'Belum diatur' }}</div>
                            </div>
                            <!-- Website -->
                            <div class="flex items-start gap-4">
                                <div class="mt-1 text-primary-700 bg-primary-50 p-2 rounded-full">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                </div>
                                <div class="text-zinc-700 font-medium text-lg pt-1.5">{{ $contactSetting?->website ?? 'Belum diatur' }}</div>
                            </div>
                            <!-- Address -->
                            <div class="flex items-start gap-4">
                                <div class="mt-1 text-primary-700 bg-primary-50 p-2 rounded-full">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div class="text-zinc-700 font-medium text-lg pt-1.5 leading-relaxed">
                                    {{ $contactSetting?->address ?? 'Belum diatur' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Placeholder Logo -->
                    <div class="w-full lg:w-1/3 flex justify-center lg:justify-end">
                        <div class="bg-white/10 backdrop-blur-sm w-48 h-48 md:w-56 md:h-56 rounded-xl flex items-center justify-center p-6 shadow-inner border border-white/20">
                            @if($contactSetting && $contactSetting->logo)
                                <img src="{{ asset($contactSetting->logo) }}" alt="Logo Kontak" class="max-w-full max-h-full object-contain drop-shadow-md">
                            @else
                                <!-- Placeholder Logo -->
                                <div class="text-white text-center">
                                    <div class="font-bold text-2xl tracking-widest border-2 border-white p-4 inline-block">JARING<br>NUSA</div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- 2. Section: Kontak Anggota -->
    <section class="py-28 lg:py-36 relative overflow-hidden bg-white">
        <!-- Ambient Glow Elements -->
        <div class="hidden md:block absolute right-0 top-0 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full blur-[120px] pointer-events-none opacity-50 translate-x-1/3 -translate-y-1/3" style="background-color: var(--color-primary-100, #dcfce7);"></div>
        <div class="hidden md:block absolute left-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-40 -translate-x-1/3 translate-y-1/3" style="background-color: var(--color-primary-50, #f0fdf4);"></div>

        <div class="max-w-[90rem] mx-auto px-6 md:px-10 lg:px-12 relative z-10">
            <!-- Judul -->
            <div class="text-left mb-12" data-aos="fade-up">
                <div class="w-32 h-[1px] bg-primary-600 mb-4"></div>
                <h2 class="text-xl md:text-2xl font-heading font-bold uppercase tracking-widest text-primary-700">Kontak Anggota Komdes Sultra</h2>
            </div>

            <!-- List Card Anggota (3 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10" data-aos="fade-up" data-aos-delay="200">
                @foreach($members as $member)
                <div class="group bg-white rounded-[2rem] shadow-sm border border-zinc-100 p-8 hover:shadow-2xl hover:shadow-primary-900/5 transition-all duration-500 hover:-translate-y-2 flex flex-col h-full relative overflow-hidden">
                    
                    <!-- Subtle background decoration on hover -->
                    <div class="absolute -right-16 -top-16 w-48 h-48 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700 ease-out pointer-events-none blur-3xl" style="background-color: var(--color-primary-100, #dcfce7);"></div>
                    
                    <!-- Header Card: Logo and Name Centered -->
                    <div class="flex flex-col items-center text-center mb-8 relative z-10">
                        <div class="w-32 h-32 flex-shrink-0 flex items-center justify-center group-hover:scale-110 transition-all duration-500 mb-4">
                            @if($member->logo)
                                <img src="{{ asset($member->logo) }}" alt="Logo {{ $member->name }}" class="max-w-full max-h-full object-contain">
                            @else
                                <div class="w-full h-full bg-zinc-100 flex items-center justify-center text-zinc-400 font-bold text-xs text-center leading-tight break-all rounded-full border border-zinc-200">
                                    {{ $member->name }}
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-zinc-800 transition-colors" style="color: var(--color-primary-700, #15803d);">{{ $member->name }}</h3>
                    </div>
                    
                    <!-- Info Anggota -->
                    <div class="space-y-2 relative z-10 flex-grow flex flex-col justify-center">
                        @if($member->phone && $member->phone !== '-')
                        <div class="flex items-center gap-3 group/item">
                            <div class="w-8 h-8 rounded-lg bg-zinc-50 flex items-center justify-center transition-colors group-hover/item:bg-primary-50" style="color: var(--color-primary-600, #16a34a);">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <span class="text-zinc-600 font-medium text-sm">{{ $member->phone }}</span>
                        </div>
                        @endif

                        @if($member->email && $member->email !== '-')
                        <div class="flex items-center gap-3 group/item">
                            <div class="w-8 h-8 rounded-lg bg-zinc-50 flex items-center justify-center transition-colors group-hover/item:bg-primary-50" style="color: var(--color-primary-600, #16a34a);">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-zinc-600 font-medium text-sm break-all">{{ $member->email }}</span>
                        </div>
                        @endif

                        @if($member->website && $member->website !== '-')
                        <div class="flex items-center gap-3 group/item">
                            <div class="w-8 h-8 rounded-lg bg-zinc-50 flex items-center justify-center transition-colors group-hover/item:bg-primary-50" style="color: var(--color-primary-600, #16a34a);">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            </div>
                            <span class="text-zinc-600 font-medium text-sm">{{ $member->website }}</span>
                        </div>
                        @endif

                        @if($member->address && $member->address !== '-')
                        <div class="flex items-start gap-3 group/item">
                            <div class="w-8 h-8 rounded-lg bg-zinc-50 flex-shrink-0 flex items-center justify-center transition-colors group-hover/item:bg-primary-50 mt-0.5" style="color: var(--color-primary-600, #16a34a);">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="text-zinc-600 text-sm leading-relaxed mt-1">{{ $member->address }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- 3. Section: Formulir Laporan / Aduan -->
    <section id="aduan" class="py-28 lg:py-36 relative overflow-hidden bg-[#165a3f]">
        <!-- Ambient Glow Putih -->
        <div class="hidden md:block absolute left-0 bottom-0 w-[500px] h-[500px] md:w-[700px] md:h-[700px] rounded-full blur-[120px] pointer-events-none opacity-5 -translate-x-1/4 translate-y-1/4 bg-white"></div>
        <div class="max-w-4xl mx-auto px-6 md:px-10 lg:px-12 relative z-10">
            
            <div class="mb-10" data-aos="fade-up">
                <div class="w-32 h-[1px] bg-white mb-4"></div>
                <h2 class="text-xl md:text-2xl font-heading font-bold text-white uppercase tracking-widest mb-3">Laporan / Aduan</h2>
                <p class="text-white/80 text-base md:text-lg font-light leading-relaxed">Sampaikan laporan, aduan atau pertanyaan Anda pada formulir di bawah ini, kami akan tindak lebih lanjut.</p>
            </div>

            @if (session()->has('success'))
                <div class="mb-6 bg-white/20 backdrop-blur-md border border-white/50 text-white px-6 py-4 rounded-lg shadow-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4" data-aos="fade-up" data-aos-delay="200">
                @csrf
                <div>
                    <input type="text" name="nama" required placeholder="Nama" value="{{ old('nama') }}" class="w-full bg-white text-zinc-800 px-5 py-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-primary-500/30 placeholder:text-zinc-400 border-0 shadow-sm transition-shadow">
                    @error('nama') <span class="text-red-200 text-sm mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input type="email" name="email" required placeholder="Email" value="{{ old('email') }}" class="w-full bg-white text-zinc-800 px-5 py-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-primary-500/30 placeholder:text-zinc-400 border-0 shadow-sm transition-shadow">
                    @error('email') <span class="text-red-200 text-sm mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input type="text" name="subjek" placeholder="Subjek" value="{{ old('subjek') }}" class="w-full bg-white text-zinc-800 px-5 py-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-primary-500/30 placeholder:text-zinc-400 border-0 shadow-sm transition-shadow">
                    @error('subjek') <span class="text-red-200 text-sm mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <textarea name="pesan" required rows="6" placeholder="Pesan" class="w-full bg-white text-zinc-800 px-5 py-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-primary-500/30 placeholder:text-zinc-400 resize-y border-0 shadow-sm transition-shadow">{{ old('pesan') }}</textarea>
                    @error('pesan') <span class="text-red-200 text-sm mt-1 ml-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="pt-4 text-center">
                    <button type="submit" class="inline-flex items-center px-8 py-3 border border-white text-white text-sm uppercase tracking-widest font-medium rounded-full hover:bg-white hover:text-[#165a3f] transition-all duration-300 w-full justify-center">
                        Kirim Laporan
                    </button>
                </div>
            </form>

        </div>
    </section>

</div>

@endsection
