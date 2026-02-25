@extends('layout.app')

@section('title', 'Galeri Desa - Desa Banjaran')

@section('content')

{{-- Hero Section --}}
<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-desa-gold/5 rounded-full -ml-12 -mb-12 blur-2xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
       
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4"> Galeri Desa Banjaran</h1>
        <p class="text-gray-400 text-base max-w-xl mx-auto">
             Dokumentasi momen, kegiatan, dan keindahan Desa Banjaran yang terekam dalam gambar.
        </p>
    </div>
</section>

{{-- Filter & Gallery Section --}}
<section class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filter Kategori --}}
        <div class="flex flex-wrap items-center justify-center gap-3 mb-12">
            <a href="{{ route('galeri') }}"
               class="filter-btn px-5 py-2 rounded-full text-sm font-semibold border transition-all duration-200
                      {{ !request('kategori') || request('kategori') === 'semua'
                         ? 'bg-desa-dark text-desa-gold border-desa-dark shadow-md'
                         : 'bg-white text-gray-600 border-gray-300 hover:border-desa-dark hover:text-desa-dark' }}">
                Semua
            </a>
            @foreach($kategoriList as $kat)
                <a href="{{ route('galeri', ['kategori' => $kat]) }}"
                   class="filter-btn px-5 py-2 rounded-full text-sm font-semibold border transition-all duration-200
                          {{ request('kategori') === $kat
                             ? 'bg-desa-dark text-desa-gold border-desa-dark shadow-md'
                             : 'bg-white text-gray-600 border-gray-300 hover:border-desa-dark hover:text-desa-dark' }}">
                    {{ ucfirst($kat) }}
                </a>
            @endforeach
        </div>

        {{-- Gallery Grid --}}
        @if($galeris->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
                @foreach($galeris as $item)
                    <div class="gallery-card group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer"
                         onclick="openLightbox('{{ asset('storage/' . $item->gambar) }}', '{{ addslashes($item->judul) }}', '{{ addslashes($item->deskripsi) }}', '{{ $item->kategori }}', '{{ $item->tanggal_foto->translatedFormat('d F Y') }}')">

                        {{-- Image --}}
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                 alt="{{ $item->judul }}"
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy">

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-desa-dark/0 group-hover:bg-desa-dark/50 transition-all duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-90 group-hover:scale-100">
                                    <div class="w-12 h-12 rounded-full bg-desa-gold/20 border-2 border-desa-gold flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-5 h-5 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Kategori Badge --}}
                            <div class="absolute top-3 left-3">
                                <span class="bg-desa-gold text-desa-dark text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">
                                    {{ $item->kategori }}
                                </span>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2 group-hover:text-desa-dark transition">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-gray-400 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $item->tanggal_foto->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($galeris->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $galeris->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        @else
            {{-- Empty State --}}
            <div class="text-center py-24">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-gray-500 font-semibold text-lg mb-2">Belum Ada Foto</h3>
                <p class="text-gray-400 text-sm">Foto untuk kategori ini belum tersedia.</p>
                <a href="{{ route('galeri') }}" class="inline-block mt-6 px-6 py-2 bg-desa-dark text-desa-gold text-sm font-semibold rounded-full hover:bg-gray-800 transition">
                    Lihat Semua Foto
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Lightbox Modal --}}
<div id="lightbox" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" onclick="closeLightbox()"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-4xl mx-auto flex flex-col md:flex-row bg-desa-dark rounded-2xl overflow-hidden shadow-2xl border border-gray-800 max-h-[90vh]">

        {{-- Image Side --}}
        <div class="flex-1 flex items-center justify-center bg-black min-h-[300px] md:min-h-0">
            <img id="lightbox-img" src="" alt="" class="max-h-[60vh] md:max-h-[85vh] w-full object-contain">
        </div>

        {{-- Info Side --}}
        <div class="w-full md:w-72 p-6 flex flex-col justify-between border-t md:border-t-0 md:border-l border-gray-800 flex-shrink-0">
            <div>
                <span id="lightbox-kategori" class="inline-block bg-desa-gold text-desa-dark text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-4"></span>
                <h2 id="lightbox-judul" class="text-white font-bold text-lg leading-snug mb-3" style="font-family: 'Georgia', serif;"></h2>
                <p id="lightbox-deskripsi" class="text-gray-400 text-sm leading-relaxed"></p>
            </div>
            <div class="mt-6 pt-4 border-t border-gray-800">
                <p class="text-gray-500 text-xs flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span id="lightbox-tanggal"></span>
                </p>
            </div>
        </div>

        {{-- Close Button --}}
        <button onclick="closeLightbox()"
                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition border border-white/10"
                aria-label="Tutup">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openLightbox(src, judul, deskripsi, kategori, tanggal) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-img').alt = judul;
        document.getElementById('lightbox-judul').textContent = judul;
        document.getElementById('lightbox-deskripsi').textContent = deskripsi || 'Tidak ada deskripsi.';
        document.getElementById('lightbox-kategori').textContent = kategori;
        document.getElementById('lightbox-tanggal').textContent = tanggal;

        const lb = document.getElementById('lightbox');
        lb.classList.remove('hidden');
        lb.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden');
        lb.classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endpush