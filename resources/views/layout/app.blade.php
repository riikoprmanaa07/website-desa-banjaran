<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Banjaran')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    
                    sans: ['Inter', 'sans-serif'],
                },
                colors: {
                    desa: {
                        gold: '#d4af37',
                        dark: '#0f172a', 
                        gray: '#1e293b',
                    }
                }
            }
        }
    }
</script>

    <style>
        /* CSS Tambahan Kecil */
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="fixed top-0 left-0 w-full z-50 bg-desa-dark/95 backdrop-blur-md border-b border-gray-800 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo Jepara" class="w-12 h-12 object-contain">
                    <div class="flex flex-col">
                        <span class="text-white font-serif text-xl font-bold tracking-wide group-hover:text-desa-gold transition">Desa Banjaran</span>
                        <span class="text-gray-400 text-[10px] uppercase tracking-widest">Kabupaten Jepara</span>
                    </div>
                </a>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-300 hover:text-white transition relative py-2 group">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-desa-gold transition-all duration-300 group-hover:w-full"></span>
                    </a>
                   <div class="relative group">
                        <button class="flex items-center text-sm font-medium text-gray-300 hover:text-white px-4 py-2 rounded-md hover:bg-white/5 transition group-hover:text-desa-gold focus:outline-none">
                            Profil Desa
                            <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div class="absolute left-0 mt-0 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="h-2 w-full"></div> 
                            
                            <div class="bg-desa-dark border border-gray-700 rounded-lg shadow-xl overflow-hidden py-1">
                                <a href="{{ route('history') }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-white/10 hover:text-desa-gold transition">
                                    Sejarah Desa
                                </a>
                                <a href="{{ route('profile') }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-white/10 hover:text-desa-gold transition">
                                    Struktur Desa
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('data') }}" class="text-sm font-medium text-gray-300 hover:text-white transition relative py-2 group">
                        Data Desa
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-desa-gold transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('news') }}" class="text-sm font-medium text-gray-300 hover:text-white transition relative py-2 group">
                        Berita
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-desa-gold transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('galeri') }}" class="text-sm font-medium text-gray-300 hover:text-white transition relative py-2 group">
                        Galeri
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-desa-gold transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('services') }}" class="text-sm font-medium text-gray-300 hover:text-white transition relative py-2 group">
                        Layanan
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-desa-gold transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                   
                    
                    
                   
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-desa-dark border-t border-gray-800">
            <div class="px-4 pt-2 pb-6 space-y-1 shadow-inner">
                <a href="{{ route('home') }}" class="block px-3 py-3 text-base font-medium text-white bg-gray-800 rounded-md">Beranda</a>
                <a href="{{ route('history') }}" class="block px-3 py-3 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">Sejarah Desa</a>
                <a href="{{ route('profile') }}" class="block px-3 py-3 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">Profil Desa</a>
                <a href="{{ route('data') }}" class="block px-3 py-3 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">Data Desa</a>
                <a href="{{ route('news') }}" class="block px-3 py-3 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">Berita</a>
                <a href="{{ route('services') }}" class="block px-3 py-3 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">Layanan</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-0"> 
        @yield('content')
    </main>

    <footer class="bg-desa-dark text-gray-400 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo Jepara" class="w-16 h-16 object-contain">
                        <h3 class="text-2xl font-serif text-white font-bold">Desa Banjaran</h3>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Banjaran adalah sebuah desa di Kecamatan Bangsri, Kabupaten Jepara, Provinsi Jawa Tengah, Indonesia. Letaknya di sebelah timur kecamatan Bangsri, kira-kira 1,5 Km. Dan disebelah utara Kota Jepara.
                    </p>
                    
                </div>

                <div>
                    <h4 class="text-white text-lg font-bold mb-6 uppercase tracking-wider text-xs">Akses Cepat</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-desa-gold transition flex items-center"><span class="mr-2">›</span> Beranda</a></li>
                        <li><a href="{{ route('history') }}" class="hover:text-desa-gold transition flex items-center"><span class="mr-2">›</span> Sejarah Desa</a></li>
                        <li><a href="{{ route('profile') }}" class="hover:text-desa-gold transition flex items-center"><span class="mr-2">›</span> Profil Desa</a></li>
                        <li><a href="{{ route('data') }}" class="hover:text-desa-gold transition flex items-center"><span class="mr-2">›</span> Data Desa</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-desa-gold transition flex items-center"><span class="mr-2">›</span> Layanan Warga</a></li>
                        <li><a href="{{ route('news') }}" class="hover:text-desa-gold transition flex items-center"><span class="mr-2">›</span> Berita</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white text-lg font-bold mb-6 uppercase tracking-wider text-xs">Kontak & Lokasi</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-desa-gold flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            <span class="leading-relaxed">Desa Banjaran, Kec. Bangsri,<br>Kab. Jepara, Jawa Tengah 59453</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-desa-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>(0291) 123456</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-desa-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>desabanjaran@jepara.go.id</span>
                        </li>
                        <li class="pt-2">
                            <a href="https://www.google.com/maps/search/Desa+Banjaran+Bangsri+Jepara" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 text-desa-gold hover:text-yellow-400 transition text-xs font-bold uppercase tracking-wide">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Lihat di Google Maps
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white text-lg font-bold mb-6 uppercase tracking-wider text-xs">Jam Pelayanan</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between border-b border-gray-800 pb-2">
                            <span>Senin - Kamis</span>
                            <span class="text-white">08:00 - 15:00</span>
                        </li>
                        <li class="flex justify-between border-b border-gray-800 pb-2">
                            <span>Jumat</span>
                            <span class="text-white">08:00 - 11:00</span>
                        </li>
                        <li class="flex justify-between border-b border-gray-800 pb-2">
                            <span>Sabtu - Minggu</span>
                            <span class="text-desa-gold">Tutup</span>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>

        <div class="bg-black py-6 border-t border-gray-900">
            <div class="max-w-7xl mx-auto px-4 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Pemerintah Desa Banjaran. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        // Toggle Mobile Menu
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Navbar Effect on Scroll (Opsional: Memberikan efek saat di-scroll)
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
                nav.classList.replace('bg-desa-dark/95', 'bg-desa-dark');
            } else {
                nav.classList.remove('shadow-lg');
                nav.classList.replace('bg-desa-dark', 'bg-desa-dark/95');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>