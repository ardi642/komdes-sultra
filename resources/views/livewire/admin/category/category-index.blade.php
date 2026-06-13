<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-zinc-900">Manajemen Kategori</h1>
        <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kategori
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <!-- Top Action Bar (Search & Filters) -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4">
            <!-- Left: Search -->
            <div class="w-full sm:max-w-xs relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kategori..." class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
            </div>

            <!-- Right: Per Page -->
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
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-zinc-600">
                <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Nama Kategori</th>
                        <th scope="col" class="px-6 py-3 font-medium">Slug</th>
                        <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($categories as $category)
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-zinc-900">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-zinc-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="edit({{ $category->id }})" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                            <button wire:click="delete({{ $category->id }})" onclick="confirm('Apakah Anda yakin ingin menghapus kategori ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-zinc-500">Belum ada kategori yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-zinc-200">
            {{ $categories->links() }}
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
            <div class="relative inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full z-50">
                <form wire:submit.prevent="store">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <h3 class="text-lg leading-6 font-medium text-zinc-900" id="modal-title">
                                {{ $category_id ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                            </h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <x-label for="name" value="Nama Kategori" />
                                <x-input id="name" type="text" wire:model.live="name" placeholder="Misal: Pembangunan Desa" />
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <x-label for="slug" value="Slug (Otomatis)" />
                                <x-input id="slug" type="text" wire:model="slug" class="bg-zinc-100" readonly />
                                @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
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
