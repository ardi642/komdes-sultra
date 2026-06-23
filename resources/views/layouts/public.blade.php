<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', ($siteSetting->site_name ?? 'Komdes Sultra') . ' - Komunitas Desa')</title>
    @if(isset($siteSetting) && $siteSetting->favicon)
        <link rel="icon" href="{{ asset($siteSetting->favicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:500,600,700,800" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900 antialiased font-sans flex flex-col min-h-screen overflow-x-hidden w-full">

    <!-- Header / Navbar -->
    @php
        // Halaman anggota dan beranda butuh background solid sejak awal agar teks terbaca jelas
        $useSolidNav = request()->routeIs('anggota', 'home');
    @endphp
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" x-init="scrolled = (window.pageYOffset > 20)" @scroll.window="scrolled = (window.pageYOffset > 20)" :class="scrolled ? 'bg-[#165a3f] bg-opacity-95 backdrop-blur-md shadow-md border-white/10' : '{{ $useSolidNav ? 'bg-[#165a3f]' : 'bg-transparent' }} border-transparent shadow-none'" class="fixed w-full top-0 z-50 border-b border-transparent {{ $useSolidNav ? 'bg-[#165a3f]' : '' }} transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-3 group">
                        @if(isset($siteSetting) && $siteSetting->logo)
                            <img src="{{ asset($siteSetting->logo) }}" alt="Logo {{ $siteSetting->site_name }}" class="h-10 md:h-11 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-sm">
                        @else
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Komdes Sultra" class="h-10 md:h-11 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-sm">
                        @endif
                        <span class="font-heading font-bold text-lg md:text-xl tracking-tight transition-colors drop-shadow-sm">
                            @if(isset($siteSetting) && !empty($siteSetting->site_name_segments))
                                @foreach($siteSetting->site_name_segments as $segment)
                                    <span style="color: {{ $segment['color'] ?? '#ffffff' }}">{{ $segment['text'] }}</span>
                                @endforeach
                            @else
                                <span style="color: #ffffff">Komdes</span>
                                <span style="color: #FFD700">Sultra</span>
                            @endif
                        </span>
                    </a>
                </div>

                <nav class="hidden lg:flex space-x-1 lg:space-x-3 items-center">
                    <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }} transition-colors">Beranda</a>
                    <a href="{{ route('tentang-kami') }}" class="px-4 py-2.5 rounded-md text-base font-medium {{ request()->routeIs('tentang-kami') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }} transition-colors">Tentang Kami</a>
                    <a href="{{ route('anggota') }}" class="px-4 py-2.5 rounded-md text-base font-medium {{ request()->routeIs('anggota') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }} transition-colors">Anggota</a>
                    <!-- Dropdown Berita -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <a href="{{ route('berita') }}" class="flex items-center px-4 py-2.5 rounded-md text-base font-medium {{ request()->routeIs('berita', 'berita.*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }} transition-colors focus:outline-none">
                            <span>Berita</span>
                            <button @click.prevent="open = !open" class="ml-1.5 focus:outline-none">
                                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </a>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-0 w-56 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50 overflow-hidden" 
                             style="display: none;">
                            <div class="py-1">
                                @php
                                    $navBeritaCategories = \App\Models\Category::where('type', 'berita')->get();
                                @endphp
                                @foreach($navBeritaCategories as $cat)
                                <a href="{{ route('berita.kategori', $cat->slug) }}" class="block px-4 py-3 text-base {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dropdown Publikasi -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" class="flex items-center px-4 py-2.5 rounded-md text-base font-medium {{ request()->routeIs('acara*', 'artikel*', 'riset*', 'siaran-pers*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }} transition-colors focus:outline-none">
                            <span>Publikasi</span>
                            <svg class="ml-1.5 w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-0 w-48 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50" 
                             style="display: none;">
                            <div class="py-1">
                                <a href="{{ route('acara') }}" class="block px-4 py-3 text-base {{ request()->routeIs('acara*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">Acara</a>
                                
                                @php
                                    $navArtikelCategories = \App\Models\Category::where('type', 'artikel')->get();
                                @endphp
                                @if($navArtikelCategories->count() > 0)
                                <!-- Artikel with Flyout -->
                                <div class="relative group/artikel" x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false">
                                    <div class="flex justify-between items-center pr-4 hover:bg-primary-50 transition-colors">
                                        <a href="{{ route('artikel') }}" class="flex-grow block px-4 py-3 text-base {{ request()->routeIs('artikel*') ? 'text-primary-600' : 'text-zinc-700' }} transition-colors">Artikel</a>
                                        <button @click.prevent="subOpen = !subOpen" class="focus:outline-none">
                                            <svg class="w-4 h-4 text-zinc-400 group-hover/artikel:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>
                                    </div>
                                    <div x-show="subOpen" class="absolute left-full top-0 ml-1 w-56 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50 overflow-hidden" style="display: none;">
                                        <div class="py-1">
                                            @foreach($navArtikelCategories as $cat)
                                            <a href="{{ route('artikel.kategori', $cat->slug) }}" class="block px-4 py-3 text-sm {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">{{ $cat->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @else
                                <a href="{{ route('artikel') }}" class="block px-4 py-3 text-base {{ request()->routeIs('artikel*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">Artikel</a>
                                @endif

                                @php
                                    $navRisetCategories = \App\Models\Category::where('type', 'riset')->get();
                                @endphp
                                @if($navRisetCategories->count() > 0)
                                <!-- Riset with Flyout -->
                                <div class="relative group/riset" x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false">
                                    <div class="flex justify-between items-center pr-4 hover:bg-primary-50 transition-colors">
                                        <a href="{{ route('riset') }}" class="flex-grow block px-4 py-3 text-base {{ request()->routeIs('riset*') ? 'text-primary-600' : 'text-zinc-700' }} transition-colors">Publikasi Riset</a>
                                        <button @click.prevent="subOpen = !subOpen" class="focus:outline-none">
                                            <svg class="w-4 h-4 text-zinc-400 group-hover/riset:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>
                                    </div>
                                    <div x-show="subOpen" class="absolute left-full top-0 ml-1 w-56 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50 overflow-hidden" style="display: none;">
                                        <div class="py-1">
                                            @foreach($navRisetCategories as $cat)
                                            <a href="{{ route('riset.kategori', $cat->slug) }}" class="block px-4 py-3 text-sm {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">{{ $cat->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @else
                                <a href="{{ route('riset') }}" class="block px-4 py-3 text-base {{ request()->routeIs('riset*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">Publikasi Riset</a>
                                @endif

                                <a href="{{ route('siaran-pers') }}" class="block px-4 py-3 text-base {{ request()->routeIs('siaran-pers*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">Siaran Pers</a>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('isu') }}" class="px-4 py-2.5 rounded-md text-base font-medium {{ request()->routeIs('isu', 'isu.*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }} transition-colors">Isu</a>
                    <a href="{{ route('galeri') }}" class="px-4 py-2.5 rounded-md text-base font-medium {{ request()->routeIs('galeri', 'galeri.*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }} transition-colors">Galeri</a>
                    
                    <a href="{{ route('kontak') }}" class="ml-6 px-7 py-3 rounded-full text-base font-medium text-[#165a3f] bg-white hover:bg-zinc-100 shadow-md shadow-white/10 hover:shadow-lg hover:shadow-white/20 hover:-translate-y-0.5 transition-all duration-300">Kontak</a>
                </nav>

                <!-- Mobile menu button -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white/80 hover:text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white/50" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden bg-[#165a3f] border-b border-white/10 shadow-lg absolute w-full" 
             style="display: none;" x-cloak>
            <div class="px-4 pt-4 pb-6 space-y-2 max-h-[80vh] overflow-y-auto">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Beranda</a>
                <a href="{{ route('tentang-kami') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('tentang-kami') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Tentang Kami</a>
                <a href="{{ route('anggota') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('anggota') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Anggota</a>
                
                <div x-data="{ beritaOpen: {{ request()->routeIs('berita*') ? 'true' : 'false' }} }">
                    <button @click="beritaOpen = !beritaOpen" class="w-full flex justify-between items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('berita*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <span>Berita</span>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="beritaOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="beritaOpen" class="pl-4 pr-2 py-2 space-y-1 bg-black/10 rounded-lg mt-1 mx-2" style="{{ request()->routeIs('berita*') ? '' : 'display: none;' }}">
                        @php
                            if (!isset($navBeritaCategories)) {
                                $navBeritaCategories = \App\Models\Category::where('type', 'berita')->get();
                            }
                        @endphp
                        @foreach($navBeritaCategories as $cat)
                        <a href="{{ route('berita.kategori', $cat->slug) }}" class="block px-4 py-2.5 rounded-md text-sm font-medium {{ request('category') == $cat->slug ? 'text-white bg-white/20' : 'text-white/70 hover:text-white hover:bg-white/10' }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
                
                <div x-data="{ pubOpen: {{ request()->routeIs('acara*', 'artikel*', 'riset*', 'siaran-pers*') ? 'true' : 'false' }} }">
                    <button @click="pubOpen = !pubOpen" class="w-full flex justify-between items-center px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('acara*', 'artikel*', 'riset*', 'siaran-pers*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <span>Publikasi</span>
                        <svg class="w-5 h-5 transition-transform duration-200" :class="pubOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="pubOpen" class="pl-4 pr-2 py-2 space-y-2 bg-black/10 rounded-lg mt-1 mx-2" style="{{ request()->routeIs('acara*', 'artikel*', 'riset*', 'siaran-pers*') ? '' : 'display: none;' }}">
                        <a href="{{ route('acara') }}" class="block px-4 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('acara*') ? 'text-white bg-white/20' : 'text-white/70 hover:text-white hover:bg-white/10' }}">Acara</a>
                        
                        <!-- Artikel Mobile Accordion -->
                        @php
                            if (!isset($navArtikelCategories)) {
                                $navArtikelCategories = \App\Models\Category::where('type', 'artikel')->get();
                            }
                        @endphp
                        @if($navArtikelCategories->count() > 0)
                        <div x-data="{ artOpen: {{ request()->routeIs('artikel*') ? 'true' : 'false' }} }">
                            <div class="w-full flex justify-between items-center rounded-md {{ request()->routeIs('artikel*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                <a href="{{ route('artikel') }}" class="flex-grow px-4 py-2.5 text-sm font-medium {{ request()->routeIs('artikel*') ? 'text-white' : 'text-white/70 hover:text-white' }}">Artikel</a>
                                <button @click.prevent="artOpen = !artOpen" class="px-4 py-2.5 focus:outline-none text-white/50 hover:text-white">
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="artOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                            </div>
                            <div x-show="artOpen" class="pl-4 pr-2 py-1 space-y-1 mt-1 border-l border-white/20 ml-4" style="{{ request()->routeIs('artikel*') ? '' : 'display: none;' }}">
                                @foreach($navArtikelCategories as $cat)
                                <a href="{{ route('artikel.kategori', $cat->slug) }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request('category') == $cat->slug ? 'text-white bg-white/20' : 'text-white/60 hover:text-white hover:bg-white/10' }}">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a href="{{ route('artikel') }}" class="block px-4 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('artikel*') ? 'text-white bg-white/20' : 'text-white/70 hover:text-white hover:bg-white/10' }}">Artikel</a>
                        @endif
                        
                        <!-- Riset Mobile Accordion -->
                        @php
                            if (!isset($navRisetCategories)) {
                                $navRisetCategories = \App\Models\Category::where('type', 'riset')->get();
                            }
                        @endphp
                        @if($navRisetCategories->count() > 0)
                        <div x-data="{ risetOpen: {{ request()->routeIs('riset*') ? 'true' : 'false' }} }">
                            <div class="w-full flex justify-between items-center rounded-md {{ request()->routeIs('riset*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                                <a href="{{ route('riset') }}" class="flex-grow px-4 py-2.5 text-sm font-medium {{ request()->routeIs('riset*') ? 'text-white' : 'text-white/70 hover:text-white' }}">Publikasi Riset</a>
                                <button @click.prevent="risetOpen = !risetOpen" class="px-4 py-2.5 focus:outline-none text-white/50 hover:text-white">
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="risetOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                            </div>
                            <div x-show="risetOpen" class="pl-4 pr-2 py-1 space-y-1 mt-1 border-l border-white/20 ml-4" style="{{ request()->routeIs('riset*') ? '' : 'display: none;' }}">
                                @foreach($navRisetCategories as $cat)
                                <a href="{{ route('riset.kategori', $cat->slug) }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request('category') == $cat->slug ? 'text-white bg-white/20' : 'text-white/60 hover:text-white hover:bg-white/10' }}">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a href="{{ route('riset') }}" class="block px-4 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('riset*') ? 'text-white bg-white/20' : 'text-white/70 hover:text-white hover:bg-white/10' }}">Publikasi Riset</a>
                        @endif

                        <a href="{{ route('siaran-pers') }}" class="block px-4 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('siaran-pers*') ? 'text-white bg-white/20' : 'text-white/70 hover:text-white hover:bg-white/10' }}">Siaran Pers</a>
                    </div>
                </div>
                
                <a href="{{ route('isu') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('isu*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Isu</a>
                <a href="{{ route('galeri') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('galeri*') ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10' }}">Galeri</a>
                <a href="{{ route('kontak') }}" class="block px-4 py-3 rounded-full text-base font-bold text-[#165a3f] bg-[#FFD700] hover:bg-white mt-6 border border-transparent text-center transition-colors shadow-md">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#114a33] pt-16 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-12 gap-y-12 gap-x-8 lg:gap-16 mb-12 text-left">
                <!-- Brand & Mission -->
                <div class="col-span-2 md:col-span-5 space-y-6 flex flex-col items-start">
                    <a href="/" class="inline-flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 hover:bg-white/10 transition-colors group">
                        @if(isset($siteSetting) && $siteSetting->logo)
                            <img src="{{ asset($siteSetting->logo) }}" alt="Logo {{ $siteSetting->site_name }}" class="h-12 w-auto object-contain group-hover:scale-105 transition-transform duration-300 drop-shadow-md">
                        @else
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Komdes Sultra" class="h-12 w-auto object-contain group-hover:scale-105 transition-transform duration-300 drop-shadow-md">
                        @endif
                        <span class="font-heading font-bold text-2xl tracking-tight transition-colors drop-shadow-sm">
                            @if(isset($siteSetting) && !empty($siteSetting->site_name_segments))
                                @foreach($siteSetting->site_name_segments as $segment)
                                    <span style="color: {{ $segment['color'] ?? '#ffffff' }}">{{ $segment['text'] }}</span>
                                @endforeach
                            @else
                                <span style="color: #ffffff">Komdes</span>
                                <span style="color: #FFD700">Sultra</span>
                            @endif
                        </span>
                    </a>
                    <p class="text-white/70 text-sm leading-relaxed mb-6 max-w-md">
                        {{ \App\Models\SiteSetting::where('key', 'footer_description')->value('value') }}
                    </p>
                </div>
                
                <div class="col-span-1 md:col-span-2">
                    <h3 class="font-heading font-semibold text-white tracking-wider uppercase text-sm mb-4">Navigasi</h3>
                    <ul class="space-y-3 text-sm flex flex-col items-start">
                        <li><a href="{{ route('home') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Beranda</a></li>
                        <li><a href="{{ route('tentang-kami') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('anggota') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Anggota</a></li>
                        <li><a href="{{ route('isu') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Isu Tematik</a></li>
                        <li><a href="{{ route('galeri') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Galeri Kegiatan</a></li>
                    </ul>
                </div>
                
                <div class="col-span-1 md:col-span-2">
                    <h3 class="font-heading font-semibold text-white tracking-wider uppercase text-sm mb-4">Konten</h3>
                    <ul class="space-y-3 text-sm flex flex-col items-start">
                        <li><a href="{{ route('berita') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Berita Terkini</a></li>
                        <li><a href="{{ route('artikel') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Artikel & Opini</a></li>
                        <li><a href="{{ route('riset') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Publikasi Riset</a></li>
                        <li><a href="{{ route('siaran-pers') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Siaran Pers</a></li>
                        <li><a href="{{ route('acara') }}" class="text-white/70 hover:text-[#FFD700] transition-colors">Agenda Acara</a></li>
                    </ul>
                </div>

                <div class="col-span-2 md:col-span-3">
                    <h3 class="font-heading font-semibold text-white tracking-wider uppercase text-sm mb-4">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-white/70 flex flex-col items-start">
                        <li class="flex flex-row items-start text-left gap-3">
                            <svg class="h-5 w-5 text-white/50 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $siteSetting->address ?? 'Jl. Pembangunan No. 45, Kendari, Sulawesi Tenggara 93111' }}</span>
                        </li>
                        <li class="flex flex-row items-start gap-3">
                            <svg class="h-5 w-5 text-white/50 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ $siteSetting->email ?? 'info@komdessultra.org' }}" class="hover:text-white transition-colors break-all">{{ $siteSetting->email ?? 'info@komdessultra.org' }}</a>
                        </li>
                        <li class="flex flex-row items-start gap-3">
                            <svg class="h-5 w-5 text-white/50 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>{{ $siteSetting->phone ?? '+62 811 2345 6789' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Darker Bottom Bar -->
        <div class="bg-[#0c3826] py-5 mt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-sm text-white/50">
                <div class="flex space-x-5 mb-4 md:mb-0">
                    @if(!empty($siteSetting->facebook_url))
                    <a href="{{ $siteSetting->facebook_url }}" target="_blank" class="text-white/50 hover:text-white transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    @endif
                    @if(!empty($siteSetting->instagram_url))
                    <a href="{{ $siteSetting->instagram_url }}" target="_blank" class="text-white/50 hover:text-white transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                    @endif
                    @if(!empty($siteSetting->twitter_url))
                    <a href="{{ $siteSetting->twitter_url }}" target="_blank" class="text-white/50 hover:text-white transition-colors">
                        <span class="sr-only">Twitter/X</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    @endif
                    @if(!empty($siteSetting->tiktok_url))
                    <a href="{{ $siteSetting->tiktok_url }}" target="_blank" class="text-white/50 hover:text-white transition-colors">
                        <span class="sr-only">TikTok</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-.9 4.41-2.4 6.02-1.6 1.7-3.9 2.71-6.24 2.89-2.3.16-4.66-.27-6.57-1.57-1.8-1.21-3.07-3.11-3.48-5.23-.42-2.15-.05-4.4 1.05-6.27 1.15-1.92 3.12-3.3 5.31-3.84 1.93-.47 3.99-.36 5.86.36v4.15c-1.17-.45-2.5-.52-3.7-.17-.99.28-1.86.9-2.41 1.76-.51.81-.7 1.8-.52 2.74.19.98.78 1.84 1.62 2.37.89.56 2.01.69 3.02.43 1.05-.27 1.93-.97 2.4-1.94.33-.68.45-1.44.47-2.19.01-4.73.01-9.45.02-14.18Z" /></svg>
                    </a>
                    @endif
                    @if(!empty($siteSetting->youtube_url))
                    <a href="{{ $siteSetting->youtube_url }}" target="_blank" class="text-white/50 hover:text-white transition-colors">
                        <span class="sr-only">YouTube</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                    @if(!empty($siteSetting->linkedin_url))
                    <a href="{{ $siteSetting->linkedin_url }}" target="_blank" class="text-white/50 hover:text-white transition-colors">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                </div>
                <p>&copy; {{ date('Y') }} {{ $siteSetting->site_name ?? 'Komdes Sultra' }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
