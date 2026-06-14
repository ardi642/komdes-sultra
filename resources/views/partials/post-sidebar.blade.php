@php
    $baseUrl = $searchRoute ?? request()->url();
    $buildUrl = function($updates) use ($baseUrl) {
        $query = array_merge(request()->query(), $updates);
        $query = array_filter($query, function($value) {
            return !is_null($value) && $value !== '';
        });
        return empty($query) ? $baseUrl : $baseUrl . '?' . http_build_query($query);
    };
@endphp
<div class="space-y-8">
    
    <!-- Search Widget -->
    <div class="flex flex-col">
        <h3 class="font-heading font-bold text-xl md:text-2xl text-[#165a3f] uppercase tracking-widest mb-6">Cari Tulisan</h3>
        <form action="{{ $searchRoute ?? request()->url() }}" method="GET" class="relative">
            <!-- Pertahankan query string lainnya -->
            @foreach(request()->except('search', 'page') as $key => $value)
                @if(is_array($value))
                    @foreach($value as $v)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan kata kunci..." class="w-full pl-5 pr-14 py-4 rounded-2xl border border-zinc-200 bg-white shadow-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-colors text-sm">
            <button type="submit" class="absolute right-2.5 top-2.5 bottom-2.5 aspect-square bg-primary-600 hover:bg-primary-500 text-white rounded-xl flex items-center justify-center transition-all shadow-sm hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>



    <!-- Categories Widget -->
    @if($categories->count() > 0)
    <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
        <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Kategori</h3>
        <ul class="space-y-3">
            @foreach($categories as $cat)
            <li>
                <a href="{{ $buildUrl(['category' => $cat->slug, 'page' => null]) }}" class="flex items-center justify-between group">
                    <span class="text-sm transition-colors flex items-center gap-2 {{ request('category') == $cat->slug ? 'text-primary-600 font-bold' : 'text-zinc-600 group-hover:text-primary-600' }}">
                        <svg class="w-4 h-4 text-secondary-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        {{ $cat->name }}
                    </span>
                    <span class="bg-zinc-50 border border-zinc-100 text-zinc-500 text-xs py-1 px-2.5 rounded-full group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">{{ $cat->posts_count }}</span>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
    @endif

    <!-- Tags Widget -->
    @if($topTags->count() > 0)
    <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm" x-data="{ showTagModal: false }">
        <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Tag Populer</h3>
        <div class="flex flex-wrap gap-2">
            @php
                $activeTags = request('tags', []);
                if(!is_array($activeTags)) $activeTags = [$activeTags];
            @endphp
            @foreach($topTags as $index => $tag)
                @if($index < 15)
                    @php
                        $isActive = in_array($tag->slug, $activeTags);
                        $newTags = $isActive ? array_diff($activeTags, [$tag->slug]) : array_merge($activeTags, [$tag->slug]);
                    @endphp
                    <a href="{{ $buildUrl(['tags' => $newTags, 'page' => null]) }}" 
                       class="px-3 py-1.5 text-xs rounded-lg transition-colors border {{ $isActive ? 'bg-primary-500 border-primary-500 text-white' : 'bg-zinc-50 border-zinc-200 text-zinc-600 hover:border-primary-500 hover:text-primary-600' }}">
                        #{{ $tag->name }}
                    </a>
                @endif
            @endforeach
        </div>
        
        @if(isset($allTags) && $allTags->count() > 15)
        <button @click="showTagModal = true" class="text-xs text-primary-600 hover:text-primary-800 font-semibold mt-4 block text-center w-full">
            Lihat Semua {{ $allTags->count() }} Tag
        </button>

        <!-- Tag Modal (Pop-up) -->
        <template x-teleport="body">
            <div x-show="showTagModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="showTagModal" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0" 
                         x-transition:enter-end="opacity-100" 
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100" 
                         x-transition:leave-end="opacity-0" 
                         class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity" 
                         @click="showTagModal = false" aria-hidden="true"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div x-show="showTagModal" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                        
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex justify-between items-center mb-4 border-b border-zinc-100 pb-3">
                                <h3 class="text-xl leading-6 font-bold text-zinc-900" id="modal-title">
                                    Semua Tag Terkait
                                </h3>
                                <button @click="showTagModal = false" class="text-zinc-400 hover:text-zinc-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            
                            <div class="max-h-[60vh] overflow-y-auto pr-2">
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($allTags as $tag)
                                        @php
                                            $isActive = in_array($tag->slug, $activeTags);
                                            $newTags = $isActive ? array_diff($activeTags, [$tag->slug]) : array_merge($activeTags, [$tag->slug]);
                                        @endphp
                                        <a href="{{ $buildUrl(['tags' => $newTags, 'page' => null]) }}" 
                                           class="flex items-center justify-between p-2 rounded-xl transition-colors border {{ $isActive ? 'bg-primary-50 border-primary-200' : 'bg-zinc-50 border-zinc-100 hover:border-primary-300 hover:bg-white' }}">
                                            <span class="text-sm font-medium {{ $isActive ? 'text-primary-700' : 'text-zinc-700' }} truncate mr-2" title="{{ $tag->name }}">#{{ $tag->name }}</span>
                                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none {{ $isActive ? 'text-primary-100 bg-primary-600' : 'text-zinc-500 bg-zinc-200' }} rounded-full">
                                                {{ $tag->posts_count ?? $tag->events_count ?? 0 }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        @endif
    </div>
    @endif

    <!-- Arsip Widget (Collapsible Accordion) -->
    @if($archives->count() > 0)
    <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm">
        <h3 class="font-heading font-bold text-lg text-[#165a3f] uppercase tracking-widest mb-4 border-b border-zinc-100 pb-2">Arsip Waktu</h3>
        <div class="space-y-3">
        <div class="space-y-3">
            @foreach($archives as $year => $months)
            @php
                $isYearActive = request('year') == $year;
            @endphp
            <div x-data="{ expanded: {{ $isYearActive ? 'true' : 'false' }} }" class="border border-zinc-100 rounded-xl overflow-hidden">
                <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-3 bg-zinc-50 hover:bg-primary-50 transition-colors text-sm font-semibold {{ $isYearActive ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600' }} focus:outline-none group">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 {{ $isYearActive ? 'text-primary-500' : 'text-zinc-400 group-hover:text-primary-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Tahun {{ $year }}
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-300 {{ $isYearActive ? 'text-primary-500' : 'text-zinc-400 group-hover:text-primary-500' }}" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="expanded" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="bg-white border-t border-zinc-100" style="display: {{ $isYearActive ? 'block' : 'none' }};">
                    <ul class="p-2 space-y-1">
                        @foreach($months as $monthData)
                        @php
                            $monthName = \Carbon\Carbon::create()->month($monthData->month)->locale('id')->translatedFormat('F');
                            $isMonthActive = request('year') == $year && request('month') == str_pad($monthData->month, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <li>
                            <a href="{{ $buildUrl(['year' => $year, 'month' => str_pad($monthData->month, 2, '0', STR_PAD_LEFT), 'page' => null]) }}" class="flex justify-between items-center px-3 py-2 text-sm {{ $isMonthActive ? 'text-primary-600 bg-primary-50 font-bold' : 'text-zinc-600 hover:text-primary-600 hover:bg-primary-50' }} rounded-lg transition-colors group">
                                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full {{ $isMonthActive ? 'bg-primary-500' : 'bg-zinc-300 group-hover:bg-primary-500' }} transition-colors"></span>{{ $monthName }}</span> 
                                <span class="text-xs font-medium {{ $isMonthActive ? 'bg-white text-primary-600' : 'bg-zinc-100 text-zinc-500 group-hover:bg-white group-hover:text-primary-600' }} px-2 py-0.5 rounded-full">{{ $monthData->published }}</span>
                            </a>
                        </li>
                        @endforeach

                        <!-- Lihat Semua Bulan untuk Tahun Ini -->
                        <li>
                            <a href="{{ $buildUrl(['year' => $year, 'month' => null, 'page' => null]) }}" class="w-full text-center block mt-2 text-xs font-semibold {{ $isYearActive && !request('month') ? 'text-primary-700 bg-primary-50 py-2 rounded-lg' : 'text-primary-600 hover:text-primary-700 py-2' }}">Lihat Semua Bulan Tahun {{ $year }}...</a>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
            

        </div>
    </div>
    @endif
</div>
