<div>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Galeri Kegiatan</h1>
                <p class="text-gray-600 text-sm mt-1">Kelola galeri foto dan video kegiatan.</p>
            </div>
            
            <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Galeri
            </a>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div class="relative w-full max-w-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out" placeholder="Cari judul galeri...">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium w-16">Thumbnail</th>
                            <th scope="col" class="px-6 py-4 font-medium">Judul Galeri</th>
                            <th scope="col" class="px-6 py-4 font-medium">Tanggal</th>
                            <th scope="col" class="px-6 py-4 font-medium">Jumlah Foto</th>
                            <th scope="col" class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($galleries as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-16 h-12 rounded bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                        @if($item->thumbnail)
                                            <img src="{{ asset($item->thumbnail) }}" class="w-full h-full object-cover">
                                        @elseif($item->images->count() > 0)
                                            <img src="{{ asset($item->images->first()->image_path) }}" class="w-full h-full object-cover">
                                        @elseif($item->video_url)
                                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $item->title }}</div>
                                    @if($item->video_url)
                                    <div class="text-xs text-blue-600 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                        Ada Video
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $item->images->count() }} Foto
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.gallery.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mx-2">
                                        Edit
                                    </a>
                                    <button wire:click="delete({{ $item->id }})" onclick="confirm('Yakin ingin menghapus galeri beserta semua fotonya?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data galeri kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($galleries->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $galleries->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
