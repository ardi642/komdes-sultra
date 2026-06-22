<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-zinc-900">Slider Beranda</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.hero.setting') }}" class="bg-white border border-zinc-300 hover:bg-zinc-50 text-zinc-700 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Pengaturan Animasi
            </a>
            <a href="{{ route('admin.hero.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Slider
            </a>
        </div>
    </div>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
            <button @click="show = false" type="button" class="text-green-600 hover:text-green-800 hover:bg-green-200 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-zinc-50 border-b border-zinc-200">
                    <th class="p-4 font-semibold text-zinc-600 text-sm w-16 text-center">Geser</th>
                    <th class="p-4 font-semibold text-zinc-600 text-sm w-16 text-center">Urutan</th>
                    <th class="p-4 font-semibold text-zinc-600 text-sm">Preview</th>
                    <th class="p-4 font-semibold text-zinc-600 text-sm">Konten</th>
                    <th class="p-4 font-semibold text-zinc-600 text-sm">Status</th>
                    <th class="p-4 font-semibold text-zinc-600 text-sm w-32 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100"
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
                @php $activeCounter = 1; @endphp
                @forelse($sliders as $slider)
                    <tr class="hover:bg-zinc-50 transition-colors bg-white group" data-id="{{ $slider->id }}" wire:key="slider-{{ $slider->id }}">
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
                        <td class="p-4 text-sm text-zinc-600 font-bold text-center">
                            @if($slider->is_active)
                                <span class="bg-primary-50 text-primary-700 py-1 px-2.5 rounded-md">{{ $activeCounter++ }}</span>
                            @else
                                <span class="text-zinc-300" title="Slider nonaktif tidak memiliki urutan tayang">-</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <img src="{{ asset($slider->image_path) }}" class="w-32 h-20 object-cover rounded-lg border border-zinc-200" alt="Slider">
                        </td>
                        <td class="p-4 text-sm text-zinc-600">
                            <div class="font-bold text-zinc-900 mb-1">{{ $slider->title ?? '(Tanpa Judul)' }}</div>
                            <div class="text-xs text-zinc-500 line-clamp-2">{{ $slider->subtitle ?? '(Tanpa Subtitle)' }}</div>
                        </td>
                        <td class="p-4">
                            <button wire:click="toggleStatus({{ $slider->id }})" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $slider->is_active ? 'bg-primary-600' : 'bg-zinc-200' }}">
                                <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $slider->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                            </button>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.hero.edit', $slider->id) }}" class="p-2 text-zinc-400 hover:text-blue-600 transition-colors bg-white rounded-lg border border-zinc-200 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <button wire:click="delete({{ $slider->id }})" wire:confirm="Apakah Anda yakin ingin menghapus slider ini?" class="p-2 text-zinc-400 hover:text-red-600 transition-colors bg-white rounded-lg border border-zinc-200 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-zinc-500">Belum ada slider beranda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
