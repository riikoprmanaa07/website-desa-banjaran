@extends('layout.app')

@section('title', 'Beranda - Desa Banjaran')

@section('content')

<section class="relative h-[600px] flex items-center overflow-hidden bg-desa-dark">
    <div id="slider-container" class="absolute inset-0 z-0">
        @php
            $sliderImages = [
                'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1920&q=80',
                'images/foto2.jpg'
            ];
        @endphp
        @foreach($sliderImages as $index => $img)
        <div class="slider-image absolute inset-0 bg-cover bg-center transition-opacity duration-1000 {{ $index == 0 ? 'opacity-100' : 'opacity-0' }}" 
             style="background-image: url('{{ $img }}');">
        </div>
        @endforeach
        <div class="absolute inset-0 bg-gradient-to-r from-desa-dark via-desa-dark/70 to-transparent"></div>
    </div>

    <div class="relative z-10 px-4 md:px-20 w-full max-w-7xl mx-auto">
        <div class="max-w-3xl">
            <span class="inline-block px-3 py-1 bg-desa-gold/20 text-desa-gold text-xs font-bold tracking-[0.2em] uppercase mb-6 rounded">Portal Resmi</span>
            <h1 class="text-5xl md:text-6xl text-white font-extrabold mb-6 tracking-tight leading-[1.1]">
                Desa Banjaran <br> <span class="text-desa-gold">Mandiri & Sejahtera.</span>
            </h1>
            <p class="text-lg text-gray-300 mb-10 max-w-xl font-medium leading-relaxed">
                Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan mengutamakan pelayanan prima bagi masyarakat.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#sambutan" class="bg-desa-gold hover:bg-yellow-500 text-desa-dark px-8 py-3 rounded-lg transition-all font-bold text-sm uppercase tracking-wider shadow-lg">
                    Jelajahi Desa
                </a>
                <a href="{{ route('services') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/20 px-8 py-3 rounded-lg transition-all font-bold text-sm uppercase tracking-wider">
                    Layanan
                </a>
            </div>
        </div>
    </div>
</section>

<section id="sambutan" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-12 overflow-hidden relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center relative z-10">
                <div class="relative">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden shadow-lg bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=800&q=80" alt="Kepala Desa" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <span class="text-desa-gold font-bold uppercase tracking-widest text-xs">Pesan Pimpinan</span>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-desa-dark mt-2">Sambutan Kepala Desa</h2>
                    </div>
                    
                    <div class="space-y-4 text-gray-600 leading-relaxed text-base md:text-lg">
                        <p class="font-medium text-desa-dark italic">
                            "Assalamu’alaikum Warahmatullahi Wabarakatuh. Selamat datang di website resmi Desa Banjaran."
                        </p>
                        <p>
                            Website ini hadir sebagai wujud komitmen kami dalam transparansi informasi dan peningkatan kualitas pelayanan publik. Kami berharap platform ini dapat menjadi jembatan komunikasi yang efektif antara pemerintah desa dan seluruh masyarakat.
                        </p>
                        <p>
                            Mari kita bersinergi membangun desa yang kita cintai ini menuju kemandirian dan kesejahteraan bersama.
                        </p>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center gap-4">
                        <div>
                            <h4 class="text-lg font-bold text-desa-dark">Nama Kepala Desa, S.T.</h4>
                            <p class="text-sm text-gray-500 uppercase tracking-wide">Kepala Desa Banjaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50 pt-0">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
        
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-10 md:p-14 text-center relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/5 rounded-full -mr-20 -mt-20 transition-transform group-hover:scale-110"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto">
                
                <h2 class="text-4xl font-extrabold mb-6">Visi</h2>
                <h2 class="text-2xl md:text-2xl font-regular text-desa-dark leading-tight">
                    "Mewujudkan Desa Banjaran yang Mandiri, Sejahtera, Berdaya Saing, dan Unggul dalam Pelayanan Publik Melalui Tata Kelola yang Religius."
                </h2>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            <div class="bg-desa-dark text-white p-10 md:w-1/3 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-desa-gold/10 pattern-dots"></div> <div class="relative z-10">
                    <h3 class="text-sm font-bold text-desa-gold uppercase tracking-[0.3em] mb-2">Langkah Nyata</h3>
                    <h2 class="text-4xl font-extrabold mb-6">Misi Desa</h2>
                    <p class="text-gray-300 leading-relaxed text-sm">
                        Langkah-langkah strategis yang kami tempuh untuk mencapai visi desa demi kemaslahatan bersama.
                    </p>
                </div>
            </div>

            <div class="p-10 md:w-2/3 bg-white">
                <div class="grid gap-8">
                    <div class="flex gap-6 items-start group">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-desa-gold font-bold text-xl flex-shrink-0 group-hover:bg-desa-gold group-hover:text-white transition-colors">1</div>
                        <div>
                            <h4 class="text-lg font-bold text-desa-dark mb-2">Tata Kelola Pemerintahan</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Meningkatkan kualitas pelayanan administrasi desa yang cepat, ramah, dan transparan berbasis teknologi informasi modern.</p>
                        </div>
                    </div>

                    <div class="flex gap-6 items-start group">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-desa-gold font-bold text-xl flex-shrink-0 group-hover:bg-desa-gold group-hover:text-white transition-colors">2</div>
                        <div>
                            <h4 class="text-lg font-bold text-desa-dark mb-2">Ekonomi & Kesejahteraan</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Memberdayakan potensi ekonomi lokal melalui pengembangan UMKM dan optimalisasi peran BUMDes.</p>
                        </div>
                    </div>

                    <div class="flex gap-6 items-start group">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-desa-gold font-bold text-xl flex-shrink-0 group-hover:bg-desa-gold group-hover:text-white transition-colors">3</div>
                        <div>
                            <h4 class="text-lg font-bold text-desa-dark mb-2">Sosial & Budaya</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Memperkuat nilai-nilai religius, gotong royong, dan melestarikan kearifan lokal dalam kehidupan bermasyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <span class="text-desa-gold font-bold uppercase tracking-widest text-xs block mb-2">Informasi Terbaru</span>
                <h2 class="text-3xl font-extrabold text-desa-dark">Kabar Desa Banjaran</h2>
            </div>
            <a href="{{ route('news') }}" class="px-6 py-2 border-2 border-gray-200 rounded-full font-bold text-sm text-gray-600 hover:border-desa-gold hover:text-desa-gold transition-colors">
                Lihat Semua Berita
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestNews as $news)
            <div class="group bg-white rounded-2xl border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $news['image'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-md text-xs font-bold text-desa-dark shadow-sm">
                        {{ $news['date'] }}
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-lg font-bold text-desa-dark mb-3 line-clamp-2 group-hover:text-desa-gold transition-colors">
                        <a href="{{ route('news.show', $news['id']) }}">{{ $news['title'] }}</a>
                    </h3>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-3 leading-relaxed flex-grow">{{ $news['excerpt'] }}</p>
                    <a href="{{ route('news.show', $news['id']) }}" class="inline-flex items-center text-desa-dark font-bold text-sm mt-auto group-hover:translate-x-1 transition-transform">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slider-image');
        let currentSlide = 0;
        
        // Animasi Slider Sederhana
        setInterval(() => {
            slides[currentSlide].classList.replace('opacity-100', 'opacity-0');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.replace('opacity-0', 'opacity-100');
        }, 5000);
    });
</script>
@endpush