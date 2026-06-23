<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-zinc-900">Dashboard</h1>
        <p class="text-zinc-600 text-sm mt-1">
            Selamat datang kembali, <span class="font-semibold">{{ auth()->user()->name }}</span>!
        </p>
    </div>

    @if($isMitraMedia)
        <!-- MITRA MEDIA DASHBOARD -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex items-center">
                <div class="p-3 rounded-full bg-primary-100 text-primary-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide">Tulisan Saya</p>
                    <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_posts']) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide">Galeri Saya</p>
                    <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_galleries']) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide">Agenda Saya</p>
                    <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_events']) }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- DRAFTS REMINDER -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50 flex justify-between items-center">
                    <h2 class="font-bold text-zinc-800">Draf Belum Tayang</h2>
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded font-medium">{{ count($draftPosts) }} Draf</span>
                </div>
                <div class="p-6">
                    @if(count($draftPosts) > 0)
                        <div class="space-y-4">
                            @foreach($draftPosts as $draft)
                            <div class="flex items-start justify-between border-b border-zinc-100 pb-4 last:border-0 last:pb-0">
                                <div>
                                    <h3 class="font-medium text-zinc-900 line-clamp-1">{{ $draft->title }}</h3>
                                    <p class="text-xs text-zinc-500 mt-1">Diperbarui: {{ $draft->updated_at->diffForHumans() }}</p>
                                </div>
                                <a href="{{ route('admin.post.index') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-800">Edit</a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 text-zinc-500">
                            <svg class="w-12 h-12 mx-auto text-zinc-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <p>Tidak ada draf yang tertunda.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- LATEST POSTS -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50">
                    <h2 class="font-bold text-zinc-800">Tulisan Terbaru Anda</h2>
                </div>
                <div class="p-6">
                    @if(count($latestActivities) > 0)
                        <div class="space-y-4">
                            @foreach($latestActivities as $post)
                            <div class="flex items-center gap-4 border-b border-zinc-100 pb-4 last:border-0 last:pb-0">
                                @if($post->cover_image)
                                    <img src="{{ asset($post->cover_image) }}" class="w-12 h-12 rounded object-cover border border-zinc-200">
                                @else
                                    <div class="w-12 h-12 rounded bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-zinc-900 line-clamp-1">{{ $post->title }}</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($post->is_published)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-green-100 text-green-800">Publish</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-zinc-100 text-zinc-800">Draft</span>
                                        @endif
                                        <span class="text-xs text-zinc-500">{{ $post->created_at->locale('id')->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 text-zinc-500">
                            <p>Anda belum membuat tulisan.</p>
                            <a href="{{ route('admin.post.index') }}" class="mt-2 inline-block text-sm text-primary-600 font-medium hover:underline">Mulai menulis &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @else
        <!-- SUPER ADMIN / ADMIN DASHBOARD -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex items-center relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="p-3 rounded-full bg-primary-100 text-primary-600 mr-4 relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wide">Total Tulisan</p>
                    <p class="text-2xl font-bold text-zinc-900 mt-1">{{ number_format($stats['total_posts']) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex items-center relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4 relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wide">Total Galeri</p>
                    <p class="text-2xl font-bold text-zinc-900 mt-1">{{ number_format($stats['total_galleries']) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex items-center relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4 relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wide">Total Agenda</p>
                    <p class="text-2xl font-bold text-zinc-900 mt-1">{{ number_format($stats['total_events']) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex items-center relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4 relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wide">Mitra Media</p>
                    <p class="text-2xl font-bold text-zinc-900 mt-1">{{ number_format($stats['total_users']) }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- CHART -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 lg:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-zinc-800">Tren Publikasi Tulisan</h2>
                    <span class="text-xs text-zinc-500">6 Bulan Terakhir</span>
                </div>
                <div class="relative h-64 w-full" wire:ignore>
                    <canvas id="publicationChart"></canvas>
                </div>
            </div>

            <!-- LATEST ACTIVITY -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50">
                    <h2 class="font-bold text-zinc-800">Aktivitas Terkini</h2>
                </div>
                <div class="p-6">
                    @if(count($latestActivities) > 0)
                        <div class="space-y-5">
                            @foreach($latestActivities as $post)
                            <div class="flex items-start gap-4">
                                <div class="w-2 h-2 mt-1.5 rounded-full {{ $post->is_published ? 'bg-green-500' : 'bg-zinc-300' }} shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    @php
                                        $typeStr = str_replace('_', ' ', $post->type);
                                        $badgeColor = match($post->type) {
                                            'berita' => 'bg-blue-100 text-blue-800',
                                            'artikel' => 'bg-indigo-100 text-indigo-800',
                                            'riset' => 'bg-purple-100 text-purple-800',
                                            'siaran_pers' => 'bg-emerald-100 text-emerald-800',
                                            'galeri' => 'bg-orange-100 text-orange-800',
                                            'agenda' => 'bg-rose-100 text-rose-800',
                                            default => 'bg-zinc-100 text-zinc-800'
                                        };
                                    @endphp
                                    <h3 class="font-medium text-sm text-zinc-900 line-clamp-1">
                                        <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider {{ $badgeColor }} mr-1 align-middle leading-none">{{ $typeStr }}</span>
                                        <span class="align-middle">{{ $post->title }}</span>
                                    </h3>
                                    <div class="flex items-center justify-between mt-1">
                                        <p class="text-xs text-zinc-500 truncate">{{ $post->author }}</p>
                                        <p class="text-[10px] text-zinc-400 whitespace-nowrap ml-2">{{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 text-zinc-500">
                            <p>Belum ada aktivitas.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
@if(!$isMitraMedia)
<script>
    document.addEventListener('livewire:initialized', async () => {
        const ctx = document.getElementById('publicationChart');
        if (ctx && window.loadChartJs) {
            const Chart = await window.loadChartJs();
            const chartData = @json($chartData);
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Jumlah Tulisan',
                        data: chartData.values,
                        backgroundColor: '#2fb575',
                        borderRadius: 4,
                        barThickness: 24,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                title: function() { return null; }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            grid: {
                                color: '#f4f4f5',
                                drawBorder: false,
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    });
</script>
@endif
@endpush
