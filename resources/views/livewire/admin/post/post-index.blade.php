<div>
    @php
        $pageTitle = 'Manajemen Publikasi';
        $btnText = 'Tulis Baru';
        if ($filterType === 'berita') {
            $pageTitle = 'Manajemen Berita';
            $btnText = 'Tulis Berita';
        } elseif ($filterType === 'artikel') {
            $pageTitle = 'Manajemen Artikel';
            $btnText = 'Tulis Artikel';
        } elseif ($filterType === 'riset') {
            $pageTitle = 'Publikasi Riset';
            $btnText = 'Tambah Riset';
        } elseif ($filterType === 'siaran_pers') {
            $pageTitle = 'Siaran Pers';
            $btnText = 'Tambah Siaran Pers';
        }
    @endphp

    @if(!$isFormOpen)
        <!-- LIST VIEW -->
        <div class="space-y-6" x-data="{ selectionMode: false }">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">{{ $pageTitle }}</h1>
                <div class="flex items-center gap-2">
                    <button @click="selectionMode = !selectionMode; if(!selectionMode) { $wire.cancelBatchDelete() }" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-300 rounded-lg font-semibold text-xs text-zinc-700 uppercase tracking-widest hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition shadow-sm" :class="{'bg-primary-50 border-primary-300 text-primary-700': selectionMode}">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <span x-text="selectionMode ? 'Batal Pilih' : 'Pilih Banyak'"></span>
                    </button>
                    <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        {{ $btnText }}
                    </button>
                </div>
            </div>

            @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <p>{{ session('message') }}</p>
            </div>
            <button @click="show = false" type="button" class="text-green-600 hover:text-green-800 hover:bg-green-200 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
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
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari tulisan..." class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
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
                    <div class="p-4 bg-zinc-50 border-t border-zinc-200 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        @if(empty($filterType))
                        <div>
                            <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Tipe Tulisan</label>
                            <select wire:model.live="filterType" class="w-full bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                                <option value="">Semua Tulisan</option>
                                <option value="berita">Berita</option>
                                <option value="artikel">Artikel</option>
                                <option value="riset">Publikasi Riset</option>
                                <option value="siaran_pers">Siaran Pers</option>
                            </select>
                        </div>
                        @endif

                        <div>
                            <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Status</label>
                            <select wire:model.live="filterStatus" class="w-full bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                                <option value="">Semua Status</option>
                                <option value="published">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>

                        @if($filterType === 'berita')
                        <div>
                            <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Kategori</label>
                            <select wire:model.live="filterCategory" class="w-full bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div>
                            <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Pembuat</label>
                            <x-tom-select wire:model.live="filterAuthor" :multiple="false" placeholder="Semua Pembuat" class="w-full bg-white text-sm border-zinc-300 rounded-lg">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </x-tom-select>
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

                        <div class="sm:col-span-2 lg:col-span-{{ empty($filterType) ? '1' : '2' }}">
                            <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Saring Berdasarkan Tag</label>
                            <x-tom-select wire:model.live="filterTag" :multiple="true" placeholder="Pilih tag..." class="w-full bg-white text-sm border-zinc-300 rounded-lg">
                                @foreach($allTags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </x-tom-select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="overflow-x-auto relative">
                    <div wire:loading.flex wire:target="search, perPage, gotoPage, nextPage, previousPage, filterType, filterStatus, filterCategory, filterAuthor, filterMonth, filterYear, filterTag" class="absolute inset-0 z-20 flex items-center justify-center bg-white/50 backdrop-blur-sm rounded-lg">
                        <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <table wire:loading.class="opacity-50 pointer-events-none" wire:target="search, perPage, gotoPage, nextPage, previousPage, filterType, filterStatus, filterCategory, filterAuthor, filterMonth, filterYear, filterTag" class="w-full text-sm text-left text-zinc-600">
                        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                            <tr>
                                <th scope="col" class="p-4 w-4" x-show="selectionMode" x-transition>
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model.live="selectAll" class="w-4 h-4 text-primary-600 bg-zinc-100 border-zinc-300 rounded focus:ring-primary-500 cursor-pointer">
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium w-16 text-center">No</th>
                                <th scope="col" class="px-6 py-3 font-medium w-16">Cover</th>
                                <th scope="col" class="px-6 py-3 font-medium min-w-[250px]">Judul</th>
                                <th scope="col" class="px-6 py-3 font-medium">Pembuat</th>
                                <th scope="col" class="px-6 py-3 font-medium">Dibuat Pada</th>
                                @if(empty($filterType) || $filterType === 'berita')
                                <th scope="col" class="px-6 py-3 font-medium">Kategori</th>
                                @endif
                                <th scope="col" class="px-6 py-3 font-medium">Tag & Isu</th>
                                <th scope="col" class="px-6 py-3 font-medium">Status</th>
                                <th scope="col" class="px-6 py-3 font-medium text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200">
                            @forelse($posts as $post)
                            <tr class="hover:bg-zinc-50 transition-colors {{ in_array($post->id, $selectedItems) ? 'bg-primary-50/50' : '' }}">
                                <td class="p-4 w-4" x-show="selectionMode" x-transition>
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model.live="selectedItems" value="{{ $post->id }}" class="w-4 h-4 text-primary-600 bg-zinc-100 border-zinc-300 rounded focus:ring-primary-500 cursor-pointer">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-zinc-500">{{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    @if($post->cover_image)
                                        <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-12 h-12 rounded object-cover border border-zinc-200">
                                    @else
                                        <div class="w-12 h-12 rounded bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-zinc-900">{{ $post->title }}</div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-primary-100 text-primary-800 uppercase tracking-wider">
                                            {{ str_replace('_', ' ', $post->type) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-zinc-500 font-medium">
                                    {{ $post->author?->name ?? 'Sistem' }}
                                </td>
                                <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">
                                    {{ $post->created_at ? $post->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                @if(empty($filterType) || $filterType === 'berita')
                                <td class="px-6 py-4 text-zinc-700">
                                    {{ $post->category ? $post->category->name : '-' }}
                                </td>
                                @endif
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($post->issues as $issue)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-purple-100 text-purple-800">
                                                {{ $issue->title }}
                                            </span>
                                        @endforeach
                                        @foreach($post->tags as $tag)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-zinc-100 text-zinc-800 border border-zinc-200">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                        @if($post->issues->isEmpty() && $post->tags->isEmpty())
                                            <span class="text-zinc-400 text-xs">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($post->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Publish</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                    <a href="{{ url('/' . str_replace('_', '-', $post->type) . '/' . $post->slug) }}" target="_blank" class="p-1.5 text-zinc-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Lihat">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    @if(!auth()->user()->hasRole('Mitra Media') || $post->author_id === auth()->id())
                                        <button wire:click="edit({{ $post->id }})" class="p-1.5 text-zinc-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                        <button @click="$dispatch('open-confirm-modal', {
                                                title: 'Konfirmasi Penghapusan',
                                                message: 'Data publikasi akan dihapus secara permanen. File media sisipan teks akan dialihkan ke menu <b>Tempat Sampah</b> dan dibersihkan secara otomatis oleh sistem dalam waktu 1x24 jam. Pembersihan manual juga dapat dilakukan sewaktu-waktu melalui menu tersebut. Lanjutkan proses penghapusan?',
                                                confirmText: 'Ya, Hapus Publikasi',
                                                onConfirm: () => $wire.delete({{ $post->id }})
                                            })" 
                                            class="p-1.5 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                    @endif
                                </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-8 text-center text-zinc-500">Belum ada tulisan yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-zinc-200">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Floating Action Bar for Bulk Actions -->
            @if(count($selectedItems) > 0)
            <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-40 bg-zinc-900 rounded-full shadow-2xl border border-zinc-700 p-2 pl-4 pr-2 flex justify-between items-center transition-all duration-300">
                <div class="text-sm font-medium text-white flex items-center gap-3 mr-6">
                    <span class="bg-primary-500 text-white py-0.5 px-2 rounded-md font-bold">{{ count($selectedItems) }}</span> item
                </div>
                <div class="flex items-center gap-2">
                    <button wire:click="openBulkEditModal" class="inline-flex items-center justify-center p-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 hover:text-white rounded-full transition" title="Edit Label Massal">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </button>
                    <button @click="$dispatch('open-confirm-modal', {
                            title: 'Konfirmasi Penghapusan Massal',
                            message: 'Anda akan menghapus {{ count($selectedItems) }} data publikasi secara permanen beserta file media sisipannya. Lanjutkan?',
                            confirmText: 'Ya, Hapus Semua',
                            onConfirm: () => $wire.bulkDelete()
                        })" 
                        class="inline-flex items-center justify-center p-2 bg-red-600 hover:bg-red-500 text-white rounded-full transition shadow-sm" title="Hapus Terpilih">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                    <div class="h-6 w-px bg-zinc-700 mx-1"></div>
                    <button @click="selectionMode = false; $wire.cancelBatchDelete()" class="inline-flex items-center justify-center p-2 hover:bg-zinc-800 text-zinc-400 hover:text-white rounded-full transition" title="Batal">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
            @endif
        </div>
    @else
        <!-- FORM VIEW -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">{{ $post_id ? 'Edit ' . $pageTitle : $btnText }}</h1>
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
                            <div>
                                <x-label for="title" value="Judul Tulisan" />
                                <x-input id="title" type="text" wire:model.live="title" placeholder="Masukkan judul..." class="text-lg font-medium" />
                                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <x-label for="slug" value="Slug / Tautan Permanen" />
                                <x-input id="slug" type="text" wire:model="slug" class="bg-zinc-50 text-sm text-zinc-500" readonly />
                                @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div wire:ignore>
                                <x-label value="Konten" />
                                <x-rich-text-editor wire:model="content" />
                            </div>
                            @error('content') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan Sidebar Form -->
                    <div class="w-full lg:w-80 space-y-6">
                        <!-- Publish Panel -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Status Publikasi</h3>
                            
                            <div>
                                <select wire:model="is_published" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-zinc-900 transition-colors">
                                    <option value="1">Publish (Tampil)</option>
                                    <option value="0">Draft (Simpan Sementara)</option>
                                </select>
                            </div>

                            <div class="pt-2 border-t border-zinc-100 mt-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-zinc-700">Atur Tanggal Arsip (Manual)</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:model.live="is_manual_archive" class="sr-only peer">
                                        <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                    </label>
                                </div>

                                @if($is_manual_archive)
                                <div class="mt-3">
                                    <input type="datetime-local" wire:model="archive_date" max="{{ now()->format('Y-m-d\TH:i') }}" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-sm text-zinc-900 transition-colors">
                                    @error('archive_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                @endif
                            </div>

                            <div class="pt-2">
                                <x-button target="store" type="submit" class="w-full justify-center">
                                    Simpan Tulisan
                                </x-button>
                                <button type="button" wire:click="savePreview" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-primary-300 rounded-lg font-semibold text-xs text-primary-700 uppercase tracking-widest shadow-sm hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mt-2">
                                    Lihat Live Preview
                                </button>
                            </div>
                        </div>

                        <!-- Klasifikasi Panel -->
                        @if(empty($filterType) || $type === 'berita')
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Klasifikasi</h3>
                            
                            @if(empty($filterType))
                            <div>
                                <x-label for="type" value="Jenis Konten" />
                                <select id="type" wire:model.live="type" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-zinc-900 text-sm transition-colors">
                                    <option value="berita">Berita</option>
                                    <option value="artikel">Artikel</option>
                                    <option value="riset">Publikasi Riset</option>
                                    <option value="siaran_pers">Siaran Pers</option>
                                </select>
                            </div>
                            @endif

                            @if($type === 'berita')
                                <div>
                                    <x-label for="category_id" value="Kategori" />
                                    <select id="category_id" wire:model="category_id" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-zinc-900 text-sm transition-colors">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                        @endif

                        <!-- Kaitan Tag & Isu -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Kaitan</h3>
                            
                            <div>
                                <x-label value="Fokus Isu" class="mb-1" />
                                <x-tom-select wire:model.live="selectedIssues" :multiple="false" placeholder="Pilih Fokus Isu..." class="w-full text-sm">
                                    <option value="">-- Pilih Fokus Isu --</option>
                                    @foreach($allIssues as $issue)
                                        <option value="{{ $issue->id }}">{{ $issue->title }}</option>
                                    @endforeach
                                </x-tom-select>
                                @if($allIssues->isEmpty())
                                    <span class="text-xs text-zinc-400 mt-1 block">Belum ada isu yang aktif.</span>
                                @endif
                            </div>

                            <div>
                                <x-label value="Tag Global" class="mb-1" />
                                <x-tom-select wire:model.live="selectedTags" :multiple="true" placeholder="Cari atau pilih tag..." class="w-full text-sm">
                                    @foreach($allTags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </x-tom-select>
                                @if($allTags->isEmpty())
                                    <span class="text-xs text-zinc-400 mt-1 block">Belum ada tag global.</span>
                                @endif
                            </div>
                        </div>

                        <!-- Gambar Cover -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Cover Image</h3>
                            
                            <div class="mt-1">
                                @if ($new_cover_image || $cover_image)
                                    <div class="relative w-full h-40 mb-3 group">
                                        @if ($new_cover_image)
                                            <img src="{{ $new_cover_image->temporaryUrl() }}" class="w-full h-full object-cover rounded-lg border border-zinc-200">
                                        @else
                                            <img src="{{ asset($cover_image) }}" class="w-full h-full object-cover rounded-lg border border-zinc-200">
                                        @endif
                                        <button type="button" wire:click="removeCoverImage" class="absolute top-2 right-2 p-1.5 bg-red-600 text-white rounded-lg shadow-sm hover:bg-red-700 transition-colors" title="Hapus Gambar">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                @else
                                    <div class="w-full h-40 rounded-lg bg-zinc-50 border-2 border-dashed border-zinc-300 flex items-center justify-center text-zinc-400 mb-3">
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                <input type="file" wire:model="new_cover_image" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-colors" accept="image/*">
                                <div wire:loading wire:target="new_cover_image" class="text-xs text-primary-600 mt-2 font-medium">Mengunggah gambar...</div>
                                @error('new_cover_image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    @endif

    <!-- Bulk Edit Modal -->
    <div x-data="{ show: @entangle('isBulkEditModalOpen') }"
         x-show="show"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-zinc-900/75 backdrop-blur-sm transition-opacity"
                 @click="show = false"
                 aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <form wire:submit.prevent="executeBulkEdit">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-zinc-900" id="modal-title">
                                    Edit Label Massal ({{ count($selectedItems) }} Publikasi)
                                </h3>
                                <div class="mt-4 space-y-4">
                                    @if($filterType === 'berita')
                                    <div>
                                        <x-label value="Kategori (Khusus Berita)" class="mb-1" />
                                        <select wire:model="bulkSelectedCategory" class="bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-zinc-900 text-sm">
                                            <option value="">-- Biarkan Kategori Tetap --</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                    <div wire:ignore class="relative z-20">
                                        <x-label value="Fokus Isu" class="mb-1" />
                                        <x-tom-select wire:model="bulkSelectedIssues" :multiple="false" placeholder="Pilih Fokus Isu..." class="w-full text-sm" :dropdownParent="false">
                                            <option value="">-- Biarkan Fokus Isu Tetap --</option>
                                            @foreach($allIssues as $issue)
                                                <option value="{{ $issue->id }}">{{ $issue->title }}</option>
                                            @endforeach
                                        </x-tom-select>
                                    </div>

                                    <div class="relative z-10 p-4 bg-zinc-50 border border-zinc-200 rounded-xl">
                                        <div wire:ignore>
                                            <x-label value="Tag Global" class="mb-1" />
                                            <x-tom-select wire:model="bulkSelectedTags" :multiple="true" placeholder="Pilih Tag Global..." class="w-full text-sm" :dropdownParent="false">
                                                @foreach($allTags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </x-tom-select>
                                        </div>

                                        <div class="mt-4 pt-4 border-t border-zinc-200">
                                            <p class="text-xs font-semibold text-zinc-700 uppercase tracking-wider mb-2">Metode Pembaruan Tag</p>
                                            <div class="space-y-2">
                                                <label class="flex items-center">
                                                    <input type="radio" wire:model="bulkEditAction" value="append" class="text-primary-600 focus:ring-primary-500 border-zinc-300">
                                                    <span class="ml-2 text-sm text-zinc-700"><strong>Tambahkan:</strong> Gabung dengan tag yang sudah ada</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" wire:model="bulkEditAction" value="replace" class="text-primary-600 focus:ring-primary-500 border-zinc-300">
                                                    <span class="ml-2 text-sm text-zinc-700"><strong>Timpa:</strong> Hapus tag lama dan ganti dengan pilihan ini</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-zinc-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <x-button target="executeBulkEdit" type="submit" class="w-full sm:w-auto justify-center sm:ml-3 rounded-xl sm:text-sm">Simpan Perubahan</x-button>
                        <button type="button" @click="show = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-zinc-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Deletion Progress Modal -->
    <div x-data="{
            isDeleting: @entangle('isDeleting'),
            total: @entangle('deleteTotal'),
            processed: @entangle('deleteProcessed'),
            success: @entangle('deleteSuccess'),
            failed: @entangle('deleteFailed'),
            showModal: false,
            isFinished: false,
            get progressPercentage() {
                if (this.total === 0) return 0;
                return Math.round((this.processed / this.total) * 100);
            }
        }"
        x-show="showModal"
        x-init="$watch('isDeleting', value => { if (value) { showModal = true; isFinished = false; } })"
        @batch-delete-started.window="$wire.processNextChunk()"
        @chunk-processed.window="$wire.processNextChunk()"
        @batch-delete-finished.window="
            isFinished = true;
            selectionMode = false;
        "
        x-cloak
        class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-zinc-900/75 backdrop-blur-sm transition-opacity" @click="if(isFinished) showModal = false"></div>
        <div class="relative bg-white rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl transform transition-all text-center" @click.outside="if(isFinished) showModal = false">
            
            <template x-if="!isFinished">
                <div>
                    <div class="mb-6">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600 mx-auto"></div>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 mb-2">Menghapus Data...</h3>
                    <p class="text-sm text-zinc-500 mb-6">Mohon jangan tutup jendela ini hingga proses selesai.</p>
                    
                    <div class="w-full bg-zinc-100 rounded-full h-3 mb-2 overflow-hidden">
                        <div class="bg-primary-600 h-3 rounded-full transition-all duration-300" :style="`width: ${progressPercentage}%`"></div>
                    </div>
                    <div class="flex justify-between text-xs font-medium text-zinc-500">
                        <span x-text="`${progressPercentage}%`">0%</span>
                        <span x-text="`${processed} dari ${total}`">0 dari 0</span>
                    </div>
                    <div class="mt-6">
                        <button type="button" wire:click="cancelBatchDelete" @click="showModal = false" class="text-sm text-red-600 hover:text-red-800 font-medium px-4 py-2 hover:bg-red-50 rounded-lg transition-colors">
                            Batalkan Sisa Proses
                        </button>
                    </div>
                </div>
            </template>

            <template x-if="isFinished">
                <div>
                    <div class="mb-6">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 mb-2">Proses Selesai</h3>
                    <p class="text-sm text-zinc-600 mb-6">
                        Berhasil menghapus <strong x-text="success" class="text-green-600"></strong> item.
                        <template x-if="failed > 0">
                            <span class="block mt-1"><strong x-text="failed" class="text-red-600"></strong> item gagal dihapus.</span>
                        </template>
                    </p>
                    
                    <div class="mt-6">
                        <button type="button" @click="showModal = false" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:text-sm transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>

        </div>
    </div>

    @script
    <script>
        $wire.on('open-preview-tab', () => {
            window.open('{{ route('admin.preview-live') }}', '_blank');
        });
    </script>
    @endscript
</div>
