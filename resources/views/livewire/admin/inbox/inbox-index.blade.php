<div x-data="{ selectionMode: false }">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Laporan & Aduan</h1>
                <p class="text-gray-600 text-sm">Pesan masuk dari pengunjung website.</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="selectionMode = !selectionMode; if(!selectionMode) { $wire.cancelBatchDelete() }" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition shadow-sm" :class="{'bg-green-50 border-green-300 text-green-700': selectionMode}">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <span x-text="selectionMode ? 'Batal Pilih' : 'Pilih Banyak'"></span>
                </button>
            </div>
        </div>

        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-2">
                <p>{{ session('message') }}</p>
            </div>
            <button @click="show = false" type="button" class="text-green-600 hover:text-green-800 hover:bg-green-200 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

        <!-- Top Action Bar (Search & Filters) -->
        <div x-data="{ showFilters: false }" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4">
                
                <!-- Left: Search -->
                <div class="w-full sm:max-w-xs relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pesan..." class="bg-gray-100 focus:bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm block w-full pl-9 py-3 transition-colors">
                </div>

                <!-- Right: Per Page & Toggle Filter -->
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-600 hidden sm:inline">Tampil:</span>
                        <select wire:model.live="perPage" class="bg-gray-100 focus:bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-3 pl-3 pr-8 text-gray-900 transition-colors">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    
                    <button @click="showFilters = !showFilters" type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors shadow-sm gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter Lanjutan
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': showFilters}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Expanded Filters Drawer -->
            <div x-show="showFilters" x-collapse>
                <div class="p-4 bg-gray-50 border-t border-gray-200 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Bulan</label>
                        <select wire:model.live="filterMonth" class="w-full bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-3 px-4 text-gray-900">
                            <option value="">Semua Bulan</option>
                            @php
                                $bulanIndo = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                                    4 => 'April', 5 => 'Mei', 6 => 'Juni',
                                    7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                                    10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                            @endphp
                            @foreach($bulanIndo as $num => $name)
                                <option value="{{ $num }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Tahun</label>
                        <select wire:model.live="filterYear" class="w-full bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-3 px-4 text-gray-900">
                            <option value="">Semua Tahun</option>
                            @foreach($availableYears ?? [date('Y')] as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Status Progres</label>
                        <select wire:model.live="filterStatus" class="w-full bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-3 px-4 text-gray-900">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="ditolak">Ditolak / Spam</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto relative">
                    <div wire:loading.flex wire:target="search, perPage, gotoPage, nextPage, previousPage, filterType, filterStatus, filterCategory, filterAuthor, filterMonth, filterYear, filterTag" class="absolute inset-0 z-20 flex items-center justify-center bg-white/50 backdrop-blur-sm rounded-lg">
                        <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <table wire:loading.class="opacity-50 pointer-events-none" wire:target="search, perPage, gotoPage, nextPage, previousPage, filterType, filterStatus, filterCategory, filterAuthor, filterMonth, filterYear, filterTag" class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="p-4 w-4" x-show="selectionMode" x-transition>
                                <div class="flex items-center">
                                    <input type="checkbox" wire:model.live="selectAll" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                                </div>
                            </th>
                                <th scope="col" class="px-6 py-3 font-medium w-16 text-center">No</th>
                            <th scope="col" class="px-6 py-4 font-medium">Tanggal</th>
                            <th scope="col" class="px-6 py-4 font-medium">Pengirim</th>
                            <th scope="col" class="px-6 py-4 font-medium">Subjek</th>
                            <th scope="col" class="px-6 py-4 font-medium text-center">Status</th>
                            <th scope="col" class="px-6 py-4 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($this->inboxMessages as $message)
                            <tr wire:key="msg-{{ $message->id }}" class="hover:bg-gray-50 transition-colors {{ in_array((string)$message->id, $selectedItems) ? 'bg-green-50/50' : (!$message->is_read ? 'bg-green-50/30' : '') }}">
                                <td class="p-4 w-4" x-show="selectionMode" x-transition>
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model.live="selectedItems" value="{{ $message->id }}" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-zinc-500">{{ ($this->inboxMessages->currentPage() - 1) * $this->inboxMessages->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap {{ !$message->is_read ? 'font-semibold text-gray-900' : 'text-gray-500' }}">
                                    {{ $message->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="{{ !$message->is_read ? 'font-semibold text-gray-900' : 'font-medium text-gray-800' }}">{{ $message->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $message->email }}</div>
                                </td>
                                <td class="px-6 py-4 {{ !$message->is_read ? 'font-semibold text-gray-900' : '' }}">
                                    {{ $message->subject ?: '(Tanpa Subjek)' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($message->status === 'menunggu')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif($message->status === 'diproses')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Diproses
                                        </span>
                                    @elseif($message->status === 'selesai')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                    <button wire:click="viewMessage({{ $message->id }})" class="p-1.5 text-zinc-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button type="button" @click="$dispatch('open-confirm-modal', { title: 'Konfirmasi Tindakan', message: 'Yakin ingin menghapus pesan ini?', confirmText: 'Ya, Lanjutkan', onConfirm: () => @this.deleteMessage({{ $message->id }}) })" class="p-1.5 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr wire:key="empty-row">
                                <td colspan="10" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada pesan yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $this->inboxMessages->links() }}
            </div>
        </div>

        <!-- Floating Action Bar for Bulk Actions -->
        @if(count($selectedItems) > 0)
        <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-40 bg-gray-900 rounded-full shadow-2xl border border-gray-700 p-2 pl-4 pr-2 flex justify-between items-center transition-all duration-300">
            <div class="text-sm font-medium text-white flex items-center gap-3 mr-6">
                <span class="bg-green-500 text-white py-0.5 px-2 rounded-md font-bold">{{ count($selectedItems) }}</span> item
            </div>
            <div class="flex items-center gap-2">
                <button wire:click="openBulkEditModal" class="inline-flex items-center justify-center p-2 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white rounded-full transition" title="Edit Status Massal">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <button @click="$dispatch('open-confirm-modal', {
                        title: 'Konfirmasi Hapus',
                        message: 'Hapus {{ count($selectedItems) }} laporan/aduan terpilih? Data tidak dapat dikembalikan.',
                        confirmText: 'Hapus',
                        onConfirm: () => $wire.bulkDelete()
                    })" 
                    wire:loading.attr="disabled" class="inline-flex items-center justify-center p-2 bg-red-600 hover:bg-red-500 text-white rounded-full transition shadow-sm disabled:opacity-50" title="Hapus Terpilih">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                <div class="h-6 w-px bg-gray-700 mx-1"></div>
                <button @click="selectionMode = false; $wire.cancelBatchDelete()" class="inline-flex items-center justify-center p-2 hover:bg-gray-800 text-gray-400 hover:text-white rounded-full transition" title="Batal">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        @endif
    </div>

    <!-- Modal Detail Pesan -->
    @if($isModalOpen && $selectedMessage)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" wire:click="closeModal"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal Panel -->
            <div class="relative z-10 w-full transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:max-w-2xl">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl leading-6 font-semibold text-gray-900" id="modal-title">
                                {{ $selectedMessage->subject ?: '(Tanpa Subjek)' }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Dikirim pada: {{ $selectedMessage->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200">
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div class="col-span-1 text-gray-500 font-medium">Pengirim</div>
                            <div class="col-span-2 font-semibold text-gray-900">{{ $selectedMessage->name }}</div>
                            
                            <div class="col-span-1 text-gray-500 font-medium">Email</div>
                            <div class="col-span-2 text-gray-900">
                                <a href="mailto:{{ $selectedMessage->email }}" class="text-blue-600 hover:underline">{{ $selectedMessage->email }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Isi Pesan:</h4>
                        <div class="text-gray-800 bg-white border border-gray-200 rounded-lg p-4 min-h-[150px] whitespace-pre-wrap">{{ $selectedMessage->message }}</div>
                    </div>
                    
                    <!-- Admin Progress Section -->
                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <h4 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            Tindak Lanjut Admin
                        </h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="sm:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Progres</label>
                                <select wire:model="progressStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                                    <option value="menunggu">⏳ Menunggu</option>
                                    <option value="diproses">⚙️ Diproses</option>
                                    <option value="selesai">✅ Selesai</option>
                                    <option value="ditolak">❌ Ditolak / Spam</option>
                                </select>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Internal (Opsional)</label>
                                <textarea wire:model="adminNotes" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3" placeholder="Tambahkan catatan untuk admin lain..."></textarea>
                            </div>
                        </div>

                        <div class="mt-3 flex justify-end">
                            <button wire:click="saveProgress" type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 gap-2">
                                <span wire:loading.remove wire:target="saveProgress">Simpan Progres</span>
                                <span wire:loading wire:target="saveProgress">Menyimpan...</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
                    <button wire:click="closeModal" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                    <a href="mailto:{{ $selectedMessage->email }}?subject=Balasan: {{ $selectedMessage->subject }}" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Balas via Email
                    </a>
                    <button type="button" @click="$dispatch('open-confirm-modal', { title: 'Konfirmasi Tindakan', message: 'Yakin ingin menghapus pesan ini?', confirmText: 'Ya, Lanjutkan', onConfirm: () => @this.deleteMessage({{ $selectedMessage->id }}) })" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:mt-0 sm:w-auto sm:text-sm">
                        Hapus Pesan
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Bulk Edit Modal -->
    <div x-data="{ show: @entangle('isBulkEditModalOpen') }"
         x-show="show"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"
                 @click="show = false"
                 aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

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
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                    Edit Status Massal (<span x-text="$wire.selectedItems.length"></span> Laporan)
                                </h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Progres Baru</label>
                                        <select wire:model="bulkSelectedStatus" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="menunggu">⏳ Menunggu</option>
                                            <option value="diproses">⚙️ Diproses</option>
                                            <option value="selesai">✅ Selesai</option>
                                            <option value="ditolak">❌ Ditolak / Spam</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Simpan Perubahan
                        </button>
                        <button type="button" @click="show = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
