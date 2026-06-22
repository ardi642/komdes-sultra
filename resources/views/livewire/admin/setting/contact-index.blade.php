<div>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-2">
                {{ session('message') }}
            </div>
            <button @click="show = false" type="button" class="text-green-600 hover:text-green-800 hover:bg-green-200 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    <div class="max-w-4xl">
        <div class="space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-100 pb-8">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Situs Utama (Teks Biasa)</label>
                    <input type="text" wire:model="site_name" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="Contoh: Komdes Sultra">
                    <p class="text-xs text-gray-500 mt-1">Digunakan untuk judul tab browser dan teks SEO.</p>
                    @error('site_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="border-b border-gray-100 pb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Teks Logo Visual</h3>
                <p class="text-sm text-gray-500 mb-4">Tambahkan kata dan pilih warnanya untuk ditampilkan pada logo di halaman website.</p>
                
                <div class="space-y-4">
                    @foreach($site_name_segments as $index => $segment)
                        <div>
                            <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-lg border border-gray-200">
                                <span class="font-bold text-gray-400 text-sm w-6">{{ $index + 1 }}.</span>
                                <input type="text" wire:model="site_name_segments.{{ $index }}.text" class="flex-1 bg-white focus:bg-white transition-colors rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="Contoh: Komdes">
                                <input type="color" wire:model="site_name_segments.{{ $index }}.color" class="h-[42px] w-12 rounded-md border-gray-300 shadow-sm cursor-pointer p-1 bg-white">
                                <button type="button" wire:click="removeSegment({{ $index }})" class="p-2 text-red-500 hover:bg-red-50 rounded-md transition-colors" title="Hapus Kata">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                            @error('site_name_segments.'.$index.'.text') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                </div>
                
                <button type="button" wire:click="addSegment" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Kata
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" wire:model="phone" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="Contoh: 082290533640">
                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" wire:model="email" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="Contoh: kantor@jaringnusa.id">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
                    <input type="text" wire:model="website" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="Contoh: jaringnusa.id">
                    @error('website') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea wire:model="address" rows="3" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-3" placeholder="Masukkan alamat lengkap..."></textarea>
                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo Utama</label>
                        <div class="flex items-start gap-4">
                            <div class="w-32 h-32 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0 p-2">
                                @if ($new_logo)
                                    <img src="{{ $new_logo->temporaryUrl() }}" class="max-w-full max-h-full object-contain">
                                @elseif ($logo)
                                    <img src="{{ asset($logo) }}" class="max-w-full max-h-full object-contain">
                                @else
                                    <span class="text-gray-400 text-xs text-center">Belum ada logo</span>
                                @endif
                            </div>
                            <div class="flex-grow space-y-2 mt-2">
                                <input type="file" wire:model="new_logo" id="new_logo" class="hidden" accept="image/*">
                                <label for="new_logo" class="inline-block px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer">
                                    Pilih Gambar
                                </label>
                                <p class="text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                                <div wire:loading wire:target="new_logo" class="text-sm text-green-600 mt-2">
                                    Sedang mengunggah...
                                </div>
                                @error('new_logo') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Favicon Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Favicon (Ikon Tab Browser)</label>
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0 p-1">
                                @if ($new_favicon)
                                    <img src="{{ $new_favicon->temporaryUrl() }}" class="max-w-full max-h-full object-contain">
                                @elseif ($favicon)
                                    <img src="{{ asset($favicon) }}" class="max-w-full max-h-full object-contain">
                                @else
                                    <span class="text-gray-400 text-[10px] text-center">Default</span>
                                @endif
                            </div>
                            <div class="flex-grow space-y-2 mt-0.5">
                                <input type="file" wire:model="new_favicon" id="new_favicon" class="hidden" accept="image/png, image/x-icon, image/jpeg, image/svg+xml">
                                <label for="new_favicon" class="inline-block px-3 py-1.5 bg-white border border-gray-300 rounded-md shadow-sm text-xs font-medium text-gray-700 hover:bg-gray-50 cursor-pointer">
                                    Pilih Favicon
                                </label>
                                <p class="text-xs text-gray-500">Format: PNG/ICO/SVG kotak. Max 1MB.</p>
                                <div wire:loading wire:target="new_favicon" class="text-xs text-green-600 mt-1">
                                    Mengunggah...
                                </div>
                                @error('new_favicon') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-8 border-gray-200">
            
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-900 border-l-4 border-primary-500 pl-3">Pengaturan Tautan Media Sosial</h3>
                <p class="text-sm text-gray-500 mt-1 pl-4">Atur tautan media sosial yang akan muncul di bagian bawah website.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tautan Facebook</label>
                    <input type="url" wire:model="facebook_url" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="https://facebook.com/...">
                    @error('facebook_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautan Instagram</label>
                    <input type="url" wire:model="instagram_url" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="https://instagram.com/...">
                    @error('instagram_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautan Twitter/X</label>
                    <input type="url" wire:model="twitter_url" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="https://twitter.com/...">
                    @error('twitter_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautan TikTok</label>
                    <input type="url" wire:model="tiktok_url" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="https://tiktok.com/@...">
                    @error('tiktok_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautan YouTube</label>
                    <input type="url" wire:model="youtube_url" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="https://youtube.com/...">
                    @error('youtube_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautan LinkedIn</label>
                    <input type="url" wire:model="linkedin_url" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 py-3 px-4" placeholder="https://linkedin.com/in/...">
                    @error('linkedin_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-4 border-t border-gray-100 pt-6">
                <button type="button" @click="$dispatch('open-confirm-modal', {
                    title: 'Batalkan Perubahan?',
                    message: 'Semua perubahan yang belum disimpan akan hilang dan formulir akan dikembalikan ke data terakhir.',
                    confirmText: 'Ya, Batal',
                    onConfirm: () => window.location.reload()
                })" class="px-5 py-2 bg-white text-zinc-700 font-semibold rounded-lg shadow-sm border border-zinc-300 hover:bg-zinc-50 hover:text-zinc-900 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Batal
                </button>

                <button type="button" @click="$dispatch('open-confirm-modal', {
                    title: 'Simpan Pengaturan?',
                    message: 'Apakah Anda yakin ingin menyimpan perubahan pada halaman Identitas & Kontak?',
                    confirmText: 'Ya, Simpan',
                    onConfirm: () => $wire.store()
                })" class="px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700 flex items-center gap-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Pengaturan
                </button>
            </div>
            
        </div>
    </div>

    @script
    <script>
        $wire.on('scroll-to-top', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    @endscript
</div>
