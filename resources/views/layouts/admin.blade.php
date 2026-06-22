<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSetting->site_name ?? config('app.name', 'Komdes Sultra') }} - Admin Panel</title>
    @if(isset($siteSetting) && $siteSetting->favicon)
        <link rel="icon" href="{{ asset($siteSetting->favicon) }}">
    @endif

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
                @if(isset($siteSetting) && $siteSetting->logo)
                    <img src="{{ asset($siteSetting->logo) }}" alt="Logo" class="h-10">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
                @endif
                <span class="font-bold text-lg tracking-tight drop-shadow-sm">
                    @if(isset($siteSetting) && !empty($siteSetting->site_name_segments))
                        @foreach($siteSetting->site_name_segments as $segment)
                            <span style="color: {{ $segment['color'] ?? '#165a3f' }}">{{ $segment['text'] }}</span>
                        @endforeach
                    @else
                        <span style="color: #165a3f">Komdes</span>
                        <span style="color: #FFD700">Sultra</span>
                    @endif
                </span>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden p-2 text-zinc-400 hover:text-zinc-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto"
             x-init="$el.scrollTop = sessionStorage.getItem('sidebarScroll') || 0"
             @scroll.debounce.100ms="sessionStorage.setItem('sidebarScroll', $el.scrollTop)">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold tracking-wider text-zinc-400 uppercase">Master Data</p>
            </div>
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
                    expanded: {{ request()->route('filterType') === 'berita' || request()->routeIs('admin.category.*') ? 'true' : 'false' }} 
                }" class="mb-1">
                <button @click="expanded = !expanded" class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl {{ request()->route('filterType') === 'berita' || request()->routeIs('admin.category.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Berita
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="expanded" x-collapse x-transition.duration.300ms class="pt-1 pb-2 space-y-1">
                    <a href="{{ route('admin.post.index', ['filterType' => 'berita']) }}" class="flex items-center gap-3 pl-12 pr-4 py-2.5 rounded-xl {{ request()->route('filterType') === 'berita' ? 'text-primary-700 font-semibold' : 'text-zinc-500 hover:text-zinc-900 font-medium' }} transition-colors text-sm">
                        <svg class="w-1.5 h-1.5 rounded-full {{ request()->route('filterType') === 'berita' ? 'bg-primary-600' : 'bg-zinc-400' }}" viewBox="0 0 2 2" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>
                        Semua Berita
                    </a>
                    <a href="{{ route('admin.category.index') }}" class="flex items-center gap-3 pl-12 pr-4 py-2.5 rounded-xl {{ request()->routeIs('admin.category.*') ? 'text-primary-700 font-semibold' : 'text-zinc-500 hover:text-zinc-900 font-medium' }} transition-colors text-sm">
                        <svg class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.category.*') ? 'bg-primary-600' : 'bg-zinc-400' }}" viewBox="0 0 2 2" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>
                        Kategori Berita
                    </a>
                </div>
            </div>
            <a href="{{ route('admin.post.index', ['filterType' => 'artikel']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->route('filterType') === 'artikel' ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Artikel
            </a>
            <a href="{{ route('admin.post.index', ['filterType' => 'riset']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->route('filterType') === 'riset' ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Publikasi Riset
            </a>
            <a href="{{ route('admin.post.index', ['filterType' => 'siaran-pers']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->route('filterType') === 'siaran-pers' ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
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
            @hasanyrole('Super Admin|Admin')
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
            <a href="{{ route('admin.setting.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.setting.index') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Pengaturan Situs
            </a>
            <a href="{{ route('admin.hero.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.hero.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Slider Beranda
            </a>
            <a href="{{ route('admin.member.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.member.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Anggota
            </a>
            <a href="{{ route('admin.storage.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.storage.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Tempat Sampah Gambar
            </a>
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold tracking-wider text-zinc-400 uppercase">Manajemen Pengguna</p>
            </div>
            <a href="{{ route('admin.user.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.user.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Manajemen Akun
            </a>
            @endhasanyrole
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold tracking-wider text-zinc-400 uppercase">Akun Saya</p>
            </div>
            <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.profile.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 font-medium' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Profil Saya
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-1 pb-4">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col min-h-screen lg:pl-72 transition-all duration-300">
        
        <!-- Header -->
        <header class="sticky top-0 z-30 flex items-center justify-between h-20 px-4 sm:px-6 lg:px-8 bg-white border-b border-zinc-200">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 mr-2 text-zinc-500 hover:text-zinc-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Role Badge -->
                <div class="hidden sm:flex items-center pl-2">
                    @if(auth()->user() && auth()->user()->roles->isNotEmpty())
                        @php
                            $roleName = auth()->user()->roles->first()->name;
                            $badgeColor = match($roleName) {
                                'Super Admin' => 'bg-red-50 text-red-700 border-red-100',
                                'Admin' => 'bg-primary-50 text-primary-700 border-primary-100',
                                'Mitra Media' => 'bg-blue-50 text-blue-700 border-blue-100',
                                default => 'bg-zinc-50 text-zinc-700 border-zinc-100'
                            };
                        @endphp
                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border {{ $badgeColor }}">
                            {{ $roleName }}
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative group">
                    <div class="flex items-center gap-3 p-1.5 rounded-xl hover:bg-zinc-50 transition-colors cursor-default">
                        <div class="hidden sm:flex flex-col text-right">
                            <span class="text-sm font-semibold text-zinc-700 group-hover:text-primary-700 transition-colors">{{ auth()->user()->name ?? 'Guest' }}</span>
                        </div>
                        <img src="{{ auth()->user() && auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'User') . '&background=165a3f&color=fff' }}" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-primary-100 shadow-sm object-cover group-hover:ring-2 group-hover:ring-primary-500 group-hover:ring-offset-2 transition-all">
                    </div>
                    
                    <!-- Dropdown on Hover -->
                    <div class="absolute right-0 top-full pt-1 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="bg-white rounded-xl shadow-lg border border-zinc-100 py-1 overflow-hidden">
                            <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 hover:text-primary-600 transition-colors">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil Saya
                                </div>
                            </a>
                            <div class="border-t border-zinc-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Keluar
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Offline Banner -->
        <div x-data="{ online: navigator.onLine }" 
             @online.window="online = true" 
             @offline.window="online = false" 
             x-show="!online" 
             style="display: none;"
             class="sticky top-20 z-20 w-full bg-red-500 text-white text-center py-2.5 text-sm font-medium shadow-sm transition-all"
        >
            <div class="flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414"/>
                </svg>
                Anda sedang offline. Koneksi internet terputus.
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 flex flex-col">
            <div class="max-w-7xl mx-auto w-full flex-1">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <footer class="mt-8 pt-4 border-t border-zinc-200 text-center">
                <p class="text-sm font-medium text-zinc-500">
                    &copy; {{ date('Y') }} Komdes Sultra.
                </p>
            </footer>
        </main>
    </div>

    <!-- Global Confirmation Modal -->
    <div x-data="{ 
            isOpen: false, 
            isProcessing: false,
            title: '', 
            message: '', 
            confirmText: 'Ya, Hapus', 
            cancelText: 'Batal',
            onConfirm: null 
        }" 
        @open-confirm-modal.window="
            isOpen = true;
            isProcessing = false;
            title = $event.detail.title;
            message = $event.detail.message;
            confirmText = $event.detail.confirmText || 'Ya, Hapus';
            cancelText = $event.detail.cancelText || 'Batal';
            onConfirm = $event.detail.onConfirm;
        "
        x-show="isOpen" 
        style="display: none;"
        class="relative z-[100]" 
        aria-labelledby="modal-title" 
        role="dialog" 
        aria-modal="true">
        
        <!-- Backdrop -->
        <div x-show="isOpen" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity"></div>
      
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal Panel -->
            <div x-show="isOpen" 
                 @click.away="isOpen = false"
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-zinc-100">
              <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                  </div>
                  <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-lg font-semibold leading-6 text-zinc-900" id="modal-title" x-text="title">Konfirmasi</h3>
                    <div class="mt-2">
                      <p class="text-sm text-zinc-500 leading-relaxed" x-html="message"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-zinc-100">
                  <button type="button" @click="isProcessing = true; if(onConfirm) { await onConfirm(); } isOpen = false; isProcessing = false;" :disabled="isProcessing" class="inline-flex items-center w-full justify-center rounded-xl bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-500 transition-colors sm:ml-3 sm:w-auto disabled:opacity-75 disabled:cursor-wait">
                      <svg x-show="isProcessing" style="display: none;" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                      <span x-text="isProcessing ? 'Memproses...' : confirmText"></span>
                  </button>
                  <button type="button" @click="isOpen = false" :disabled="isProcessing" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2 text-sm font-medium text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 transition-colors sm:mt-0 sm:w-auto disabled:opacity-50">
                      <span x-text="cancelText"></span>
                  </button>
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Global Toast Notification -->
    <x-toast />

    @livewireScripts
    @stack('scripts')
</body>
</html>
