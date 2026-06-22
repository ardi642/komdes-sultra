<div>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">{{ $isEdit ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}</h1>
            <p class="text-sm text-zinc-500 mt-1">Isi formulir di bawah ini untuk mengelola akun pengguna.</p>
        </div>
        <div>
            <a href="{{ route('admin.user.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-zinc-300 text-zinc-700 rounded-xl text-sm font-semibold hover:bg-zinc-50 transition-colors shadow-sm">
                Batal & Kembali
            </a>
        </div>
    </div>

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 flex items-center gap-3 justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            <button @click="show = false" type="button" class="text-red-500 hover:text-red-700 hover:bg-red-100 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    <form wire:submit="save" class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="p-6 sm:p-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="name" wire:model="name" class="mt-1 block w-full py-3 px-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors" placeholder="Masukkan nama lengkap pengguna">
                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700">Alamat Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" wire:model="email" class="mt-1 block w-full py-3 px-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors" placeholder="Masukkan alamat email pengguna">
                    @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="posisi" class="block text-sm font-medium text-zinc-700">Posisi</label>
                    <input type="text" id="posisi" wire:model="posisi" placeholder="Misal: Reporter, Redaktur, Kepala Desa" class="mt-1 block w-full py-3 px-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors">
                    @error('posisi') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-zinc-700">Peran Sistem (Role) <span class="text-red-500">*</span></label>
                    <select id="role" wire:model="role" class="mt-1 block w-full py-3 px-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors">
                        @foreach($roles as $r)
                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-zinc-500">
                        *Admin = Akses Penuh Konten & Akun Mitra. *Mitra Media = Akses ke konten buatannya sendiri.
                    </p>
                    @error('role') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="border-zinc-100">

            <div>
                <h3 class="text-sm font-medium text-zinc-900 mb-4">Pengaturan Kata Sandi</h3>
                @if($isEdit)
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-amber-800">Mode Ubah Kata Sandi (Opsional)</h3>
                                <div class="mt-2 text-sm text-amber-700">
                                    <p>Kosongkan kolom kata sandi jika Anda <strong>tidak ingin</strong> mengubah kata sandi pengguna ini.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-1/2" x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-zinc-700">Kata Sandi {{ $isEdit ? 'Baru' : '' }} {!! !$isEdit ? '<span class="text-red-500">*</span>' : '' !!}</label>
                        <div class="relative mt-1">
                            <input x-bind:type="show ? 'text' : 'password'" id="password" wire:model="password" autocomplete="new-password" class="block w-full py-3 pl-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors pr-10" placeholder="Minimal 8 karakter">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-600 focus:outline-none">
                                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </button>
                        </div>
                        @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:w-1/2" x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Konfirmasi Kata Sandi {{ $isEdit ? 'Baru' : '' }} {!! !$isEdit ? '<span class="text-red-500">*</span>' : '' !!}</label>
                        <div class="relative mt-1">
                            <input x-bind:type="show ? 'text' : 'password'" id="password_confirmation" wire:model="password_confirmation" autocomplete="new-password" class="block w-full py-3 pl-4 rounded-xl border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm transition-colors pr-10" placeholder="Ulangi kata sandi">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-600 focus:outline-none">
                                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-zinc-50 px-6 py-4 border-t border-zinc-100 flex items-center justify-end gap-3">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all shadow-sm">
                <span wire:loading.remove wire:target="save">Simpan Pengguna</span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Menyimpan...
                </span>
            </button>
        </div>
    </form>
</div>
