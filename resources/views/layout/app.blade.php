<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Banjaran')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
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
        /* Custom scrollbar untuk tampilan lebih bersih */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen antialiased selection:bg-desa-gold selection:text-white">

    {{-- ===== NAVBAR ===== --}}
    <nav class="fixed top-0 left-0 w-full z-50 bg-desa-dark/80 backdrop-blur-lg border-b border-gray-800 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo Jepara" class="w-10 h-10 object-contain drop-shadow-md">
                    <div class="flex flex-col">
                        <span class="text-white font-inter text-lg font-semibold tracking-wide group-hover:text-desa-gold transition-colors duration-300 leading-none">Desa Banjaran</span>
                        <span class="text-gray-400 text-[10px] uppercase tracking-[0.2em] mt-0.5">Kab. Jepara</span>
                    </div>
                </a>

                {{-- MENU DESKTOP --}}
                <div class="hidden lg:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-300 hover:text-white transition relative py-2 group">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-desa-gold transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    {{-- DROPDOWN PROFIL DESA --}}
                    <div class="relative group">
                        <button class="flex items-center text-sm font-medium text-gray-300 hover:text-white py-2 transition group-hover:text-desa-gold focus:outline-none">
                            Profil Desa
                            <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-0 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 z-50">
                            <div class="h-3 w-full"></div>
                            <div class="bg-desa-dark/95 backdrop-blur-sm border border-gray-700 rounded-xl shadow-2xl overflow-hidden py-2">
                                <a href="{{ route('history') }}" class="block px-5 py-2.5 text-sm text-gray-300 hover:bg-white/5 hover:text-desa-gold hover:pl-6 transition-all duration-300">
                                    Sejarah Desa
                                </a>
                                <a href="{{ route('profile') }}" class="block px-5 py-2.5 text-sm text-gray-300 hover:bg-white/5 hover:text-desa-gold hover:pl-6 transition-all duration-300">
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

                {{-- HAMBURGER MOBILE --}}
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-300 hover:text-white focus:outline-none p-2 rounded-md hover:bg-white/5 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div id="mobile-menu" class="hidden lg:hidden bg-desa-dark/95 backdrop-blur-xl border-t border-gray-800 absolute w-full shadow-2xl">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-sm font-medium text-white bg-white/10 rounded-lg">Beranda</a>
                
                <div class="px-4 py-2">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Profil Desa</div>
                    <div class="space-y-1 pl-3 border-l-2 border-gray-700">
                        <a href="{{ route('history') }}" class="block px-3 py-2 text-sm font-medium text-gray-300 hover:text-desa-gold transition">Sejarah Desa</a>
                        <a href="{{ route('profile') }}" class="block px-3 py-2 text-sm font-medium text-gray-300 hover:text-desa-gold transition">Struktur Desa</a>
                    </div>
                </div>

                <a href="{{ route('data') }}" class="block px-4 py-3 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white rounded-lg transition">Data Desa</a>
                <a href="{{ route('news') }}" class="block px-4 py-3 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white rounded-lg transition">Berita</a>
                <a href="{{ route('galeri') }}" class="block px-4 py-3 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white rounded-lg transition">Galeri</a>
                <a href="{{ route('services') }}" class="block px-4 py-3 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white rounded-lg transition">Layanan</a>
                
                <div class="pt-4 mt-4 border-t border-gray-800">
                    <a href="{{ route('admin.login') }}" class="block text-center w-full px-4 py-3 text-sm font-medium border border-desa-gold text-desa-gold rounded-lg hover:bg-desa-gold hover:text-desa-dark transition">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow pt-16"> 
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-desa-dark text-gray-400 border-t border-gray-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
                
                {{-- KOLOM 1: IDENTITAS (Lebih Lebar) --}}
                <div class="lg:col-span-4 space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo Jepara" class="w-14 h-14 object-contain">
                        <div>
                            <h3 class="text-xl font-inter text-white font-bold leading-none">Desa Banjaran</h3>
                            <span class="text-xs text-desa-gold uppercase tracking-widest mt-1 block">Kab. Jepara</span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-400 pr-4">
                        Banjaran adalah sebuah desa di Kecamatan Bangsri, Kabupaten Jepara, Provinsi Jawa Tengah. Portal ini hadir untuk memberikan kemudahan informasi dan layanan bagi masyarakat.
                    </p>
                    
                    {{-- Placeholder Sosial Media --}}
                    
                </div>

                {{-- KOLOM 2: AKSES CEPAT --}}
                <div class="lg:col-span-2">
                    <h4 class="text-white font-bold mb-5 uppercase tracking-wider text-sm border-l-2 border-desa-gold pl-3">Akses Cepat</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="group hover:text-desa-gold transition flex items-center gap-2"><span class="transform transition-transform group-hover:translate-x-1">›</span> Beranda</a></li>
                        <li><a href="{{ route('history') }}" class="group hover:text-desa-gold transition flex items-center gap-2"><span class="transform transition-transform group-hover:translate-x-1">›</span> Sejarah Desa</a></li>
                        <li><a href="{{ route('profile') }}" class="group hover:text-desa-gold transition flex items-center gap-2"><span class="transform transition-transform group-hover:translate-x-1">›</span> Struktur Desa</a></li>
                        <li><a href="{{ route('data') }}" class="group hover:text-desa-gold transition flex items-center gap-2"><span class="transform transition-transform group-hover:translate-x-1">›</span> Data Desa</a></li>
                        <li><a href="{{ route('services') }}" class="group hover:text-desa-gold transition flex items-center gap-2"><span class="transform transition-transform group-hover:translate-x-1">›</span> Layanan Warga</a></li>
                    </ul>
                </div>

                {{-- KOLOM 3: KONTAK --}}
                <div class="lg:col-span-3">
                    <h4 class="text-white font-bold mb-5 uppercase tracking-wider text-sm border-l-2 border-desa-gold pl-3">Kontak & Lokasi</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3 group">
                            <div class="p-2 bg-white/5 rounded-lg group-hover:bg-desa-gold/20 transition">
                                <svg class="w-4 h-4 text-desa-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            </div>
                            <span class="leading-relaxed mt-1">Desa Banjaran, Kec. Bangsri,<br>Kab. Jepara, Jawa Tengah 59453</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="p-2 bg-white/5 rounded-lg group-hover:bg-desa-gold/20 transition">
                                <svg class="w-4 h-4 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span>(0291) 123456</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="p-2 bg-white/5 rounded-lg group-hover:bg-desa-gold/20 transition">
                                <svg class="w-4 h-4 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span>desabanjaran@jepara.go.id</span>
                        </li>
                    </ul>
                </div>

                {{-- KOLOM 4: JAM PELAYANAN --}}
                <div class="lg:col-span-3">
                    <h4 class="text-white font-bold mb-5 uppercase tracking-wider text-sm border-l-2 border-desa-gold pl-3">Jam Pelayanan</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between items-center border-b border-gray-800 pb-3">
                            <span class="text-gray-400">Senin – Kamis</span>
                            <span class="text-white font-semibold bg-white/10 px-2 py-1 rounded text-xs">08:00 – 15:00</span>
                        </li>
                        <li class="flex justify-between items-center border-b border-gray-800 pb-3">
                            <span class="text-gray-400">Jumat</span>
                            <span class="text-white font-semibold bg-white/10 px-2 py-1 rounded text-xs">08:00 – 11:00</span>
                        </li>
                        <li class="flex justify-between items-center pb-2">
                            <span class="text-gray-400">Sabtu – Minggu</span>
                            <span class="text-desa-gold font-semibold bg-desa-gold/10 px-2 py-1 rounded text-xs">Tutup</span>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="bg-black/80 py-6 border-t border-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
                <p>© {{ date('Y') }} Pemerintah Desa Banjaran.</p>
                
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

        // Tutup mobile menu saat klik di luar area
        document.addEventListener('click', (event) => {
            if (!btn.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-xl', 'bg-desa-dark/95');
                nav.classList.remove('bg-desa-dark/80');
            } else {
                nav.classList.remove('shadow-xl', 'bg-desa-dark/95');
                nav.classList.add('bg-desa-dark/80');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>