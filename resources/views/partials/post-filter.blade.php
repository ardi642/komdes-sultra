<!-- Header & Toggle Button -->
<div class="flex flex-col mb-16 gap-4 relative">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
        <div>
            <h2 class="font-heading font-bold text-xl md:text-2xl text-[#165a3f] uppercase tracking-widest">{{ $title ?? 'Daftar Tulisan' }}</h2>
        </div>
        
        <div class="flex items-center gap-3 relative z-10">
            <!-- Tampilkan indikator jika ada filter aktif -->
            @if(request()->hasAny(['category', 'year', 'month', 'tags', 'search']))
            <a href="{{ request()->url() }}" class="text-xs font-semibold text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-2 rounded-xl transition-colors flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Reset
            </a>
            @endif

            <button @click="showFilter = !showFilter" 
                    class="flex items-center gap-2 text-sm font-bold px-5 py-2.5 rounded-xl transition-all shadow-sm border"
                    :class="showFilter ? 'bg-primary-50 border-primary-200 text-primary-700' : 'bg-white border-zinc-200 text-zinc-700 hover:border-primary-300 hover:text-primary-700 hover:shadow-md hover:-translate-y-0.5'">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                <span x-text="showFilter ? 'Sembunyikan Filter' : 'Filter Lanjutan'"></span>
            </button>
        </div>
    </div>

    <!-- Summary Filter Aktif -->
    @if(request()->hasAny(['category', 'year', 'month', 'tags', 'search']))
    <div x-show="!showFilter" x-transition class="flex items-center flex-wrap gap-4 mt-1 w-full max-w-4xl">
        <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest">Filter Aktif:</span>

        <div class="flex flex-wrap items-center gap-2">
            @if(request('search'))
                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Pencarian: "{{ request('search') }}"</span>
            @endif
            @if(request('category'))
                @php $catName = \App\Models\Category::where('slug', request('category'))->value('name'); @endphp
                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Kategori: {{ $catName ?? request('category') }}</span>
            @endif
            @if(request('year') && !request('month'))
                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Tahun: {{ request('year') }}</span>
            @endif
            @if(request('month') && request('year'))
                @php $monthName = \Carbon\Carbon::create()->month((int)request('month'))->locale('id')->translatedFormat('F'); @endphp
                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Bulan: {{ $monthName }} {{ request('year') }}</span>
            @endif
            @if(request('tags'))
                @php 
                    $activeTagNames = \App\Models\Tag::whereIn('slug', (array)request('tags'))->pluck('name', 'slug'); 
                    $tagList = [];
                    foreach((array)request('tags') as $tagSlug) {
                        $tagList[] = $activeTagNames[$tagSlug] ?? $tagSlug;
                    }
                @endphp
                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-primary-50 text-primary-700 border border-primary-100/60 shadow-sm gap-1.5">Tag: {{ implode(', ', $tagList) }}</span>
            @endif
        </div>
    </div>
    @endif
</div>

<!-- Active Filters Bar (Collapsible) -->
<div x-show="showFilter" 
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-4"
     class="bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white/60 mb-12 relative overflow-visible" 
     style="display: {{ request()->hasAny(['category', 'year', 'month', 'tags']) ? 'block' : 'none' }};">
    
    <form action="{{ request()->url() }}" method="GET" class="flex flex-col gap-8">
        
        <!-- Hidden input for search to persist -->
        @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
        @endif

        <div class="flex flex-col gap-6" x-data="dateFilter()">
            
            <!-- Row 1: Basic Filters (Category, Year, Month) -->
            <div class="flex flex-col md:flex-row gap-4 w-full">
                
                @if($categories->count() > 0)
                <!-- Kategori Dropdown -->
                <div class="flex flex-col gap-2 w-full md:w-1/3">
                    <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest pl-1">Kategori</label>
                    <div class="relative">
                        <select name="category" class="appearance-none bg-white border-0 text-zinc-700 text-sm font-medium rounded-2xl shadow-sm ring-1 ring-zinc-200/80 focus:ring-2 focus:ring-primary-500 focus:outline-none block w-full py-3.5 pl-4 pr-10 transition-all cursor-pointer hover:ring-primary-300">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-zinc-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Arsip Waktu Dropdowns -->
                <div class="flex flex-col gap-2 w-full {{ $categories->count() > 0 ? 'md:w-2/3' : '' }}">
                    <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest pl-1">Arsip Waktu</label>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Tahun -->
                        <div class="relative w-full sm:w-1/2">
                            <select name="year" x-model="selectedYear" @change="updateMonths()" class="appearance-none bg-white border-0 text-zinc-700 text-sm font-medium rounded-2xl shadow-sm ring-1 ring-zinc-200/80 focus:ring-2 focus:ring-primary-500 focus:outline-none block w-full py-3.5 pl-4 pr-10 transition-all cursor-pointer hover:ring-primary-300">
                                <option value="">Semua Tahun</option>
                                @foreach($archives->keys() as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>

                        <!-- Bulan -->
                        <div class="relative w-full sm:w-1/2 transition-all duration-300" :class="!selectedYear ? 'opacity-50 pointer-events-none' : ''">
                            <select name="month" :value="selectedMonth" @change="selectedMonth = $event.target.value" class="appearance-none bg-white border-0 text-zinc-700 text-sm font-medium rounded-2xl shadow-sm ring-1 ring-zinc-200/80 focus:ring-2 focus:ring-primary-500 focus:outline-none block w-full py-3.5 pl-4 pr-10 transition-all cursor-pointer hover:ring-primary-300">
                                <option value="">Semua Bulan</option>
                                <template x-for="month in availableMonths" :key="month.value">
                                    <option :value="month.value" x-text="month.label" :selected="selectedMonth === month.value"></option>
                                </template>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Row 2: Smart Tags Select (Alpine Component) -->
            @php
                $allTags = \App\Models\Tag::all(['name', 'slug']);
            @endphp
            <div class="flex flex-col gap-2 relative w-full" x-data="tagSelect()">
                <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest pl-1">Cari & Pilih Tag</label>
                
                <!-- Render existing tags as hidden inputs -->
                <template x-for="(tag, index) in selectedTags" :key="index">
                    <input type="hidden" name="tags[]" :value="tag.slug">
                </template>

                <div class="bg-white rounded-2xl shadow-sm ring-1 ring-zinc-200/80 min-h-[52px] p-2 flex flex-wrap gap-2 items-center cursor-text transition-all focus-within:ring-2 focus-within:ring-primary-500" @click="$refs.tagInput.focus()">
                    
                    <!-- Selected Tags Display -->
                    <template x-for="(tag, index) in selectedTags" :key="index">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100/50 shadow-sm animate-fade-in-up">
                            #<span x-text="tag.name"></span>
                            <button type="button" @click.stop="removeTag(index)" class="ml-1.5 text-primary-400 hover:text-primary-800 transition-colors focus:outline-none">
                                <svg class="h-3.5 w-3.5" stroke="currentColor" fill="none" viewBox="0 0 8 8"><path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path></svg>
                            </button>
                        </span>
                    </template>

                    <!-- Smart Input Field -->
                    <div class="relative flex-grow min-w-[200px]">
                        <input x-ref="tagInput" 
                               x-model="newTag" 
                               @input="updateSuggestions()"
                               @focus="showSuggestions = true; updateSuggestions()"
                               @click.away="showSuggestions = false"
                               @keydown.enter.prevent="addTagFromInput()" 
                               @keydown.backspace="if(newTag === '' && selectedTags.length > 0) removeTag(selectedTags.length - 1)"
                               type="text" 
                               placeholder="Ketik tag pilihanmu..." 
                               class="bg-transparent border-none focus:ring-0 text-sm w-full p-1 text-zinc-800 placeholder-zinc-400 font-medium outline-none">
                        
                        <!-- Autocomplete Dropdown -->
                        <div x-show="showSuggestions && suggestions.length > 0" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute z-50 left-0 top-full mt-2 w-full max-w-sm bg-white rounded-2xl shadow-[0_10px_40px_rgb(0,0,0,0.08)] border border-zinc-100 overflow-hidden" 
                             style="display: none;">
                            <ul class="py-2 max-h-60 overflow-y-auto custom-scrollbar">
                                <template x-for="suggestion in suggestions" :key="suggestion.slug">
                                    <li>
                                        <button type="button" @click.stop="addTag(suggestion)" class="w-full text-left px-4 py-2.5 hover:bg-primary-50 transition-colors flex items-center justify-between group">
                                            <span class="text-sm font-semibold text-zinc-700 group-hover:text-primary-700" x-text="'#' + suggestion.name"></span>
                                            <svg class="w-4 h-4 text-primary-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3 mt-2 border-t border-zinc-100/80 pt-6">
            <button type="button" @click="window.location.href='{{ url()->current() }}'" class="px-6 py-3 text-sm font-bold text-zinc-500 hover:text-zinc-800 bg-transparent hover:bg-zinc-100 rounded-2xl transition-colors">Tutup & Hapus Filter</button>
            <button type="submit" class="px-8 py-3 text-sm font-bold text-white bg-primary-600 hover:bg-primary-500 rounded-2xl transition-all shadow-[0_4px_14px_0_rgba(22,90,63,0.39)] hover:shadow-[0_6px_20px_rgba(22,90,63,0.23)] hover:-translate-y-0.5">Terapkan Filter</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        
        // Data format dari backend untuk bulan
        const archivesData = @json($archives);
        
        // Helper fungsi untuk nama bulan
        const getMonthName = (monthNumber) => {
            const date = new Date();
            date.setMonth(monthNumber - 1);
            return date.toLocaleString('id-ID', { month: 'long' });
        };

        Alpine.data('dateFilter', () => ({
            selectedYear: '{{ request('year', '') }}',
            selectedMonth: '{{ request('month', '') }}',
            availableMonths: [],

            init() {
                this.updateMonths(false);
            },

            updateMonths(resetMonth = true) {
                if (resetMonth) {
                    this.selectedMonth = '';
                }
                
                this.availableMonths = [];
                
                if (this.selectedYear && archivesData[this.selectedYear]) {
                    this.availableMonths = archivesData[this.selectedYear].map(item => {
                        const monthStr = String(item.month).padStart(2, '0');
                        return {
                            value: monthStr,
                            label: getMonthName(item.month)
                        };
                    });
                }
            }
        }));

        Alpine.data('tagSelect', () => ({
            newTag: '',
            availableTags: @json($allTags),
            selectedTagSlugs: @json((array) request('tags', [])),
            selectedTags: [],
            suggestions: [],
            showSuggestions: false,
            
            init() {
                // Pre-fill selectedTags object array from URL slugs
                this.selectedTags = this.availableTags.filter(tag => this.selectedTagSlugs.includes(tag.slug));
            },

            updateSuggestions() {
                const query = this.newTag.trim().toLowerCase();
                if (query === '') {
                    this.suggestions = this.availableTags.filter(t => !this.selectedTagSlugs.includes(t.slug)).slice(0, 8);
                } else {
                    this.suggestions = this.availableTags.filter(t => 
                        !this.selectedTagSlugs.includes(t.slug) && 
                        (t.name.toLowerCase().includes(query) || t.slug.toLowerCase().includes(query))
                    ).slice(0, 8);
                }
            },
            
            addTag(tagObj) {
                if (!this.selectedTagSlugs.includes(tagObj.slug)) {
                    this.selectedTags.push(tagObj);
                    this.selectedTagSlugs.push(tagObj.slug);
                }
                this.newTag = '';
                this.showSuggestions = false;
                this.$refs.tagInput.focus();
                this.updateSuggestions();
            },

            addTagFromInput() {
                const query = this.newTag.trim().toLowerCase();
                if (query !== '') {
                    // Coba temukan tag yang persis sama
                    const found = this.availableTags.find(t => t.name.toLowerCase() === query || t.slug.toLowerCase() === query);
                    if (found) {
                        this.addTag(found);
                    } else if (this.suggestions.length > 0) {
                        // Jika tidak ada yang persis sama, ambil saran pertama
                        this.addTag(this.suggestions[0]);
                    }
                }
            },
            
            removeTag(index) {
                this.selectedTags.splice(index, 1);
                this.selectedTagSlugs.splice(index, 1);
                this.updateSuggestions();
            }
        }))
    })
</script>
