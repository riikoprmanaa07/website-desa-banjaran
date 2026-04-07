@extends('layout.app')

@section('title', 'Sejarah Desa Banjaran')

@section('content')

<section class="relative text-white pt-32 pb-20 overflow-hidden">
    {{-- Latar Belakang Gambar & Overlay --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/sejarah.png') }}');"></div>
        <div class="absolute inset-0 bg-desa-dark/75"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center" data-aos="zoom-in" data-aos-duration="1000">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg text-white">Sejarah Desa Banjaran</h1>
        <p class="text-gray-200 text-base max-w-xl mx-auto drop-shadow-md">
             Mengenal asal-usul, legenda tokoh Ki Banjar, dan perjalanan historis wilayah
        </p>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Kolom Kiri: Penjelasan Utama (Lebih Lebar) --}}
            <div class="md:col-span-2 space-y-8">
                <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-desa-dark mb-5 flex items-center">
                        <span class="w-8 h-1 bg-desa-gold mr-3 rounded-full"></span>
                        Latar Belakang Historis
                    </h2>
                    <div class="leading-relaxed text-gray-700 space-y-4">
                        <p>
                            Desa Banjaran merupakan salah satu desa di Kecamatan Bangsri, Kabupaten Jepara, 
                            yang memiliki latar belakang historis yang menarik dan sarat akan nilai budaya lokal. 
                            Asal-usul nama "Banjaran" tidak lepas dari legenda rakyat yang telah diwariskan 
                            secara turun-temurun oleh masyarakat setempat.
                        </p>
                        <p>
                            Sebagai bagian dari wilayah pesisir utara Jawa, Desa Banjaran memiliki keterkaitan erat 
                            dengan sejarah penyebaran Islam dan perkembangan kerajaan-kerajaan Islam di Jepara, 
                            khususnya Kerajaan Kalinyamat yang dipimpin oleh <strong>Ratu Kalinyamat</strong>.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-desa-dark mb-5 flex items-center">
                        <span class="w-8 h-1 bg-desa-gold mr-3 rounded-full"></span>
                        Etimologi & Tokoh Ki Banjar
                    </h2>
                    <div class="leading-relaxed text-gray-700">
                        <p class="mb-4">
                            Menurut sejarah lisan, nama <strong>Banjaran</strong> berasal dari tokoh legendaris bernama <strong>Ki Banjar</strong>. 
                            Dikisahkan bahwa Ki Banjar menjadi korban dalam konflik melawan Surogotho, seorang tokoh yang berambisi 
                            mempersunting keponakannya sendiri, Dewi Wiji.
                        </p>
                        <p>
                            Dewi Wiji yang merupakan putri dari Ki Gede Bangsri merasa terancam dan mencari perlindungan 
                            kepada tokoh-tokoh sakti di sekitar wilayah Bangsri, di mana salah satunya adalah Ki Banjar. 
                            Pengorbanan dan keberadaan Ki Banjar inilah yang kemudian diabadikan menjadi nama desa.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Informasi Tambahan/Sidebar --}}
            <div class="space-y-6">
                <div class="bg-desa-dark text-white rounded-xl p-6 shadow-lg" data-aos="fade-left">
                    <h3 class="text-lg font-bold mb-4 text-desa-gold">Warisan Budaya</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-start">
                            <span class="mr-2 text-desa-gold">•</span>
                            Nilai gotong royong masyarakat pesisir.
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2 text-desa-gold">•</span>
                            Tradisi lisan yang masih terjaga.
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2 text-desa-gold">•</span>
                            Keterikatan sejarah dengan Ratu Kalinyamat.
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm" data-aos="fade-left" data-aos-delay="200">
                    <h3 class="text-lg font-bold mb-2 text-desa-dark">Lokasi Desa</h3>
                    <p class="text-sm text-gray-600 mb-4">Kecamatan Bangsri, Kabupaten Jepara, Jawa Tengah.</p>
                    <a href="{{ route('data') }}" class="text-desa-gold font-semibold text-sm hover:underline">
                        Lihat Profil Wilayah &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-white border-t">
    <div class="max-w-4xl mx-auto px-6 text-center" data-aos="zoom-in">
        <h2 class="text-2xl font-bold text-desa-dark mb-6">Informasi Lebih Lanjut</h2>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('profile') }}"
               class="px-8 py-3 bg-desa-gold text-white rounded-lg font-semibold hover:bg-yellow-600 transition shadow-md">
                Struktur Organisasi
            </a>
            <a href="{{ route('data') }}"
               class="px-8 py-3 border border-desa-dark text-desa-dark rounded-lg font-semibold hover:bg-desa-dark hover:text-white transition">
                Data & Statistik
            </a>
        </div>
    </div>
</section>

@endsection