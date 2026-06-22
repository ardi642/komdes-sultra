<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Profil Saya</h1>
        <p class="text-sm text-zinc-500 mt-1">Kelola informasi publik dan keamanan akun Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Informasi Profil -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-zinc-100">
                    <h2 class="text-lg font-semibold text-zinc-900">Informasi Pribadi</h2>
                    <p class="text-sm text-zinc-500 mt-1">Perbarui foto profil dan detail informasi Anda.</p>
                </div>
                
                <form wire:submit="updateProfile" class="p-6">
                    @if (session('profile_message'))
                        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-sm font-medium">{{ session('profile_message') }}</span>
                            </div>
                            <button @click="show = false" type="button" class="text-green-500 hover:text-green-700 hover:bg-green-100 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    @endif

                    <div class="space-y-6">
                        
                        <!-- Avatar Upload -->
                        <div class="flex items-center gap-6">
                            <div class="relative shrink-0">
                                @if ($new_avatar)
                                    <img src="{{ $new_avatar->temporaryUrl() }}" alt="Preview Avatar" class="w-20 h-20 rounded-full border-4 border-white shadow-md object-cover">
                                @else
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=165a3f&color=fff' }}" alt="Current Avatar" class="w-20 h-20 rounded-full border-4 border-white shadow-md object-cover">
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-2">Foto Profil Baru</label>
                                <div class="flex items-center gap-3">
                                    <label class="relative cursor-pointer bg-white py-2 px-4 border border-zinc-300 rounded-xl shadow-sm text-sm font-medium text-zinc-700 hover:bg-zinc-50 transition-colors focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                        <span>Pilih Gambar</span>
                                        <input type="file" wire:model="new_avatar" class="sr-only" accept="image/*">
                                    </label>
                                    <span class="text-xs text-zinc-500" wire:loading wire:target="new_avatar">Mengunggah...</span>
                                </div>
                                @error('new_avatar') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-zinc-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="name" wire:model="name" class="mt-1 block w-full py-3 px-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors">
                                @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="posisi" class="block text-sm font-medium text-zinc-700">Posisi</label>
                                <input type="text" id="posisi" wire:model="posisi" class="mt-1 block w-full py-3 px-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors" placeholder="Mis: Kepala Desa, Penulis">
                                @error('posisi') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" wire:model.live="email" class="mt-1 block w-full py-3 px-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors">
                            @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            
                            @if($email !== auth()->user()->email)
                                <div class="mt-4 p-4 bg-amber-50 rounded-xl border border-amber-200">
                                    <label for="profile_current_password" class="block text-sm font-medium text-amber-900">Verifikasi Perubahan Email <span class="text-red-500">*</span></label>
                                    <p class="text-xs text-amber-700 mt-1 mb-3">Untuk alasan keamanan, masukkan kata sandi Anda saat ini untuk mengonfirmasi perubahan alamat email.</p>
                                    <div class="relative mt-1" x-data="{ show: false }">
                                        <input x-bind:type="show ? 'text' : 'password'" id="profile_current_password" wire:model="profile_current_password" autocomplete="new-password" class="block w-full py-3 pl-4 rounded-xl border-amber-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm transition-colors pr-10">
                                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-amber-500 hover:text-amber-700 focus:outline-none">
                                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                        </button>
                                    </div>
                                    @error('profile_current_password') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all shadow-sm">
                            <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
                            <span wire:loading wire:target="updateProfile" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ubah Password -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-zinc-100">
                    <h2 class="text-lg font-semibold text-zinc-900">Ubah Kata Sandi</h2>
                    <p class="text-sm text-zinc-500 mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                </div>
                
                <form wire:submit="updatePassword" class="p-6">
                    @if (session('password_message'))
                        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-sm font-medium">{{ session('password_message') }}</span>
                            </div>
                            <button @click="show = false" type="button" class="text-green-500 hover:text-green-700 hover:bg-green-100 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    @endif

                    <div class="space-y-5">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-zinc-700">Kata Sandi Saat Ini</label>
                            <div class="relative mt-1" x-data="{ show: false }">
                                <input x-bind:type="show ? 'text' : 'password'" id="current_password" wire:model="current_password" autocomplete="new-password" class="block w-full py-3 pl-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors pr-10">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-600 focus:outline-none">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                            @error('current_password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-zinc-700">Kata Sandi Baru</label>
                            <div class="relative mt-1" x-data="{ show: false }">
                                <input x-bind:type="show ? 'text' : 'password'" id="password" wire:model="password" autocomplete="new-password" class="block w-full py-3 pl-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors pr-10">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-600 focus:outline-none">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                            @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Konfirmasi Kata Sandi Baru</label>
                            <div class="relative mt-1" x-data="{ show: false }">
                                <input x-bind:type="show ? 'text' : 'password'" id="password_confirmation" wire:model="password_confirmation" autocomplete="new-password" class="block w-full py-3 pl-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors pr-10">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-600 focus:outline-none">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                            @error('password_confirmation') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-zinc-900 text-white text-sm font-semibold hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 transition-all shadow-sm">
                            <span wire:loading.remove wire:target="updatePassword">Perbarui Kata Sandi</span>
                            <span wire:loading wire:target="updatePassword" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="bg-primary-50 rounded-2xl p-6 border border-primary-100 flex items-start gap-4">
                <div class="bg-primary-100 text-primary-600 p-2 rounded-lg shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-primary-900">Peran Akun Anda</h4>
                    <p class="text-sm text-primary-700 mt-1">
                        Anda saat ini masuk sebagai <strong>{{ auth()->user() ? auth()->user()->roles->first()?->name : '-' }}</strong>. 
                        Akses Anda diatur berdasarkan peran yang ditetapkan oleh sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
