<div>
    @if(!$isFormOpen)
        <!-- LIST VIEW -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">Manajemen Agenda Acara</h1>
                <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Acara Baru
                </button>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('message') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-zinc-600">
                        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium w-16">Cover</th>
                                <th scope="col" class="px-6 py-3 font-medium min-w-[250px]">Detail Acara</th>
                                <th scope="col" class="px-6 py-3 font-medium">Jadwal</th>
                                <th scope="col" class="px-6 py-3 font-medium">Status</th>
                                <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200">
                            @forelse($events as $event)
                            <tr class="hover:bg-zinc-50 transition-colors">
                                <td class="px-6 py-4">
                                    @if($event->cover_image)
                                        <img src="{{ asset($event->cover_image) }}" alt="{{ $event->title }}" class="w-12 h-12 rounded object-cover border border-zinc-200">
                                    @else
                                        <div class="w-12 h-12 rounded bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-zinc-900">{{ $event->title }}</div>
                                    <div class="flex items-center gap-1 mt-1 text-xs text-zinc-500">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $event->location }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-zinc-700">{{ $event->event_date->format('d M Y') }}</div>
                                    <div class="text-xs text-zinc-500 mt-1">{{ $event->event_date->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($event->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Publish</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <button wire:click="edit({{ $event->id }})" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                    <button wire:click="delete({{ $event->id }})" onclick="confirm('Apakah Anda yakin ingin menghapus acara ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-zinc-500">Belum ada agenda acara yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-zinc-200">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    @else
        <!-- FORM VIEW -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-900">{{ $event_id ? 'Edit Agenda Acara' : 'Tambah Agenda Acara Baru' }}</h1>
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
                                <x-label for="title" value="Nama Acara" />
                                <x-input id="title" type="text" wire:model.live="title" placeholder="Misal: Sosialisasi Penggunaan Dana Desa" class="text-lg font-medium" />
                                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <x-label for="slug" value="Slug / Tautan Permanen" />
                                <x-input id="slug" type="text" wire:model="slug" class="bg-zinc-50 text-sm text-zinc-500" readonly />
                                @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="event_date" value="Jadwal Acara" />
                                    <x-input id="event_date" type="datetime-local" wire:model="event_date" />
                                    @error('event_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <x-label for="location" value="Lokasi Acara" />
                                    <x-input id="location" type="text" wire:model="location" placeholder="Misal: Balai Desa Mekar Jaya" />
                                    @error('location') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div wire:ignore>
                                <x-label value="Deskripsi Acara" />
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
                                    Simpan Acara
                                </x-button>
                            </div>
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
                            <h3 class="font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Poster / Cover Acara</h3>
                            
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
