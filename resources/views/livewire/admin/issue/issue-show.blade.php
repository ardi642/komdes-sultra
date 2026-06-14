<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900">Kelola Konten Isu: {{ $issue->title }}</h1>
            <p class="text-sm text-zinc-500 mt-1">Daftar publikasi dan acara yang terkait dengan isu ini.</p>
        </div>
        <a href="{{ route('admin.issue.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-300 rounded-lg font-semibold text-xs text-zinc-700 uppercase tracking-widest hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50 flex items-center justify-between">
            <h2 class="font-semibold text-zinc-800">Daftar Publikasi (Berita, Artikel, Riset, Siaran Pers)</h2>
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-zinc-600">Tampil:</span>
                <select wire:model.live="postsPerPage" class="bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-1.5 pl-3 pr-8 text-zinc-900 transition-colors">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-zinc-600">
                <thead class="text-xs text-zinc-700 uppercase bg-white border-b border-zinc-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Judul Publikasi</th>
                        <th scope="col" class="px-6 py-3 font-medium">Tipe</th>
                        <th scope="col" class="px-6 py-3 font-medium">Status</th>
                        <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($posts as $post)
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-zinc-900">{{ $post->title }}</div>
                            <div class="text-xs text-zinc-500 mt-1">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M Y') : '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 capitalize">
                                {{ str_replace('_', ' ', $post->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($post->is_published)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Publish</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="detachPost({{ $post->id }})" onclick="confirm('Keluarkan publikasi ini dari Isu?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Keluarkan dari Isu</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-zinc-500">Belum ada publikasi yang dikaitkan dengan isu ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
        <div class="px-6 py-4 border-t border-zinc-200">
            {{ $posts->links() }}
        </div>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50 flex items-center justify-between">
            <h2 class="font-semibold text-zinc-800">Daftar Agenda Acara</h2>
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-zinc-600">Tampil:</span>
                <select wire:model.live="eventsPerPage" class="bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-1.5 pl-3 pr-8 text-zinc-900 transition-colors">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-zinc-600">
                <thead class="text-xs text-zinc-700 uppercase bg-white border-b border-zinc-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Judul Acara</th>
                        <th scope="col" class="px-6 py-3 font-medium">Jadwal Acara</th>
                        <th scope="col" class="px-6 py-3 font-medium">Lokasi</th>
                        <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($events as $event)
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-zinc-900">{{ $event->title }}</div>
                        </td>
                        <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-zinc-700">{{ $event->location }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="detachEvent({{ $event->id }})" onclick="confirm('Keluarkan acara ini dari Isu?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Keluarkan dari Isu</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-zinc-500">Belum ada acara yang dikaitkan dengan isu ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($events->hasPages())
        <div class="px-6 py-4 border-t border-zinc-200">
            {{ $events->links() }}
        </div>
        @endif
    </div>
</div>
