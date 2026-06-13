<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-zinc-900">Manajemen Fokus Isu</h1>
        <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Isu
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
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari isu..." class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
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
                        <option value="inactive">Nonaktif</option>
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
                        <th scope="col" class="px-6 py-3 font-medium w-16">Cover</th>
                        <th scope="col" class="px-6 py-3 font-medium">Judul Isu</th>
                        <th scope="col" class="px-6 py-3 font-medium">Dibuat Pada</th>
                        <th scope="col" class="px-6 py-3 font-medium">Status</th>
                        <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($issues as $issue)
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4">
                            @if($issue->cover_image)
                                <img src="{{ asset($issue->cover_image) }}" alt="{{ $issue->title }}" class="w-12 h-12 rounded object-cover border border-zinc-200">
                            @else
                                <div class="w-12 h-12 rounded bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-zinc-900">{{ $issue->title }}</div>
                            <div class="text-xs text-zinc-500 mt-1">{{ $issue->slug }}</div>
                        </td>
                        <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">
                            {{ $issue->created_at ? $issue->created_at->format('d M Y, H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($issue->status === 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ url('/isu/' . $issue->slug) }}" target="_blank" class="text-primary-600 hover:text-primary-900 font-medium mr-2">Lihat</a>
                            <button wire:click="edit({{ $issue->id }})" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                            <button wire:click="delete({{ $issue->id }})" onclick="confirm('Apakah Anda yakin ingin menghapus isu ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-zinc-500">Belum ada isu kampanye yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-zinc-200">
            {{ $issues->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="relative inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full z-50">
                <form wire:submit.prevent="store">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4 border-b border-zinc-100 pb-4">
                            <h3 class="text-lg leading-6 font-semibold text-zinc-900" id="modal-title">
                                {{ $issue_id ? 'Edit Isu Kampanye' : 'Tambah Isu Kampanye Baru' }}
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-4 md:col-span-2">
                                <div>
                                    <x-label for="title" value="Judul Isu" />
                                    <x-input id="title" type="text" wire:model.live="title" placeholder="Misal: Transparansi Anggaran Desa" />
                                    @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <x-label for="slug" value="Slug (Otomatis)" />
                                    <x-input id="slug" type="text" wire:model="slug" class="bg-zinc-100" readonly />
                                    @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <x-label for="status" value="Status Tampilan" />
                                    <select id="status" wire:model="status" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2.5 px-3 text-zinc-900 transition-colors">
                                        <option value="active">Aktif (Tampil di Web)</option>
                                        <option value="inactive">Nonaktif (Sembunyikan)</option>
                                    </select>
                                    @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <x-label value="Cover Image" />
                                    
                                    <div class="mt-1 flex items-center gap-4">
                                        @if ($new_cover_image)
                                            <img src="{{ $new_cover_image->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-lg border border-zinc-200">
                                        @elseif ($cover_image)
                                            <img src="{{ asset($cover_image) }}" class="w-16 h-16 object-cover rounded-lg border border-zinc-200">
                                        @else
                                            <div class="w-16 h-16 rounded-lg bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1">
                                            <input type="file" wire:model="new_cover_image" id="cover_image" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-colors" accept="image/*">
                                            <div wire:loading wire:target="new_cover_image" class="text-xs text-primary-600 mt-1 font-medium">Mengunggah...</div>
                                        </div>
                                    </div>
                                    @error('new_cover_image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-4 md:col-span-2">
                                <div>
                                    <x-label for="description" value="Deskripsi Singkat" />
                                    <textarea id="description" wire:model="description" rows="3" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2.5 px-3 text-zinc-900 transition-colors" placeholder="Jelaskan secara singkat mengenai isu ini..."></textarea>
                                    @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <x-label for="icon_svg" value="Icon SVG (Opsional, untuk desain spesifik)" />
                                    <textarea id="icon_svg" wire:model="icon_svg" rows="2" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2.5 px-3 text-zinc-900 font-mono text-sm transition-colors" placeholder="<svg>...</svg>"></textarea>
                                    <p class="text-xs text-zinc-500 mt-1">Anda bisa menempelkan kode SVG dari Heroicons atau ikon lainnya.</p>
                                    @error('icon_svg') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-zinc-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-zinc-200">
                        <x-button type="submit" class="w-full sm:ml-3 sm:w-auto">
                            Simpan
                        </x-button>
                        <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-lg border border-zinc-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
