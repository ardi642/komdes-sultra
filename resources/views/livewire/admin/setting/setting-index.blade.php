<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-zinc-900">Pengaturan Situs</h1>
        <p class="text-sm text-zinc-500 mt-1">Kelola identitas, kontak, dan teks beranda website Anda.</p>
    </div>

    <!-- TABS NAVIGATION -->
    <div class="bg-white rounded-t-xl border-b border-zinc-200">
        <nav class="flex overflow-x-auto" aria-label="Tabs">
            <button wire:click="$set('tab', 'identitas')" class="shrink-0 relative py-4 px-6 text-sm font-medium transition-colors {{ $tab === 'identitas' ? 'text-primary-600 bg-primary-50/50' : 'text-zinc-500 hover:text-zinc-700 hover:bg-zinc-50' }}">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                    Identitas & Kontak
                </div>
                @if($tab === 'identitas')
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary-600"></div>
                @endif
            </button>

            <button wire:click="$set('tab', 'beranda')" class="shrink-0 relative py-4 px-6 text-sm font-medium transition-colors {{ $tab === 'beranda' ? 'text-primary-600 bg-primary-50/50' : 'text-zinc-500 hover:text-zinc-700 hover:bg-zinc-50' }}">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Teks Beranda
                </div>
                @if($tab === 'beranda')
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary-600"></div>
                @endif
            </button>

            <button wire:click="$set('tab', 'tentang')" class="shrink-0 relative py-4 px-6 text-sm font-medium transition-colors {{ $tab === 'tentang' ? 'text-primary-600 bg-primary-50/50' : 'text-zinc-500 hover:text-zinc-700 hover:bg-zinc-50' }}">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tentang Kami
                </div>
                @if($tab === 'tentang')
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary-600"></div>
                @endif
            </button>
        </nav>
    </div>

    <!-- TAB CONTENTS -->
    <div class="bg-white rounded-b-xl shadow-sm border border-t-0 border-zinc-200 p-6 md:p-8">
        @if($tab === 'identitas')
            @livewire('admin.setting.contact-index', key('tab-identitas'))
        @elseif($tab === 'beranda')
            @livewire('admin.homepage-setting.homepage-setting-form', key('tab-beranda'))
        @elseif($tab === 'tentang')
            @livewire('admin.setting.about-index', key('tab-tentang'))
        @endif
    </div>
</div>
