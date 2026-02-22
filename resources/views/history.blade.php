@extends('layout.app')

@section('title', 'Sejarah Desa Banjaran')

@section('content')

<!-- Hero Section -->
<section class="bg-desa-dark py-28 mt-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white font-serif mb-4">
            Sejarah Desa Banjaran
        </h1>
        <p class="text-gray-300 text-lg">
            Mengenal asal-usul dan perjalanan sejarah Desa Banjaran
        </p>
    </div>
</section>


<!-- Content Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 space-y-16">

        <!-- Penjelasan -->
        <div>
            <h2 class="text-3xl font-bold text-desa-dark mb-6 text-center font-serif">
                Penjelasan
            </h2>

            <div class="bg-white rounded-xl shadow-md p-8 leading-relaxed text-gray-700 text-lg">
                <p class="mb-6">
                    Desa Banjaran merupakan salah satu desa di Kecamatan Bangsri, Kabupaten Jepara, 
                    yang memiliki latar belakang historis yang menarik dan sarat akan nilai budaya lokal. 
                    Asal-usul nama "Banjaran" tidak lepas dari legenda rakyat yang telah diwariskan 
                    secara turun-temurun oleh masyarakat setempat.
                </p>

                <p>
                    Sebagai bagian dari wilayah pesisir utara Jawa, Desa Banjaran memiliki keterkaitan erat 
                    dengan sejarah penyebaran Islam dan perkembangan kerajaan-kerajaan Islam di Jepara, 
                    khususnya Kerajaan Kalinyamat yang dipimpin oleh Ratu Kalinyamat.
                </p>
            </div>
        </div>


        <!-- Etimologi -->
        <div>
            <h2 class="text-3xl font-bold text-desa-dark mb-6 text-center font-serif">
                Etimologi
            </h2>

            <div class="bg-white rounded-xl shadow-md p-8 leading-relaxed text-gray-700 text-lg">
                <p>
                    Menurut sejarah, nama Banjaran berasal dari tokoh yang bernama Ki Banjar 
                    yang dibunuh oleh Surogotho. Surogotho adalah tokoh yang hendak mempersunting 
                    keponakannya yang bernama Dewi Wiji, putri Ki Gede Bangsri. Karena takut akan 
                    ancaman pamannya, Dewi Wiji mencari perlindungan kepada tokoh-tokoh di sekitar 
                    wilayah kekuasaan Ki Gede Bangsri, salah satunya adalah Ki Banjar.
                </p>
            </div>
        </div>

    </div>
</section>


<!-- CTA Section -->
<section class="py-20 bg-white border-t">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-desa-dark mb-4 font-serif">
            Mari Kenali Lebih Jauh
        </h2>

        <p class="text-gray-600 mb-10">
            Pelajari lebih lanjut tentang struktur organisasi, demografi, dan potensi Desa Banjaran
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('profile') }}"
               class="px-8 py-3 bg-desa-gold text-white rounded-lg font-semibold hover:bg-yellow-600 transition">
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