@extends('layouts.public')

@section('title', 'Strategi Pengembangan Ekonomi Sirkular - Acara Komdes Sultra')

@section('content')
<!-- Detail Acara -->
<div class="bg-white py-28 lg:py-36 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-zinc-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Beranda</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('acara') }}" class="ml-1 md:ml-2 hover:text-primary-600 transition-colors">Acara</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="ml-1 md:ml-2 text-zinc-700 truncate max-w-[150px] sm:max-w-[300px]">Strategi Pengembangan Ekonomi...</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-zinc-100 overflow-hidden">
            
            <!-- Poster Wrapper -->
            <div class="w-full bg-zinc-900 flex justify-center relative border-b border-zinc-100">
                <!-- Blurred background for aesthetics -->
                <div class="absolute inset-0 opacity-40">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Background Blur" class="w-full h-full object-cover blur-xl">
                </div>
                <!-- Actual Poster (Constrained to natural aspect ratio) -->
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Poster Seminar Nasional" class="relative z-10 w-full max-w-2xl max-h-[600px] object-contain object-top">
            </div>

            <div class="p-8 md:p-12">
                <!-- Title & Tags -->
                <div class="mb-8">
                    <div class="flex gap-2 mb-4">
                        <span class="text-xs font-bold text-secondary-600 bg-secondary-50 px-2.5 py-1 rounded-md uppercase tracking-wider">Seminar</span>
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-md flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Segera</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-heading font-bold text-zinc-900 leading-tight mb-4">Strategi Pengembangan Ekonomi Sirkular di Wilayah Pedesaan</h1>
                </div>

                <!-- Info Box (Date & Location) -->
                <div class="bg-zinc-50 border border-zinc-100 rounded-2xl p-6 mb-10 flex flex-col sm:flex-row gap-6 sm:gap-12">
                    <div class="flex gap-4 items-start">
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-zinc-100 text-primary-500">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-1">Pelaksanaan</h4>
                            <p class="text-zinc-900 font-semibold">Senin, 20 Mei 2024</p>
                            <p class="text-zinc-500 text-sm">08:00 WITA - Selesai</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 items-start">
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-zinc-100 text-primary-500">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-1">Lokasi</h4>
                            <p class="text-zinc-900 font-semibold">Hotel Claro, Kendari</p>
                            <p class="text-zinc-500 text-sm">Offline (Tatap Muka)</p>
                        </div>
                    </div>
                </div>

                <!-- Description / Body Content -->
                <div class="text-zinc-600 leading-relaxed space-y-6 text-lg">
                    <p>Komdes Sultra mengundang seluruh pemangku kepentingan desa, aktivis lingkungan, dan masyarakat umum untuk menghadiri seminar nasional dengan tema "Strategi Pengembangan Ekonomi Sirkular di Wilayah Pedesaan".</p>
                    
                    <h3 class="font-heading font-bold text-2xl text-zinc-900 mt-10 mb-4">Latar Belakang</h3>
                    <p>Pertumbuhan ekonomi desa tidak boleh mengabaikan daya dukung lingkungan. Model ekonomi sirkular menawarkan solusi di mana limbah desa (baik dari pertanian maupun rumah tangga) dapat dikelola dan dimanfaatkan kembali sebagai sumber daya baru yang memiliki nilai ekonomi.</p>
                    
                    <h3 class="font-heading font-bold text-2xl text-zinc-900 mt-10 mb-4">Materi yang Akan Dibahas</h3>
                    <ul class="list-disc pl-6 space-y-2 mt-4">
                        <li>Konsep dasar dan implementasi ekonomi sirkular di level desa.</li>
                        <li>Studi kasus: Pemanfaatan limbah pertanian menjadi briket bioarang.</li>
                        <li>Strategi pemasaran produk hasil olahan daur ulang.</li>
                        <li>Akses pendanaan untuk inisiatif ramah lingkungan di pedesaan.</li>
                    </ul>

                    <h3 class="font-heading font-bold text-2xl text-zinc-900 mt-10 mb-4">Narasumber</h3>
                    <ul class="list-disc pl-6 space-y-2 mt-4">
                        <li><strong class="text-zinc-900">Dr. Ir. Budi Santoso</strong> - Pakar Ekonomi Lingkungan Universitas Halu Oleo</li>
                        <li><strong class="text-zinc-900">Siti Aminah</strong> - Praktisi Desa Mandiri Energi</li>
                        <li><strong class="text-zinc-900">Ketua Komdes Sultra</strong></li>
                    </ul>

                    <p class="mt-6 bg-primary-50 text-primary-900 p-4 rounded-xl border border-primary-100">Seminar ini tidak dipungut biaya (Gratis) dan terbuka untuk umum. Mengingat kapasitas ruangan yang terbatas, peserta diharapkan hadir 30 menit sebelum acara dimulai.</p>
                </div>

                <!-- Footer / CTA -->
                <div class="mt-12 pt-8 border-t border-zinc-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-zinc-500">Bagikan acara ini:</span>
                        <div class="flex gap-2">
                            <button class="w-8 h-8 rounded-full bg-zinc-100 text-zinc-600 flex items-center justify-center hover:bg-[#25D366] hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            </button>
                            <button class="w-8 h-8 rounded-full bg-zinc-100 text-zinc-600 flex items-center justify-center hover:bg-[#1877F2] hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div>
@endsection
