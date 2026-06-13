<div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Tentang Kami</h2>
            <p class="text-gray-600 text-sm mt-1">Kelola konten halaman Tentang Kami (Profil, Tujuan, Intensi, Sikap).</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        
        <!-- Bagian 1: Informasi Dasar -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Dasar</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Utama (Hero Section)</label>
                    <textarea wire:model="hero_description" rows="3" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Mengenal lebih dekat..."></textarea>
                    @error('hero_description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profil Singkat</label>
                    <textarea wire:model="profil_singkat" rows="5" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    @error('profil_singkat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mengapa Komdes Sultra</label>
                    <textarea wire:model="mengapa_komdes" rows="5" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    @error('mengapa_komdes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Bagian 2: Tujuan Komdes Sultra -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Tujuan Komdes Sultra</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kutipan Tujuan (Quote)</label>
                    <textarea wire:model="tujuan_quote" rows="3" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder='Misal: "Sebagai ruang belajar..."'></textarea>
                    @error('tujuan_quote') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Poin Tujuan</label>
                    @foreach($tujuan_list as $index => $item)
                        <div class="flex gap-2 mb-2">
                            <textarea wire:model="tujuan_list.{{ $index }}" rows="3" class="bg-gray-100 focus:bg-white transition-colors flex-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Masukkan poin tujuan"></textarea>
                            <button wire:click="removeTujuan({{ $index }})" class="p-2 text-red-500 hover:bg-red-50 rounded-md transition-colors self-start" title="Hapus Poin">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                        @error('tujuan_list.'.$index) <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
                    @endforeach
                    <button wire:click="addTujuan" class="mt-2 text-sm text-green-600 font-medium hover:text-green-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Poin Tujuan
                    </button>
                </div>
            </div>
        </div>

        <!-- Bagian 3: Intensi Bersama -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Intensi Bersama Komdes Sultra</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Poin Intensi</label>
                    @foreach($intensi_list as $index => $item)
                        <div class="flex gap-2 mb-2">
                            <textarea wire:model="intensi_list.{{ $index }}" rows="2" class="bg-gray-100 focus:bg-white transition-colors flex-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Masukkan poin intensi"></textarea>
                            <button wire:click="removeIntensi({{ $index }})" class="p-2 text-red-500 hover:bg-red-50 rounded-md transition-colors" title="Hapus Poin">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                        @error('intensi_list.'.$index) <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
                    @endforeach
                    <button wire:click="addIntensi" class="mt-2 text-sm text-green-600 font-medium hover:text-green-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Poin Intensi
                    </button>
                </div>
            </div>
        </div>

        <!-- Bagian 4: Sikap dan Deklarasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Sikap dan Deklarasi</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Sikap</label>
                    @foreach($sikap_list as $index => $item)
                        <div class="flex gap-2 mb-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
                            <div class="flex-1 space-y-3">
                                <div>
                                    <input type="text" wire:model="sikap_list.{{ $index }}.title" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 font-medium" placeholder="Judul Sikap (Misal: Independen & Objektif)">
                                    @error('sikap_list.'.$index.'.title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <textarea wire:model="sikap_list.{{ $index }}.description" rows="2" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Deskripsi sikap"></textarea>
                                    @error('sikap_list.'.$index.'.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <button wire:click="removeSikap({{ $index }})" class="p-2 text-red-500 hover:bg-red-100 rounded-md transition-colors self-start" title="Hapus Poin">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @endforeach
                    <button wire:click="addSikap" class="mt-2 text-sm text-green-600 font-medium hover:text-green-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Sikap
                    </button>
                </div>
            </div>
        </div>

    </div>
    
    <div class="mt-6 flex justify-end">
        <button wire:click="store" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 flex items-center gap-2 text-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Simpan Pengaturan
        </button>
    </div>
</div>
