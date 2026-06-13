<div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Kontak Utama</h2>
            <p class="text-gray-600 text-sm mt-1">Kelola informasi kontak dan logo sekretariat.</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-4xl">
        <div class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" wire:model="phone" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Contoh: 082290533640">
                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" wire:model="email" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Contoh: kantor@jaringnusa.id">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
                    <input type="text" wire:model="website" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Contoh: jaringnusa.id">
                    @error('website') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea wire:model="address" rows="3" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Masukkan alamat lengkap..."></textarea>
                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Sekretariat (Opsional)</label>
                    <div class="flex items-start gap-6">
                        <div class="w-32 h-32 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0">
                            @if ($new_logo)
                                <img src="{{ $new_logo->temporaryUrl() }}" class="max-w-full max-h-full object-contain">
                            @elseif ($logo)
                                <img src="{{ asset($logo) }}" class="max-w-full max-h-full object-contain">
                            @else
                                <span class="text-gray-400 text-sm">Belum ada logo</span>
                            @endif
                        </div>
                        <div class="flex-grow space-y-2 mt-2">
                            <input type="file" wire:model="new_logo" id="new_logo" class="hidden" accept="image/*">
                            <label for="new_logo" class="inline-block px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer">
                                Pilih Gambar Baru
                            </label>
                            <p class="text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                            <div wire:loading wire:target="new_logo" class="text-sm text-green-600 mt-2">
                                Sedang mengunggah...
                            </div>
                            @error('new_logo') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end border-t pt-6">
                <button wire:click="store" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Pengaturan
                </button>
            </div>
            
        </div>
    </div>
</div>
