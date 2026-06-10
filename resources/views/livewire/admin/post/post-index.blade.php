<div>
    @if(!$isFormOpen)
        <!-- LIST VIEW -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">Manajemen Publikasi</h1>
                <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tulis Baru
                </button>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('message') }}</p>
                </div>
            @endif

            <!-- Filter -->
            <div class="flex items-center space-x-4 bg-white p-4 rounded-xl shadow-sm border border-zinc-200">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-zinc-700">Filter Tipe:</span>
                    <select wire:model.live="filterType" class="text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-1.5 pl-3 pr-8 text-zinc-900">
                        <option value="">Semua Tulisan</option>
                        <option value="berita">Berita</option>
                        <option value="artikel">Artikel</option>
                        <option value="riset">Publikasi Riset</option>
                        <option value="siaran_pers">Siaran Pers</option>
                    </select>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-zinc-600">
                        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium w-16">Cover</th>
                                <th scope="col" class="px-6 py-3 font-medium min-w-[250px]">Judul</th>
                                <th scope="col" class="px-6 py-3 font-medium">Kategori</th>
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
                                        <span class="text-xs text-zinc-500">{{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-zinc-700">
                                    {{ $post->category ? $post->category->name : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($post->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Publish</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <button wire:click="edit({{ $post->id }})" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                    <button wire:click="delete({{ $post->id }})" onclick="confirm('Apakah Anda yakin ingin menghapus tulisan ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-zinc-500">Belum ada tulisan yang ditambahkan.</td>
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
                <h1 class="text-2xl font-bold text-zinc-900">{{ $post_id ? 'Edit Tulisan' : 'Tulis Baru' }}</h1>
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
                                <select wire:model="is_published" class="border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-zinc-900">
                                    <option value="1">Publish (Tampil)</option>
                                    <option value="0">Draft (Simpan Sementara)</option>
                                </select>
                            </div>

                            <div class="pt-2">
                                <x-button type="submit" class="w-full justify-center">
                                    Simpan Tulisan
                                </x-button>
                            </div>
                        </div>

                        <!-- Klasifikasi Panel -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Klasifikasi</h3>
                            
                            <div>
                                <x-label for="type" value="Jenis Konten" />
                                <select id="type" wire:model.live="type" class="border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-zinc-900 text-sm">
                                    <option value="berita">Berita</option>
                                    <option value="artikel">Artikel</option>
                                    <option value="riset">Publikasi Riset</option>
                                    <option value="siaran_pers">Siaran Pers</option>
                                </select>
                            </div>

                            @if($type !== 'siaran_pers' && $type !== 'acara')
                                <div>
                                    <x-label for="category_id" value="Kategori" />
                                    <select id="category_id" wire:model="category_id" class="border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2 px-3 text-zinc-900 text-sm">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>

                        <!-- Kaitan Tag & Isu -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Kaitan</h3>
                            
                            <div>
                                <x-label value="Fokus Isu" />
                                <div class="max-h-32 overflow-y-auto space-y-2 border border-zinc-200 rounded p-2 bg-zinc-50">
                                    @foreach($allIssues as $issue)
                                        <label class="flex items-center text-sm text-zinc-700 hover:bg-zinc-100 p-1 rounded cursor-pointer transition-colors">
                                            <input type="checkbox" wire:model="selectedIssues" value="{{ $issue->id }}" class="rounded border-zinc-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                                            {{ $issue->title }}
                                        </label>
                                    @endforeach
                                    @if($allIssues->isEmpty())
                                        <span class="text-xs text-zinc-400">Belum ada isu yang aktif.</span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <x-label value="Tag Global" />
                                <div class="max-h-40 overflow-y-auto space-y-2 border border-zinc-200 rounded p-2 bg-zinc-50">
                                    @foreach($allTags as $tag)
                                        <label class="flex items-center text-sm text-zinc-700 hover:bg-zinc-100 p-1 rounded cursor-pointer transition-colors">
                                            <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}" class="rounded border-zinc-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                                            {{ $tag->name }}
                                        </label>
                                    @endforeach
                                    @if($allTags->isEmpty())
                                        <span class="text-xs text-zinc-400">Belum ada tag global.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Cover -->
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-zinc-200 space-y-4">
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Cover Image</h3>
                            
                            <div class="mt-1">
                                @if ($new_cover_image)
                                    <img src="{{ $new_cover_image->temporaryUrl() }}" class="w-full h-40 object-cover rounded-lg border border-zinc-200 mb-3">
                                @elseif ($cover_image)
                                    <img src="{{ asset($cover_image) }}" class="w-full h-40 object-cover rounded-lg border border-zinc-200 mb-3">
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
</div>
