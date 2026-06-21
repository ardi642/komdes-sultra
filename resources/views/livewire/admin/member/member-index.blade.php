<div>
    @if(!$isFormOpen)
        <!-- LIST VIEW -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">Manajemen Anggota</h1>
                <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Anggota
                </button>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('message') }}</p>
                </div>
            @endif

            <!-- Top Action Bar (Search & Filters) -->
            <div x-data="{ showFilters: false }" class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
                
                <!-- Main Bar: Search, Per Page, Toggle -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4">
                    
                    <!-- Left: Search -->
                    <div class="w-full sm:max-w-xs relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari anggota..." class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
                    </div>

                    <!-- Right: Per Page & Filter Toggle -->
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-zinc-600 hidden sm:inline">Tampil:</span>
                            <select wire:model.live="perPage" class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 pl-3 pr-8 text-zinc-900 transition-colors">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        
                        <button @click="showFilters = !showFilters" type="button" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-300 rounded-lg font-medium text-sm text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors shadow-sm gap-2">
                            <svg class="w-4 h-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter Lanjutan
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': showFilters}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Expanded Filters Drawer -->
                <div x-show="showFilters" x-collapse>
                    <div class="p-4 bg-zinc-50 border-t border-zinc-200 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Status</label>
                            <select wire:model.live="filterStatus" class="w-full bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                                <option value="">Semua Status</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Waktu (Bulan / Tahun)</label>
                            <div class="flex gap-2">
                                <select wire:model.live="filterMonth" class="w-1/2 bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                                    <option value="">Bulan</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                    @endfor
                                </select>
                                <select wire:model.live="filterYear" class="w-1/2 bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                                    <option value="">Tahun</option>
                                    @for($i=date('Y'); $i>=2020; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-zinc-600">
                        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                            <tr>
                                <th scope="col" class="p-4 w-16 text-center">Geser</th>
                                <th scope="col" class="px-6 py-3 font-medium w-16 text-center">Urutan</th>
                                <th scope="col" class="px-6 py-3 font-medium w-16">Logo</th>
                                <th scope="col" class="px-6 py-3 font-medium min-w-[200px]">Nama Anggota</th>
                                <th scope="col" class="px-6 py-3 font-medium">Dibuat Pada</th>
                                <th scope="col" class="px-6 py-3 font-medium">Status</th>
                                <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200"
                            x-data="{
                                init() {
                                    Sortable.create(this.$el, {
                                        handle: '.drag-handle',
                                        animation: 150,
                                        ghostClass: 'bg-primary-50',
                                        onEnd: (evt) => {
                                            let order = [];
                                            this.$el.querySelectorAll('tr[data-id]').forEach((el) => {
                                                order.push(el.dataset.id);
                                            });
                                            $wire.updateOrder(order);
                                        }
                                    });
                                }
                            }"
                        >
                            @forelse($members as $member)
                            <tr class="hover:bg-zinc-50 transition-colors bg-white" data-id="{{ $member->id }}" wire:key="member-{{ $member->id }}">
                                <td class="p-4 text-center">
                                    <button type="button" class="drag-handle cursor-grab active:cursor-grabbing p-2 bg-zinc-100 text-zinc-500 rounded-lg border border-zinc-200 hover:bg-zinc-200 hover:text-primary-700 transition-colors shadow-sm" title="Geser untuk mengubah urutan">
                                        <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <circle cx="9" cy="5" r="1.5"/>
                                            <circle cx="15" cy="5" r="1.5"/>
                                            <circle cx="9" cy="12" r="1.5"/>
                                            <circle cx="15" cy="12" r="1.5"/>
                                            <circle cx="9" cy="19" r="1.5"/>
                                            <circle cx="15" cy="19" r="1.5"/>
                                        </svg>
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-zinc-100 bg-zinc-600 rounded-full">{{ $member->order_number }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($member->logo)
                                        <img src="{{ asset($member->logo) }}" alt="{{ $member->name }}" class="w-12 h-12 rounded object-contain bg-white border border-zinc-200 p-1">
                                    @else
                                        <div class="w-12 h-12 rounded bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-zinc-900">{{ $member->name }}</div>
                                    <div class="text-xs text-zinc-500 mt-1 line-clamp-1">{{ $member->email ?? '-' }} | {{ $member->phone ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">
                                    {{ $member->created_at ? $member->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($member->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <button wire:click="edit({{ $member->id }})" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                    <button wire:click="delete({{ $member->id }})" onclick="confirm('Apakah Anda yakin ingin menghapus anggota ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-zinc-500">Belum ada data anggota.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-zinc-200">
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    @else
        <!-- FORM VIEW -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">{{ $member_id ? 'Edit Anggota' : 'Tambah Anggota Baru' }}</h1>
                <button wire:click="closeForm" class="text-zinc-500 hover:text-zinc-700 font-medium flex items-center gap-1">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </button>
            </div>

            <form wire:submit.prevent="store">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Kolom Kiri Utama -->
                    <div class="flex-1 space-y-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Informasi Umum</h3>
                            
                            <div>
                                <x-label for="name" value="Nama Lembaga/Anggota" />
                                <x-input id="name" type="text" wire:model="name" placeholder="Contoh: WALHI Sulsel" class="w-full mt-1" />
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-label for="description" value="Deskripsi Singkat (Muncul di Pop-up)" />
                                <textarea id="description" wire:model="description" rows="4" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full mt-1 px-3 py-2 text-zinc-900 transition-colors"></textarea>
                                @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-label for="address" value="Alamat Lengkap" />
                                <textarea id="address" wire:model="address" rows="3" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full mt-1 px-3 py-2 text-zinc-900 transition-colors"></textarea>
                                @error('address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Kontak & Media Sosial</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="email" value="Email" />
                                    <x-input id="email" type="email" wire:model="email" placeholder="email@contoh.com" class="w-full mt-1" />
                                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <x-label for="phone" value="No. Telepon / WhatsApp" />
                                    <x-input id="phone" type="text" wire:model="phone" placeholder="Contoh: 08123456789" class="w-full mt-1" />
                                    @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <x-label for="website" value="Link Website" />
                                    <x-input id="website" type="text" wire:model="website" placeholder="https://..." class="w-full mt-1" />
                                    @error('website') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <x-label for="instagram" value="Link Instagram" />
                                    <x-input id="instagram" type="text" wire:model="instagram" placeholder="https://instagram.com/..." class="w-full mt-1" />
                                    @error('instagram') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan Sidebar Form -->
                    <div class="w-full lg:w-80 space-y-6">
                        <!-- Publish Panel -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Pengaturan</h3>
                            
                            <div>
                                <x-label for="is_active" value="Status Tampil" />
                                <select id="is_active" wire:model="is_active" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full mt-1 py-2 px-3 text-zinc-900 transition-colors">
                                    <option value="1">Aktif (Tampil)</option>
                                    <option value="0">Tidak Aktif (Sembunyikan)</option>
                                </select>
                            </div>

                            <div class="pt-2">
                                <x-button type="submit" class="w-full justify-center">
                                    Simpan Data
                                </x-button>
                            </div>
                        </div>

                        <!-- Gambar Cover -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Logo Lembaga</h3>
                            
                            <div class="mt-1">
                                @if ($new_logo)
                                    <img src="{{ $new_logo->temporaryUrl() }}" class="w-full h-40 object-contain p-2 rounded-lg border border-zinc-200 bg-zinc-50 mb-3">
                                @elseif ($logo)
                                    <img src="{{ asset($logo) }}" class="w-full h-40 object-contain p-2 rounded-lg border border-zinc-200 bg-zinc-50 mb-3">
                                @else
                                    <div class="w-full h-40 rounded-lg bg-zinc-50 border-2 border-dashed border-zinc-300 flex items-center justify-center text-zinc-400 mb-3">
                                        <span class="text-sm">Tidak ada logo</span>
                                    </div>
                                @endif
                                
                                <input type="file" wire:model="new_logo" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-colors" accept="image/*">
                                <div wire:loading wire:target="new_logo" class="text-xs text-primary-600 mt-2 font-medium">Mengunggah logo...</div>
                                @error('new_logo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    @endif
</div>
