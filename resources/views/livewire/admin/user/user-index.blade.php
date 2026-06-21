<div>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Manajemen Akun</h1>
            <p class="text-sm text-zinc-500 mt-1">Kelola pengguna, ubah peran, dan hak akses.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.user.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-xl text-sm font-semibold hover:bg-primary-700 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pengguna
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="p-4 border-b border-zinc-100 flex flex-col sm:flex-row gap-4 justify-between items-center bg-zinc-50/50">
            <div class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" class="block w-full pl-10 pr-3 py-2 border border-zinc-300 rounded-xl leading-5 bg-white placeholder-zinc-500 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-colors" placeholder="Cari nama atau email...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200">
                <thead class="bg-zinc-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Pengguna</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Peran & Posisi</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-zinc-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-zinc-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-zinc-50/50 transition-colors {{ $user->trashed() ? 'opacity-60' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover border border-zinc-200" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=165a3f&color=fff' }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-zinc-900">{{ $user->name }}</div>
                                        <div class="text-sm text-zinc-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 mb-1">
                                    @foreach($user->roles as $role)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $role->name === 'Super Admin' ? 'bg-purple-100 text-purple-800' : ($role->name === 'Admin' ? 'bg-blue-100 text-blue-800' : 'bg-zinc-100 text-zinc-800') }}">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="text-xs text-zinc-500">{{ $user->posisi ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->trashed())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Nonaktif / Dihapus
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    @php
                                        $canManage = false;
                                        if (auth()->user()->hasRole('Super Admin')) {
                                            $canManage = true;
                                        } elseif (auth()->user()->hasRole('Admin')) {
                                            // Admin can only manage Mitra Media
                                            if ($user->hasRole('Mitra Media')) {
                                                $canManage = true;
                                            }
                                        }
                                    @endphp

                                    @if($user->id === auth()->id())
                                        <span class="text-xs text-zinc-400 italic mr-2">Lihat menu Profil</span>
                                    @elseif($canManage)
                                        @if($user->trashed())
                                            <button wire:click="restore({{ $user->id }})" class="text-zinc-600 hover:text-green-600 transition-colors p-1.5 hover:bg-green-50 rounded-lg" title="Pulihkan Akun">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                            </button>
                                            @if(auth()->user()->hasRole('Super Admin'))
                                                <button @click="$dispatch('open-confirm-modal', {
                                                    title: 'Hapus Permanen Pengguna',
                                                    message: 'Apakah Anda yakin ingin menghapus permanen pengguna <strong>{{ $user->name }}</strong>? Data yang dihapus permanen tidak dapat dikembalikan.',
                                                    confirmText: 'Hapus Permanen',
                                                    onConfirm: () => @this.forceDelete({{ $user->id }})
                                                })" class="text-zinc-400 hover:text-red-600 transition-colors p-1.5 hover:bg-red-50 rounded-lg" title="Hapus Permanen">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            @endif
                                        @else
                                            <a href="{{ route('admin.user.edit', $user->id) }}" class="text-zinc-400 hover:text-primary-600 transition-colors p-1.5 hover:bg-primary-50 rounded-lg" title="Edit Pengguna">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            @if($user->id !== 1)
                                                <button @click="$dispatch('open-confirm-modal', {
                                                    title: 'Nonaktifkan Pengguna',
                                                    message: 'Apakah Anda yakin ingin menonaktifkan pengguna <strong>{{ $user->name }}</strong>? Pengguna ini tidak akan bisa login lagi.',
                                                    confirmText: 'Ya, Nonaktifkan',
                                                    onConfirm: () => @this.delete({{ $user->id }})
                                                })" class="text-zinc-400 hover:text-red-600 transition-colors p-1.5 hover:bg-red-50 rounded-lg" title="Hapus Akses">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        <span class="text-xs text-zinc-400 italic mr-2">Akses Terbatas</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-zinc-900">Belum ada pengguna</h3>
                                <p class="mt-1 text-sm text-zinc-500">Mulai dengan menambahkan pengguna baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 bg-zinc-50">
                {{ $users->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </div>
</div>
