@extends('layout.app')

@section('title', 'Beranda - Desa Banjaran')

@section('content')

{{-- ===== HERO SLIDER (DIPERBARUI) ===== --}}
<section class="relative h-[92vh] min-h-[560px] max-h-[780px] flex items-center overflow-hidden bg-desa-dark -mt-16">

    <div id="slider-container" class="absolute inset-0 z-0">
        @php
            $sliderImages = [
                'images/bg.png',
                'images/bg2.png'
            ];
        @endphp
        @foreach($sliderImages as $index => $img)
        <div class="slider-image absolute inset-0 bg-cover bg-center transition-opacity duration-1000 {{ $index == 0 ? 'opacity-100' : 'opacity-0' }}"
             style="background-image: url('{{ $img }}');">
        </div>
        @endforeach
        <div class="absolute inset-0 bg-gradient-to-r from-desa-dark via-desa-dark/75 to-desa-dark/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-desa-dark/50 via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <span class="inline-block px-3 py-1 bg-desa-gold/20 text-desa-gold text-xs font-bold tracking-[0.2em] uppercase mb-6 rounded">Portal Resmi</span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl text-white font-extrabold leading-[1.08] tracking-tight mb-4">
                Desa Banjaran<br>
                <span class="text-desa-gold">Mandiri &amp; Sejahtera</span>
            </h1>
            <p class="text-gray-300 text-xs sm:text-sm lg:text-base leading-relaxed mb-7 max-w-lg">
                Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan mengutamakan pelayanan prima bagi masyarakat.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="#sambutan"
                   class="inline-flex items-center gap-2 bg-desa-gold hover:bg-yellow-500 text-desa-dark px-7 py-3 rounded-lg font-bold text-sm uppercase tracking-wider transition-all shadow-lg hover:-translate-y-0.5">
                    Jelajahi Desa
                    
                </a>
                <a href="{{ route('services') }}"
                   class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white border border-white/25 px-7 py-3 rounded-lg font-bold text-sm uppercase tracking-wider transition-all hover:-translate-y-0.5">
                    Layanan Warga
                </a>
            </div>

        </div>
    </div>

 

</section>


<section id="sambutan" class="py-14 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 md:p-10 overflow-hidden relative">
            <div class="grid lg:grid-cols-5 gap-8 items-center relative z-10">

                {{-- FOTO --}}
                <div class="lg:col-span-2 relative">
                    <div class="aspect-[3/4] max-h-80 lg:max-h-96 rounded-2xl overflow-hidden shadow-lg bg-gray-200 mx-auto" style="max-width: 260px;">
                        @if($kepalaDesa && $kepalaDesa->foto)
                            <img src="{{ asset('storage/' . $kepalaDesa->foto) }}"
                                 alt="{{ $kepalaDesa->nama }}"
                                 class="w-full h-full object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=800&q=80"
                                 alt="Kepala Desa"
                                 class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                {{-- KONTEN --}}
                <div class="lg:col-span-3 space-y-4">
                    <div>
                        <span class="text-desa-gold font-bold uppercase tracking-widest text-xs">
                            Pesan Pimpinan
                        </span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-desa-dark mt-1">
                            Sambutan Kepala Desa
                        </h2>
                    </div>

                    {{-- Teks Sambutan --}}
                    <div class="space-y-3 text-gray-600 leading-relaxed text-sm md:text-base">
                        <p class="font-medium text-desa-dark italic text-sm">
                            "Assalamu'alaikum Warahmatullahi Wabarakatuh.
                            Selamat datang di website resmi Desa Banjaran."
                        </p>
                        <p>
                            Website ini hadir sebagai wujud komitmen kami dalam transparansi informasi
                            dan peningkatan kualitas pelayanan publik, sebagai jembatan komunikasi yang efektif
                            antara pemerintah desa dan seluruh masyarakat.
                        </p>
                        <p>
                            Mari bersinergi membangun desa yang kita cintai menuju kemandirian dan kesejahteraan bersama.
                        </p>
                    </div>

                    {{-- IDENTITAS DARI DATABASE --}}
                    <div class="pt-4 border-t border-gray-100">
                        <h4 class="text-base font-bold text-desa-dark">
                            {{ $kepalaDesa->nama ?? 'Nama Kepala Desa' }}
                        </h4>
                       <p class="text-xs text-gray-500 uppercase tracking-wide">
                         Kepala Desa Banjaran
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

{{-- ===== SECTION: VISI & MISI ===== --}}
<section class="py-14 bg-gray-50 pt-0">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">
        
        {{-- VISI --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10 text-center relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-48 h-48 bg-desa-gold/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-2xl font-extrabold mb-3 text-desa-dark">Visi</h2>
                <p class="text-base md:text-lg font-medium text-gray-700 leading-snug">
                    "Mewujudkan Desa Banjaran yang Mandiri, Sejahtera, Berdaya Saing, dan Unggul dalam Pelayanan Publik Melalui Tata Kelola yang Religius."
                </p>
            </div>
        </div>

        {{-- MISI --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            <div class="bg-desa-dark text-white p-8 md:w-1/3 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-desa-gold/10"></div>
                <div class="relative z-10">
                    <h3 class="text-xs font-bold text-desa-gold uppercase tracking-[0.3em] mb-1">Langkah Nyata</h3>
                    <h2 class="text-2xl font-extrabold mb-3">Misi Desa</h2>
                    <p class="text-gray-300 leading-relaxed text-sm">
                        Langkah-langkah strategis yang kami tempuh untuk mencapai visi desa demi kemaslahatan bersama.
                    </p>
                </div>
            </div>

            <div class="p-8 md:w-2/3 bg-white">
                <div class="grid gap-6">
                    <div class="flex gap-4 items-start group">
                        <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-desa-gold font-bold text-base flex-shrink-0 group-hover:bg-desa-gold group-hover:text-white transition-colors">1</div>
                        <div>
                            <h4 class="text-sm font-bold text-desa-dark mb-1">Tata Kelola Pemerintahan</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Meningkatkan kualitas pelayanan administrasi desa yang cepat, ramah, dan transparan berbasis teknologi informasi modern.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start group">
                        <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-desa-gold font-bold text-base flex-shrink-0 group-hover:bg-desa-gold group-hover:text-white transition-colors">2</div>
                        <div>
                            <h4 class="text-sm font-bold text-desa-dark mb-1">Ekonomi & Kesejahteraan</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Memberdayakan potensi ekonomi lokal melalui pengembangan UMKM dan optimalisasi peran BUMDes.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start group">
                        <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-desa-gold font-bold text-base flex-shrink-0 group-hover:bg-desa-gold group-hover:text-white transition-colors">3</div>
                        <div>
                            <h4 class="text-sm font-bold text-desa-dark mb-1">Sosial & Budaya</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Memperkuat nilai-nilai religius, gotong royong, dan melestarikan kearifan lokal dalam kehidupan bermasyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ===== SECTION: INFORMASI TERBARU ===== --}}
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-8">
            <div>
                <span class="text-desa-gold font-bold uppercase tracking-widest text-xs block mb-1">
                    Informasi Terbaru
                </span>
                <h2 class="text-2xl font-extrabold text-desa-dark">
                    Kabar Desa Banjaran
                </h2>
            </div>
            <a href="{{ route('news') }}"
               class="self-start sm:self-auto flex-shrink-0 inline-flex items-center gap-2 px-5 py-2.5 border-2 border-gray-200 rounded-full font-bold text-sm text-gray-600 hover:border-desa-gold hover:text-desa-gold transition-colors group">
                Semua Berita
                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @foreach($latestNews as $news)
            <article class="group bg-white rounded-2xl border border-gray-100 hover:border-gray-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

                {{-- Gambar --}}
                <div class="relative h-44 sm:h-48 overflow-hidden flex-shrink-0 bg-gray-100">
                    @if(!empty($news['image']))
                        <img src="{{ $news['image'] }}"
                             alt="{{ $news['title'] }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/95 backdrop-blur-sm text-desa-dark text-xs font-bold px-2.5 py-1 rounded-md shadow-sm">
                            {{ $news['date'] }}
                        </span>
                    </div>
                </div>

                {{-- Konten --}}
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-sm font-bold text-desa-dark mb-2 line-clamp-2 group-hover:text-desa-gold transition-colors leading-snug">
                        <a href="{{ route('news.show', $news['id']) }}">
                            {{ $news['title'] }}
                        </a>
                    </h3>
                    <p class="text-gray-400 text-xs leading-relaxed line-clamp-3 flex-grow">
                        {{ $news['excerpt'] }}
                    </p>
                    <div class="mt-4 pt-4 border-t border-gray-50">
                        <a href="{{ route('news.show', $news['id']) }}"
                           class="inline-flex items-center gap-1.5 text-xs font-bold text-desa-dark hover:text-desa-gold transition-colors group/link">
                            Baca Selengkapnya
                            <svg class="w-3 h-3 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </article>
            @endforeach
        </div>

    </div>
</section>

{{-- ===== SECTION: PETA LOKASI ===== --}}
<section class="py-14 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="text-center mb-10">
            <span class="text-desa-gold font-bold uppercase tracking-widest text-xs block mb-1">Temukan Kami</span>
            <h2 class="text-2xl font-extrabold text-desa-dark">Lokasi Desa Banjaran</h2>
            <p class="mt-2 text-gray-500 max-w-xl mx-auto text-sm leading-relaxed">
                Desa Banjaran terletak di Kecamatan Bangsri, Kabupaten Jepara, Provinsi Jawa Tengah. 
                Berada sekitar 1,5 km dari pusat Kecamatan Bangsri.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-6 items-stretch">

            {{-- Info Cards --}}
            <div class="flex flex-col gap-4">

                <div class="bg-white rounded-xl border border-gray-100 shadow-md p-5 flex items-start gap-4 hover:shadow-lg transition-shadow">
                    <div class="w-10 h-10 bg-desa-gold/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-desa-dark uppercase tracking-wide mb-1">Alamat</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Desa Banjaran, Kecamatan Bangsri,<br>Kabupaten Jepara, Jawa Tengah 59453</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-md p-5 flex items-start gap-4 hover:shadow-lg transition-shadow">
                    <div class="w-10 h-10 bg-desa-gold/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-desa-dark uppercase tracking-wide mb-1">Telepon</h4>
                        <p class="text-gray-500 text-sm">(0291) 123456</p>
                        <p class="text-gray-400 text-xs mt-0.5">Senin – Jumat, 08.00–15.00 WIB</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-md p-5 flex items-start gap-4 hover:shadow-lg transition-shadow">
                    <div class="w-10 h-10 bg-desa-gold/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-desa-dark uppercase tracking-wide mb-1">Email</h4>
                        <p class="text-gray-500 text-sm">desabanjaran@jepara.go.id</p>
                    </div>
                </div>

                {{-- Tombol Google Maps --}}
                <a href="https://www.google.com/maps/search/Desa+Banjaran+Bangsri+Jepara" 
                   target="_blank" rel="noopener noreferrer"
                   class="mt-auto bg-desa-dark hover:bg-desa-gray text-white font-bold text-sm uppercase tracking-wider px-6 py-3 rounded-xl flex items-center justify-center gap-3 transition-colors shadow-md group">
                    <svg class="w-4 h-4 text-desa-gold group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    Buka di Google Maps
                </a>
            </div>

            {{-- Embed Google Maps --}}
            <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-xl border border-gray-100 min-h-[360px]">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.4!2d110.7168!3d-6.5318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708f5c5c5c5c5b%3A0x1234567890abcdef!2sDesa%20Banjaran%2C%20Bangsri%2C%20Jepara!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                    width="100%" 
                    height="100%" 
                    style="border:0; min-height: 360px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full"
                    title="Peta Lokasi Desa Banjaran">
                </iframe>
            </div>

        </div>
    </div>
</section>
{{-- ===== END SECTION: PETA LOKASI ===== --}}

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slider-image');
        let currentSlide = 0;
        
        setInterval(() => {
            slides[currentSlide].classList.replace('opacity-100', 'opacity-0');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.replace('opacity-0', 'opacity-100');
        }, 5000);
    });
</script>
@endpush