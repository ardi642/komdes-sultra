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
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">{{ $pageTitle }}</h1>
                <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ $btnText }}
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
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-zinc-600">
                        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium w-16">Cover</th>
                                <th scope="col" class="px-6 py-3 font-medium min-w-[250px]">Judul</th>
                                <th scope="col" class="px-6 py-3 font-medium">Dibuat Pada</th>
                                @if($filterType === 'berita')
                                <th scope="col" class="px-6 py-3 font-medium">Kategori</th>
                                @endif
                                <th scope="col" class="px-6 py-3 font-medium">Status</th>
                                <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200">
                            @forelse($posts as $post)
                            <tr class="hover:bg-zinc-50 transition-colors">
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
                                <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">
                                    {{ $post->created_at ? $post->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                @if($filterType === 'berita')
                                <td class="px-6 py-4 text-zinc-700">
                                    {{ $post->category ? $post->category->name : '-' }}
                                </td>
                                @endif
                                <td class="px-6 py-4">
                                    @if($post->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Publish</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ url('/' . str_replace('_', '-', $post->type) . '/' . $post->slug) }}" target="_blank" class="text-primary-600 hover:text-primary-900 font-medium mr-2">Lihat</a>
                                    <button wire:click="edit({{ $post->id }})" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                    <button wire:click="delete({{ $post->id }})" onclick="confirm('Apakah Anda yakin ingin menghapus tulisan ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ $filterType === 'berita' ? '5' : '4' }}" class="px-6 py-8 text-center text-zinc-500">Belum ada tulisan yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-zinc-200">
                    {{ $posts->links() }}
                </div>
            </div>
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
                                <x-quill-editor wire:model="content" />
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

                            <div class="pt-2">
                                <x-button type="submit" class="w-full justify-center">
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
                                <x-tom-select wire:model.live="selectedIssues" :multiple="true" placeholder="Pilih Fokus Isu..." class="w-full text-sm">
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

    @script
    <script>
        $wire.on('open-preview-tab', () => {
            window.open('{{ route('preview-live') }}', '_blank');
        });
    </script>
    @endscript
</div>
