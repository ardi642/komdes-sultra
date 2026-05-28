@extends('layouts.public')

@section('title', 'Tentang Kami - Komdes Sultra')

@section('content')

@php
$members = [
    [
        'id' => 1,
        'name' => 'Yayasan Bonebula',
        'logo' => 'https://ui-avatars.com/api/?name=Bone+Bula&background=047857&color=fff&size=200&font-size=0.33',
        'description' => 'Yayasan Bonebula adalah organisasi non pemerintah dan non profit yang didirikan di Donggala Sulawesi Tengah tanggal 18 Maret 2008 berdasarkan Akte Notaris No 70/2008.',
        'website' => '#',
        'instagram' => '#',
        'email' => 'mailto:info@bonebula.org',
        'phone' => 'tel:+6281234567890'
    ],
    [
        'id' => 2,
        'name' => 'WALHI Sulawesi Selatan',
        'logo' => 'https://ui-avatars.com/api/?name=WALHI+Sulsel&background=10B981&color=fff&size=200&font-size=0.33',
        'description' => 'Wahana Lingkungan Hidup Indonesia (WALHI) Sulawesi Selatan adalah organisasi lingkungan hidup yang independen, non-profit dan merupakan forum kelompok masyarakat sipil.',
        'website' => '#',
        'instagram' => '#',
        'email' => 'mailto:sulsel@walhi.or.id',
        'phone' => 'tel:+6281234567890'
    ],
    [
        'id' => 3,
        'name' => 'Japesda',
        'logo' => 'https://ui-avatars.com/api/?name=Japesda&background=059669&color=fff&size=200&font-size=0.33',
        'description' => 'Japesda (Jaring Advokasi Pengelolaan Sumber Daya Alam) fokus pada perlindungan lingkungan dan pemberdayaan masyarakat pesisir di kawasan Indonesia Timur.',
        'website' => '#',
        'instagram' => '#',
        'email' => '',
        'phone' => ''
    ],
    [
        'id' => 4,
        'name' => 'Blue Forests',
        'logo' => 'https://ui-avatars.com/api/?name=Blue+Forests&background=1E40AF&color=fff&size=200&font-size=0.33',
        'description' => 'Yayasan Hutan Biru (Blue Forests) berdedikasi pada upaya restorasi dan pelestarian ekosistem mangrove serta perbaikan taraf hidup masyarakat pesisir.',
        'website' => '#',
        'instagram' => '#',
        'email' => '',
        'phone' => ''
    ],
    [
        'id' => 5,
        'name' => 'Econusa',
        'logo' => 'https://ui-avatars.com/api/?name=Econusa&background=0D9488&color=fff&size=200&font-size=0.33',
        'description' => 'Yayasan EcoNusa adalah organisasi nirlaba yang bertujuan untuk meningkatkan inisiatif lokal di tingkat nasional dan internasional dalam upaya pengelolaan berkelanjutan sumber daya alam di Indonesia Timur.',
        'website' => '#',
        'instagram' => '#',
        'email' => '',
        'phone' => ''
    ],
    [
        'id' => 6,
        'name' => 'YKL Indonesia',
        'logo' => 'https://ui-avatars.com/api/?name=YKL+Indonesia&background=16A34A&color=fff&size=200&font-size=0.33',
        'description' => 'Yayasan Konservasi Laut Indonesia bergerak dalam bidang pelestarian laut dan ekosistem terumbu karang di kawasan Indonesia Tengah.',
        'website' => '#',
        'instagram' => '#',
        'email' => '',
        'phone' => ''
    ]
];
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

    <!-- Hero Section (Green) -->
    <div class="relative pt-32 pb-24 overflow-hidden" style="background: linear-gradient(135deg, var(--color-primary-500, #22c55e) 0%, var(--color-primary-700, #15803d) 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="text-center mt-10 mb-8 max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-widest uppercase text-white drop-shadow-md">Tentang Kami</h1>
                <div class="w-24 h-1.5 mx-auto rounded-full shadow-sm mb-6 bg-white opacity-80"></div>
                <p class="text-xl text-white leading-loose drop-shadow-sm font-medium">
                    Mengenal lebih dekat Komunitas Desa Sulawesi Tenggara (Komdes Sultra) sebagai wadah kolaborasi untuk kelestarian alam dan kesejahteraan masyarakat pesisir.
                </p>
            </div>
        </div>
    </div>

    <!-- Section 1: Profil Singkat (White with hint of green) -->
    <section class="relative py-24 overflow-hidden bg-gradient-to-b from-white to-primary-50/80">
        <!-- Concentric Circles Right Grey -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/3 pointer-events-none opacity-5 hidden md:block">
            @for ($i = 0; $i < 15; $i++)
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full border border-zinc-800" style="width: {{ 400 + ($i * 60) }}px; height: {{ 400 + ($i * 60) }}px;"></div>
            @endfor
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="max-w-4xl">
                <div class="border-t-2 w-20 md:w-32 mb-4" style="border-color: var(--color-primary-700, #15803d);"></div>
                <h2 class="text-2xl md:text-3xl font-bold uppercase tracking-widest mb-8" style="color: var(--color-primary-700, #15803d);">Profil Singkat Komdes Sultra</h2>
                
                <div class="text-zinc-700 text-justify md:text-left space-y-6 leading-loose text-base md:text-lg font-light">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim.</p>
                    <p>Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus. Mauris iaculis porttitor posuere. Praesent id metus massa, ut blandit odio.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Mengapa Komdes Sultra (Green) -->
    <section class="relative py-24 overflow-hidden" style="background: linear-gradient(135deg, var(--color-primary-500, #22c55e) 0%, var(--color-primary-700, #15803d) 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="max-w-4xl">
                <div class="border-t-2 border-white w-20 md:w-32 mb-4"></div>
                <h2 class="text-2xl md:text-3xl font-bold uppercase text-white tracking-widest mb-8">Mengapa Komdes Sultra</h2>
                
                <div class="text-white text-justify md:text-left space-y-6 leading-loose text-base md:text-lg font-light opacity-95">
                    <p><strong class="font-bold">Kolaborasi</strong>, <strong class="font-bold">Keberlanjutan</strong>, dan <strong class="font-bold">Pemberdayaan</strong> adalah tiga pilar utama yang mendorong terbentuknya Komunitas Desa Sulawesi Tenggara.</p>
                    <p>Curabitur aliquet quam id dui posuere blandit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Tujuan & Intensi (White with hint of green) -->
    <section class="relative py-24 overflow-hidden bg-gradient-to-b from-primary-50/80 to-white">
        <!-- Concentric Circles Left Grey -->
        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/3 pointer-events-none opacity-5 hidden md:block">
            @for ($i = 0; $i < 15; $i++)
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full border border-zinc-800" style="width: {{ 400 + ($i * 60) }}px; height: {{ 400 + ($i * 60) }}px;"></div>
            @endfor
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            
            <!-- Tujuan (Right Aligned to the container bounds) -->
            <div class="mb-32 flex justify-end">
                <div class="max-w-4xl w-full flex flex-col md:items-end text-left md:text-right">
                    <div class="border-t-2 w-20 md:w-32 mb-4" style="border-color: var(--color-primary-700, #15803d);"></div>
                    <h2 class="text-2xl md:text-3xl font-bold uppercase tracking-widest mb-6" style="color: var(--color-primary-700, #15803d);">Tujuan Komdes Sultra</h2>
                    
                    <p class="italic text-lg mb-6 font-medium" style="color: var(--color-primary-700, #15803d);">
                        "Sebagai ruang belajar, berbagi ide dan pengetahuan serta melahirkan aksi dan produk belajar terkait pesisir dan pulau kecil di Sulawesi Tenggara"
                    </p>
                    
                    <ul class="space-y-4 text-zinc-700 text-base md:text-lg font-light md:max-w-3xl w-full">
                        <li class="flex flex-row md:flex-row-reverse items-start gap-4">
                            <svg class="w-6 h-6 mt-1 flex-shrink-0" style="color: var(--color-primary-700, #15803d);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-justify md:text-right leading-loose flex-grow">Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta.</span>
                        </li>
                        <li class="flex flex-row md:flex-row-reverse items-start gap-4">
                            <svg class="w-6 h-6 mt-1 flex-shrink-0" style="color: var(--color-primary-700, #15803d);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-justify md:text-right leading-loose flex-grow">Vivamus suscipit tortor eget felis porttitor volutpat.</span>
                        </li>
                        <li class="flex flex-row md:flex-row-reverse items-start gap-4">
                            <svg class="w-6 h-6 mt-1 flex-shrink-0" style="color: var(--color-primary-700, #15803d);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-justify md:text-right leading-loose flex-grow">Pellentesque in ipsum id orci porta dapibus.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Spacer to guarantee vertical distance -->
            <div class="h-20 md:h-32 w-full block" style="height: 6rem;"></div>

            <!-- Intensi (Left Aligned to the container bounds) -->
            <div class="flex justify-start">
                <div class="max-w-5xl w-full">
                    <div class="border-t-2 w-20 md:w-32 mb-4" style="border-color: var(--color-primary-700, #15803d);"></div>
                    <h2 class="text-2xl md:text-3xl font-bold uppercase tracking-widest mb-8" style="color: var(--color-primary-700, #15803d);">Intensi Bersama Komdes Sultra</h2>
                    
                    <ul class="space-y-6 text-zinc-700 text-base md:text-lg font-light">
                        <li class="flex items-start gap-4">
                            <svg class="w-6 h-6 mt-1 flex-shrink-0" style="color: var(--color-primary-700, #15803d);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-justify md:text-left leading-loose">Mengungkap fakta dan realitas kerentanan pesisir akibat perubahan iklim, pembangunan dan pemanfaatan sumberdaya alam ekstraktif.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <svg class="w-6 h-6 mt-1 flex-shrink-0" style="color: var(--color-primary-700, #15803d);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-justify md:text-left leading-loose">Belajar bersama praktek lokal terkait adaptasi, mitigasi dan risiliansi masyarakat pesisir terhadap perubahan untuk bisa diadopsi.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <svg class="w-6 h-6 mt-1 flex-shrink-0" style="color: var(--color-primary-700, #15803d);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-justify md:text-left leading-loose">Mengembangkan bersama mekanisme umpan balik dan keterlibatan aktif masyarakat dalam semua perencanaan pembangunan.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <svg class="w-6 h-6 mt-1 flex-shrink-0" style="color: var(--color-primary-700, #15803d);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-justify md:text-left leading-loose">Membangun dan mempromosikan aksi, produk, serta gerakan masyarakat pesisir untuk pengelolaan SDA yang lestari.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Sikap dan Deklarasi (Green) -->
    <section class="relative py-24 overflow-hidden" style="background: linear-gradient(135deg, var(--color-primary-500, #22c55e) 0%, var(--color-primary-700, #15803d) 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="border-t-2 border-white w-20 md:w-32 mb-4"></div>
            <h2 class="text-2xl md:text-3xl font-bold uppercase text-white tracking-widest mb-12">Sikap dan Deklarasi Komdes Sultra</h2>
            
            <div class="space-y-4 max-w-6xl">
                <!-- Item 1 -->
                <div class="flex flex-col md:flex-row">
                    <div class="w-16 h-16 md:w-24 md:h-auto flex-shrink-0 border border-white flex items-center justify-center text-white font-bold text-2xl mr-4 md:mr-6 mb-4 md:mb-0">
                        1.
                    </div>
                    <div class="bg-white p-6 md:p-8 flex-grow shadow-sm">
                        <p class="text-base md:text-lg leading-loose text-justify md:text-left font-light" style="color: var(--color-primary-700, #15803d);">
                            <strong class="font-bold">Independen & Objektif.</strong> Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et.
                        </p>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="flex flex-col md:flex-row">
                    <div class="w-16 h-16 md:w-24 md:h-auto flex-shrink-0 border border-white flex items-center justify-center text-white font-bold text-2xl mr-4 md:mr-6 mb-4 md:mb-0">
                        2.
                    </div>
                    <div class="bg-white p-6 md:p-8 flex-grow shadow-sm">
                        <p class="text-base md:text-lg leading-loose text-justify md:text-left font-light" style="color: var(--color-primary-700, #15803d);">
                            <strong class="font-bold">Pro Masyarakat.</strong> Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.
                        </p>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="flex flex-col md:flex-row">
                    <div class="w-16 h-16 md:w-24 md:h-auto flex-shrink-0 border border-white flex items-center justify-center text-white font-bold text-2xl mr-4 md:mr-6 mb-4 md:mb-0">
                        3.
                    </div>
                    <div class="bg-white p-6 md:p-8 flex-grow shadow-sm">
                        <p class="text-base md:text-lg leading-loose text-justify md:text-left font-light" style="color: var(--color-primary-700, #15803d);">
                            <strong class="font-bold">Pro Lingkungan Alam.</strong> Donec sollicitudin molestie malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Anggota (White with hint of green) -->
    <section class="relative py-24 overflow-hidden bg-gradient-to-b from-white to-primary-50/80">
        <!-- Concentric Circles Right Grey -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/3 pointer-events-none opacity-5 hidden md:block">
            @for ($i = 0; $i < 15; $i++)
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full border border-zinc-800" style="width: {{ 400 + ($i * 60) }}px; height: {{ 400 + ($i * 60) }}px;"></div>
            @endfor
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
            <div class="mb-16 flex flex-col md:items-end text-left md:text-right">
                <div class="border-t-2 w-20 md:w-32 mb-4" style="border-color: var(--color-primary-700, #15803d);"></div>
                <h2 class="text-2xl md:text-3xl font-bold uppercase tracking-widest" style="color: var(--color-primary-700, #15803d);">Profil Anggota Komdes Sultra</h2>
            </div>

            <!-- Clean grid, no borders, just logos -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 items-center justify-items-center">
                <template x-for="member in members" :key="member.id">
                    <button @click="openModal(member.id)" class="group focus:outline-none transition-transform transform hover:scale-110 flex flex-col items-center">
                        <img :src="member.logo" :alt="member.name" class="w-32 h-32 md:w-36 md:h-36 object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300">
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

        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-zinc-100"
                 @click.stop>
                
                <button @click="closeModal" class="absolute top-5 right-5 text-zinc-400 hover:text-zinc-900 transition-colors focus:outline-none bg-zinc-50 hover:bg-zinc-100 rounded-full p-2">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="p-8 sm:p-10">
                    <template x-if="selectedMember">
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 mb-8 flex items-center justify-center p-4 bg-zinc-50 rounded-[2rem] shadow-inner">
                                <img :src="selectedMember.logo" :alt="selectedMember.name" class="max-w-full max-h-full object-contain mix-blend-multiply">
                            </div>
                            
                            <h3 class="text-2xl font-bold mb-4 text-center" style="color: var(--color-primary-700, #15803d);" x-text="selectedMember.name"></h3>
                            <p class="text-sm text-zinc-500 text-center leading-relaxed mb-8" x-text="selectedMember.description"></p>
                            
                            <div class="flex items-center justify-center gap-4">
                                <template x-if="selectedMember.website">
                                    <a :href="selectedMember.website" target="_blank" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none" style="background-color: var(--color-primary-700, #15803d);" title="Kunjungi Website">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                    </a>
                                </template>
                                
                                <template x-if="selectedMember.instagram">
                                    <a :href="selectedMember.instagram" target="_blank" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none" style="background-color: var(--color-primary-700, #15803d);" title="Instagram">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </template>
                                
                                <template x-if="selectedMember.email">
                                    <a :href="selectedMember.email" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none" style="background-color: var(--color-primary-700, #15803d);" title="Kirim Email">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </a>
                                </template>

                                <template x-if="selectedMember.phone">
                                    <a :href="selectedMember.phone" class="w-12 h-12 rounded-2xl text-white flex items-center justify-center transition-all shadow-md hover:shadow-lg hover:-translate-y-1 focus:outline-none" style="background-color: var(--color-primary-700, #15803d);" title="Telepon">
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
