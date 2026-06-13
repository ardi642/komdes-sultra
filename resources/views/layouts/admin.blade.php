<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Komdes Sultra') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- TinyMCE CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-zinc-50 text-zinc-900" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-zinc-900/80 backdrop-blur-sm lg:hidden" 
         x-transition.opacity 
         @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 flex flex-col w-72 bg-white border-r border-zinc-200 transition-transform duration-300 lg:translate-x-0">
        
        <div class="flex items-center justify-between h-20 px-6 border-b border-zinc-100">
            <a href="#" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
                <span class="font-bold text-lg text-primary-900 tracking-tight">Admin Panel</span>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden p-2 text-zinc-400 hover:text-zinc-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold tracking-wider text-zinc-400 uppercase">Master Data</p>
            </div>
            <a href="{{ route('admin.member.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.member.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Anggota
            </a>

            <a href="{{ route('admin.tag.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.tag.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                Tag Global
            </a>
            <a href="{{ route('admin.issue.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.issue.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                Fokus Isu
            </a>
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold tracking-wider text-zinc-400 uppercase">Konten Publikasi</p>
            </div>
            <div x-data="{ 
                    expanded: {{ request()->query('filterType') === 'berita' || request()->routeIs('admin.category.*') ? 'true' : 'false' }} 
                }" class="mb-1">
                <button @click="expanded = !expanded" class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl {{ request()->query('filterType') === 'berita' || request()->routeIs('admin.category.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Berita
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="expanded" x-collapse x-transition.duration.300ms class="pt-1 pb-2 space-y-1">
                    <a href="{{ route('admin.post.index', ['filterType' => 'berita']) }}" class="flex items-center gap-3 pl-12 pr-4 py-2.5 rounded-xl {{ request()->query('filterType') === 'berita' ? 'text-primary-700 font-semibold' : 'text-zinc-500 hover:text-zinc-900 font-medium' }} transition-colors text-sm">
                        <svg class="w-1.5 h-1.5 rounded-full {{ request()->query('filterType') === 'berita' ? 'bg-primary-600' : 'bg-zinc-400' }}" viewBox="0 0 2 2" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>
                        Semua Berita
                    </a>
                    <a href="{{ route('admin.category.index') }}" class="flex items-center gap-3 pl-12 pr-4 py-2.5 rounded-xl {{ request()->routeIs('admin.category.*') ? 'text-primary-700 font-semibold' : 'text-zinc-500 hover:text-zinc-900 font-medium' }} transition-colors text-sm">
                        <svg class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.category.*') ? 'bg-primary-600' : 'bg-zinc-400' }}" viewBox="0 0 2 2" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>
                        Kategori Berita
                    </a>
                </div>
            </div>
            <a href="{{ route('admin.post.index', ['filterType' => 'artikel']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->query('filterType') === 'artikel' ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Artikel
            </a>
            <a href="{{ route('admin.post.index', ['filterType' => 'riset']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->query('filterType') === 'riset' ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Publikasi Riset
            </a>
            <a href="{{ route('admin.post.index', ['filterType' => 'siaran_pers']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->query('filterType') === 'siaran_pers' ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                Siaran Pers
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.gallery.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Galeri Kegiatan
            </a>
            <a href="{{ route('admin.event.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.event.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Agenda Acara
            </a>
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold tracking-wider text-zinc-400 uppercase">Interaksi</p>
            </div>
            <a href="{{ route('admin.inbox.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.inbox.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Laporan & Aduan
            </a>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold tracking-wider text-zinc-400 uppercase">Pengaturan Situs</p>
            </div>
            <a href="{{ route('admin.homepage.setting') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.homepage.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Pengaturan Beranda
            </a>
            <a href="{{ route('admin.hero.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.hero.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Slider Beranda
            </a>
            <a href="{{ route('admin.about.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.about.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Tentang Kami
            </a>
            <a href="{{ route('admin.contact.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.contact.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Kontak Utama
            </a>
        </nav>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col min-h-screen lg:pl-72 transition-all duration-300">
        
        <!-- Header -->
        <header class="sticky top-0 z-30 flex items-center justify-between h-20 px-4 sm:px-6 lg:px-8 bg-white border-b border-zinc-200">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-zinc-500 hover:text-zinc-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-zinc-700 hidden sm:block">Admin Komdes</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=165a3f&color=fff" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-zinc-100 shadow-sm">
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
