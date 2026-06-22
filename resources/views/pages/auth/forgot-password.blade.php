<x-layouts::auth :title="__('Lupa Kata Sandi')">
    <div class="mb-8 text-center">
        <h2 class="text-base font-medium text-zinc-600">Lupa Kata Sandi?</h2>
        <p class="mt-1 text-sm text-zinc-500">
            Jangan khawatir! Masukkan alamat email yang terdaftar, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium text-center shadow-sm relative">
            <button @click="show = false" type="button" class="absolute top-2 right-2 text-green-500 hover:text-green-700 hover:bg-green-100 p-1.5 rounded-lg transition-colors shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            {{ session('status') }}
            @if(session('reset_email'))
                <br>ke email: <span class="font-bold">{{ session('reset_email') }}</span>
            @endif
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-zinc-700 mb-1">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" name="email" type="email" autocomplete="email" required autofocus placeholder="email@contoh.com" value="{{ old('email') }}" class="appearance-none block w-full pl-10 pr-3 py-3 border border-zinc-300 rounded-xl bg-zinc-50 text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all duration-200 sm:text-sm">
            </div>
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 hover:-translate-y-0.5 shadow-primary-500/30">
                Kirim Tautan Reset
            </button>
        </div>
    </form>

    <div class="mt-8 text-center text-sm text-zinc-500">
        <span>Atau kembali ke halaman</span>
        <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500 transition-colors" wire:navigate>
            Login
        </a>
    </div>
</x-layouts::auth>
