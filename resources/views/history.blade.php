@extends('layout.app')

@section('title', 'Sejarah Desa Banjaran')

@section('content')

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-desa-dark via-desa-gray to-desa-dark pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <div class="inline-block mb-6">
                
            </div>
            
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-6 leading-tight">
                Sejarah <span class="text-desa-gold">Desa Banjaran</span>
            </h1>
            
           
        </div>
    </div>
    
    
</section>

<!-- Intro Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Intro Text -->
        <div class="max-w-4xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-desa-dark mb-8 text-center">
                Sejarah Desa Banjaran
            </h2>
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 border-l-4 border-desa-gold">
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    Desa Banjaran merupakan salah satu desa di Kecamatan Bangsri, Kabupaten Jepara, yang memiliki latar belakang historis yang menarik dan sarat akan nilai budaya lokal. Asal-usul nama "Banjaran" tidak lepas dari legenda rakyat yang telah diwariskan secara turun-temurun oleh masyarakat setempat.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Sebagai bagian dari wilayah pesisir utara Jawa, Desa Banjaran memiliki keterkaitan erat dengan sejarah penyebaran Islam dan perkembangan kerajaan-kerajaan Islam di Jepara, khususnya Kerajaan Kalinyamat yang dipimpin oleh Ratu Kalinyamat.
                </p>
            </div>
        </div>

        <!-- Legenda Section -->
        <div class="max-w-6xl mx-auto mb-16">
            <div class="bg-gradient-to-br from-desa-dark to-desa-gray rounded-2xl shadow-2xl overflow-hidden">
                <div class="p-8 md:p-12">
                    <div class="flex items-center justify-center mb-8">
                        <div class="w-16 h-16 bg-desa-gold rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-3xl font-serif font-bold text-white mb-8 text-center">
                        Asal Usul Nama Banjaran
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                            <div class="flex items-start space-x-4 mb-6">
                                <div class="w-12 h-12 bg-desa-gold/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-desa-gold font-bold text-xl">1</span>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white mb-3">Legenda Lokal</h4>
                                    <p class="text-gray-300 leading-relaxed">
                                        Menurut cerita turun-temurun masyarakat, nama "Banjaran" berasal dari kata dalam bahasa Jawa yang berarti "barisan" atau "deretan". Konon, pada masa lampau, wilayah ini merupakan tempat berkumpulnya para santri dan pejuang yang berbaris dalam deretan untuk menyebarkan ajaran Islam di pesisir utara Jawa.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                            <div class="flex items-start space-x-4 mb-6">
                                <div class="w-12 h-12 bg-desa-gold/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-desa-gold font-bold text-xl">2</span>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white mb-3">Keterkaitan Geografis</h4>
                                    <p class="text-gray-300 leading-relaxed">
                                        Nama Banjaran juga mencerminkan letak geografis desa yang berada dalam satu barisan atau deretan dengan desa-desa lain di Kecamatan Bangsri. Wilayah ini membentang sejajar dengan garis pantai utara, menciptakan pola permukiman yang teratur.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 bg-desa-gold/10 rounded-xl p-6 border-2 border-desa-gold/30">
                        <h4 class="text-xl font-bold text-desa-gold mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Makna Kata "Banjaran"
                        </h4>
                        <p class="text-gray-300 leading-relaxed mb-4">
                            Secara semantik, kata "Banjaran" dalam Bahasa Jawa memiliki beragam makna yang mencerminkan karakteristik desa:
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start text-gray-300">
                                <svg class="w-5 h-5 text-desa-gold mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span><strong class="text-white">Banjaran:</strong> Barisan atau deretan yang tertata rapi</span>
                            </li>
                            <li class="flex items-start text-gray-300">
                                <svg class="w-5 h-5 text-desa-gold mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span><strong class="text-white">Banjaran:</strong> Kelompok masyarakat yang bersatu dalam kebaikan</span>
                            </li>
                            <li class="flex items-start text-gray-300">
                                <svg class="w-5 h-5 text-desa-gold mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span><strong class="text-white">Banjaran:</strong> Rangkaian atau jaringan yang saling terhubung</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-desa-dark mb-6">
            Mari Kenali Lebih Jauh
        </h2>
        <p class="text-lg text-gray-600 mb-10 leading-relaxed">
            Pelajari lebih lanjut tentang struktur organisasi, demografi, dan potensi Desa Banjaran
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('profile') }}" class="inline-flex items-center justify-center px-8 py-4 bg-desa-gold text-white font-semibold rounded-xl hover:bg-yellow-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Struktur Organisasi
            </a>
            <a href="{{ route('data') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-desa-dark font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl border-2 border-gray-200 transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Data & Statistik
            </a>
        </div>
    </div>
</section>

@endsection