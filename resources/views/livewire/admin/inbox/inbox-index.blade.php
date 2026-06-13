<div>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Laporan & Aduan</h1>
            <p class="text-gray-600 text-sm">Pesan masuk dari pengunjung website.</p>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <!-- Top Action Bar (Search & Filters) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4">
                
                <!-- Left: Search -->
                <div class="w-full sm:max-w-xs relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pesan..." class="bg-gray-100 focus:bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
                </div>

                <!-- Right: Per Page -->
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-600 hidden sm:inline">Tampil:</span>
                        <select wire:model.live="perPage" class="bg-gray-100 focus:bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-2 pl-3 pr-8 text-gray-900 transition-colors">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">Tanggal</th>
                            <th scope="col" class="px-6 py-4 font-medium">Pengirim</th>
                            <th scope="col" class="px-6 py-4 font-medium">Subjek</th>
                            <th scope="col" class="px-6 py-4 font-medium text-center">Status</th>
                            <th scope="col" class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($messages as $message)
                            <tr class="hover:bg-gray-50 transition-colors {{ !$message->is_read ? 'bg-green-50/30' : '' }}">
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
                                    @if(!$message->is_read)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Baru
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            Dibaca
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="viewMessage({{ $message->id }})" class="text-blue-600 hover:text-blue-900 mx-2">
                                        Lihat Detail
                                    </button>
                                    <button wire:click="deleteMessage({{ $message->id }})" onclick="confirm('Yakin ingin menghapus pesan ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada pesan yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $messages->links() }}
            </div>
        </div>
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
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
                    <button wire:click="closeModal" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                    <a href="mailto:{{ $selectedMessage->email }}?subject=Balasan: {{ $selectedMessage->subject }}" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Balas via Email
                    </a>
                    <button wire:click="deleteMessage({{ $selectedMessage->id }})" onclick="confirm('Yakin ingin menghapus pesan ini?') || event.stopImmediatePropagation()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:mt-0 sm:w-auto sm:text-sm">
                        Hapus Pesan
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
