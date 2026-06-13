<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Komdes Sultra - Komunitas Desa')</title>

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
<body class="bg-zinc-50 text-zinc-900 antialiased font-sans flex flex-col min-h-screen">

    <!-- Header / Navbar -->
    @php
        // Halaman anggota dan beranda butuh background solid sejak awal agar teks terbaca jelas
        $useSolidNav = request()->routeIs('anggota', 'home');
    @endphp
    <header :class="scrolled ? 'bg-[#165a3f]/95 backdrop-blur-md shadow-md border-white/10' : '{{ $useSolidNav ? 'bg-[#165a3f]' : 'bg-transparent' }} border-transparent shadow-none'" class="fixed w-full top-0 z-50 border-b transition-all duration-300" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center bg-white px-5 py-2 rounded-full shadow-sm border border-zinc-100">
                    <a href="/" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Komdes Sultra" class="h-10 md:h-11 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                        <span class="font-heading font-bold text-lg md:text-xl tracking-tight text-[#165a3f] transition-colors">Komdes <span class="text-[#FFD700]">Sultra</span></span>
                    </a>
                </div>

                <nav class="hidden md:flex space-x-1 lg:space-x-3 items-center">
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
                                <a href="{{ route('berita', ['category' => $cat->slug]) }}" class="block px-4 py-3 text-base {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">{{ $cat->name }}</a>
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
                                            <a href="{{ route('artikel', ['category' => $cat->slug]) }}" class="block px-4 py-3 text-sm {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">{{ $cat->name }}</a>
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
                                            <a href="{{ route('riset', ['category' => $cat->slug]) }}" class="block px-4 py-3 text-sm {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:bg-primary-50 hover:text-primary-600' }} transition-colors">{{ $cat->name }}</a>
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
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white/80 hover:text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white/50" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg x-show="!mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" style="display: none;">
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
             class="md:hidden bg-white border-b border-zinc-100 shadow-lg absolute w-full" 
             style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-50' }}">Beranda</a>
                <a href="{{ route('tentang-kami') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('tentang-kami') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-50' }}">Tentang Kami</a>
                <a href="{{ route('anggota') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('anggota') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-50' }}">Anggota</a>
                <div x-data="{ beritaOpen: {{ request()->routeIs('berita*') ? 'true' : 'false' }} }">
                    <div class="w-full flex justify-between items-center rounded-md {{ request()->routeIs('berita*') ? 'bg-primary-50' : 'hover:bg-zinc-50' }}">
                        <a href="{{ route('berita') }}" class="flex-grow px-3 py-2 text-base font-medium {{ request()->routeIs('berita*') ? 'text-primary-600' : 'text-zinc-700 hover:text-primary-600' }}">Berita</a>
                        <button @click="beritaOpen = !beritaOpen" class="px-3 py-2 focus:outline-none text-zinc-500 hover:text-primary-600">
                            <svg class="w-4 h-4 transition-transform duration-200" :class="beritaOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>
                    <div x-show="beritaOpen" class="pl-6 pr-3 py-2 space-y-1 bg-zinc-50/50 rounded-md mt-1" style="{{ request()->routeIs('berita*') ? '' : 'display: none;' }}">
                        @php
                            if (!isset($navBeritaCategories)) {
                                $navBeritaCategories = \App\Models\Category::where('type', 'berita')->get();
                            }
                        @endphp
                        @foreach($navBeritaCategories as $cat)
                        <a href="{{ route('berita', ['category' => $cat->slug]) }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-100' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-100' }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
                
                <div x-data="{ pubOpen: {{ request()->routeIs('acara*', 'artikel*', 'riset*', 'siaran-pers*') ? 'true' : 'false' }} }">
                    <button @click="pubOpen = !pubOpen" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('acara*', 'artikel*', 'riset*', 'siaran-pers*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-50' }}">
                        <span>Publikasi</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="pubOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="pubOpen" class="pl-6 pr-3 py-2 space-y-1 bg-zinc-50/50 rounded-md mt-1" style="{{ request()->routeIs('acara*', 'artikel*', 'riset*', 'siaran-pers*') ? '' : 'display: none;' }}">
                        <a href="{{ route('acara') }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('acara*') ? 'text-primary-600 bg-primary-100' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-100' }}">Acara</a>
                        
                        <!-- Artikel Mobile Accordion -->
                        @php
                            if (!isset($navArtikelCategories)) {
                                $navArtikelCategories = \App\Models\Category::where('type', 'artikel')->get();
                            }
                        @endphp
                        @if($navArtikelCategories->count() > 0)
                        <div x-data="{ artOpen: {{ request()->routeIs('artikel*') ? 'true' : 'false' }} }">
                            <div class="w-full flex justify-between items-center rounded-md {{ request()->routeIs('artikel*') ? 'bg-primary-100' : 'hover:bg-zinc-100' }}">
                                <a href="{{ route('artikel') }}" class="flex-grow px-3 py-2 text-sm font-medium {{ request()->routeIs('artikel*') ? 'text-primary-600' : 'text-zinc-600 hover:text-primary-600' }}">Artikel</a>
                                <button @click="artOpen = !artOpen" class="px-3 py-2 focus:outline-none text-zinc-500 hover:text-primary-600">
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="artOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                            </div>
                            <div x-show="artOpen" class="pl-4 pr-2 py-1 space-y-1 mt-1 border-l-2 border-primary-200 ml-2" style="{{ request()->routeIs('artikel*') ? '' : 'display: none;' }}">
                                @foreach($navArtikelCategories as $cat)
                                <a href="{{ route('artikel', ['category' => $cat->slug]) }}" class="block px-3 py-2 rounded-md text-xs font-medium {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-100' : 'text-zinc-500 hover:text-primary-600' }}">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a href="{{ route('artikel') }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('artikel*') ? 'text-primary-600 bg-primary-100' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-100' }}">Artikel</a>
                        @endif

                        <!-- Riset Mobile Accordion -->
                        @php
                            if (!isset($navRisetCategories)) {
                                $navRisetCategories = \App\Models\Category::where('type', 'riset')->get();
                            }
                        @endphp
                        @if($navRisetCategories->count() > 0)
                        <div x-data="{ risetOpen: {{ request()->routeIs('riset*') ? 'true' : 'false' }} }">
                            <div class="w-full flex justify-between items-center rounded-md {{ request()->routeIs('riset*') ? 'bg-primary-100' : 'hover:bg-zinc-100' }}">
                                <a href="{{ route('riset') }}" class="flex-grow px-3 py-2 text-sm font-medium {{ request()->routeIs('riset*') ? 'text-primary-600' : 'text-zinc-600 hover:text-primary-600' }}">Publikasi Riset</a>
                                <button @click="risetOpen = !risetOpen" class="px-3 py-2 focus:outline-none text-zinc-500 hover:text-primary-600">
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="risetOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                            </div>
                            <div x-show="risetOpen" class="pl-4 pr-2 py-1 space-y-1 mt-1 border-l-2 border-primary-200 ml-2" style="{{ request()->routeIs('riset*') ? '' : 'display: none;' }}">
                                @foreach($navRisetCategories as $cat)
                                <a href="{{ route('riset', ['category' => $cat->slug]) }}" class="block px-3 py-2 rounded-md text-xs font-medium {{ request('category') == $cat->slug ? 'text-primary-600 bg-primary-100' : 'text-zinc-500 hover:text-primary-600' }}">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a href="{{ route('riset') }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('riset*') ? 'text-primary-600 bg-primary-100' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-100' }}">Publikasi Riset</a>
                        @endif

                        <a href="{{ route('siaran-pers') }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('siaran-pers*') ? 'text-primary-600 bg-primary-100' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-100' }}">Siaran Pers</a>
                    </div>
                </div>
                
                <a href="{{ route('isu') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('isu*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-50' }}">Isu</a>
                <a href="{{ route('galeri') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('galeri*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-50' }}">Galeri</a>
                <a href="{{ route('kontak') }}" class="block px-3 py-2 rounded-md text-base font-medium text-primary-600 hover:text-primary-700 hover:bg-primary-50 mt-4 border border-primary-200 text-center">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-900 pt-16 pb-8 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-8 mb-12">
                <div class="col-span-1 md:col-span-1 lg:col-span-1">
                    <a href="/" class="inline-flex items-center gap-3 mb-6 group bg-white/5 p-2 pr-4 rounded-xl w-fit border border-white/10">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Komdes Sultra" class="h-14 md:h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                        <span class="font-heading font-bold text-xl md:text-2xl tracking-tight text-white transition-colors">Komdes <span class="text-[#FFD700]">Sultra</span></span>
                    </a>
                    <p class="text-zinc-400 text-sm leading-relaxed mb-6">
                        Lembaga Swadaya Masyarakat yang berdedikasi untuk pemberdayaan komunitas desa di Sulawesi Tenggara melalui advokasi, riset, dan program berkelanjutan.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-zinc-400 hover:text-primary-400 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="text-zinc-400 hover:text-primary-400 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="text-zinc-400 hover:text-primary-400 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-heading font-semibold text-white tracking-wider uppercase text-sm mb-4">Navigasi</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('tentang-kami') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('anggota') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Anggota</a></li>
                        <li><a href="{{ route('isu') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Isu Tematik</a></li>
                        <li><a href="{{ route('galeri') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Galeri Kegiatan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-heading font-semibold text-white tracking-wider uppercase text-sm mb-4">Konten</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('berita') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Berita Terkini</a></li>
                        <li><a href="{{ route('artikel') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Artikel & Opini</a></li>
                        <li><a href="{{ route('riset') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Publikasi Riset</a></li>
                        <li><a href="{{ route('siaran-pers') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Siaran Pers</a></li>
                        <li><a href="{{ route('acara') }}" class="text-zinc-400 hover:text-primary-400 transition-colors">Agenda Acara</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-heading font-semibold text-white tracking-wider uppercase text-sm mb-4">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-zinc-400">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-primary-500 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Pembangunan No. 45, Kendari, Sulawesi Tenggara 93111</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-primary-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:info@komdessultra.org" class="hover:text-white transition-colors">info@komdessultra.org</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-primary-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 811 2345 6789</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-zinc-800 pt-8 pb-4 flex flex-col md:flex-row justify-between items-center text-sm text-zinc-500">
                <p>&copy; {{ date('Y') }} Komdes Sultra. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
