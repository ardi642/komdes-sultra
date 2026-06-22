<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Autentikasi' }} - {{ config('app.name', 'Komdes Sultra') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900 flex flex-col justify-center min-h-screen py-12 sm:px-6 lg:px-8">
    
    <!-- Card Container -->
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-xl shadow-zinc-200/50 sm:rounded-2xl sm:px-10 border border-zinc-100 relative overflow-hidden">
            <!-- Decorative top accent -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-400 to-primary-600"></div>
            
            <!-- Header / Logo Inside Card -->
            <div class="mb-10 mt-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-2" wire:navigate>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Komdes Sultra" class="h-16 w-auto drop-shadow-sm">
                    <span class="text-base font-bold text-zinc-700 tracking-wide mt-1">Komdes Sultra</span>
                </a>
            </div>

            {{ $slot }}
        </div>
        
        <!-- Footer / Back to home -->
        <div class="mt-8 text-center text-sm text-zinc-500">
            &copy; {{ date('Y') }} Komdes Sultra. Hak cipta dilindungi.
        </div>
    </div>

    @persist('toast')
        <!-- Any toast component if needed -->
    @endpersist
</body>
</html>
