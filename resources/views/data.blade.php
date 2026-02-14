@extends('layout.app')

@section('title', 'Data Desa - Desa Banjaran')

@section('content')
<!-- Page Header -->
<section class="relative bg-gradient-to-br from-desa-dark via-desa-gray to-desa-dark py-24 mt-20">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-serif">Data Desa Banjaran</h1>
        <p class="text-xl text-gray-300">Informasi lengkap data kependudukan dan potensi desa</p>
    </div>
</section>

<!-- Data Desa Content -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-desa-gold hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Penduduk</p>
                        <h3 class="text-3xl font-bold text-desa-dark mt-1">{{ number_format($demografi['total_penduduk']) }}</h3>
                    </div>
                    <div class="bg-desa-gold/10 rounded-full p-4">
                        <svg class="w-8 h-8 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-blue-500 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Laki-laki</p>
                        <h3 class="text-3xl font-bold text-desa-dark mt-1">{{ number_format($demografi['laki_laki']) }}</h3>
                    </div>
                    <div class="bg-blue-50 rounded-full p-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-pink-500 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Perempuan</p>
                        <h3 class="text-3xl font-bold text-desa-dark mt-1">{{ number_format($demografi['perempuan']) }}</h3>
                    </div>
                    <div class="bg-pink-50 rounded-full p-4">
                        <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-green-500 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Kepala Keluarga</p>
                        <h3 class="text-3xl font-bold text-desa-dark mt-1">{{ number_format($demografi['kepala_keluarga']) }}</h3>
                    </div>
                    <div class="bg-green-50 rounded-full p-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Demografi -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">📊 Data Demografi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-gray-50 to-white p-5 rounded-lg border-l-4 border-desa-gold">
                    <p class="text-gray-600 font-medium">Total Penduduk</p>
                    <p class="text-2xl font-bold text-desa-dark">{{ number_format($demografi['total_penduduk']) }} jiwa</p>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-5 rounded-lg border-l-4 border-blue-500">
                    <p class="text-gray-600 font-medium">Laki-laki</p>
                    <p class="text-2xl font-bold text-desa-dark">{{ number_format($demografi['laki_laki']) }} jiwa</p>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-5 rounded-lg border-l-4 border-pink-500">
                    <p class="text-gray-600 font-medium">Perempuan</p>
                    <p class="text-2xl font-bold text-desa-dark">{{ number_format($demografi['perempuan']) }} jiwa</p>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-5 rounded-lg border-l-4 border-green-500">
                    <p class="text-gray-600 font-medium">Kepala Keluarga</p>
                    <p class="text-2xl font-bold text-desa-dark">{{ number_format($demografi['kepala_keluarga']) }} KK</p>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-5 rounded-lg border-l-4 border-purple-500">
                    <p class="text-gray-600 font-medium">Kepadatan Penduduk</p>
                    <p class="text-2xl font-bold text-desa-dark">{{ $demografi['kepadatan'] }}</p>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-5 rounded-lg border-l-4 border-orange-500">
                    <p class="text-gray-600 font-medium">Rasio Jenis Kelamin</p>
                    <p class="text-2xl font-bold text-desa-dark">{{ number_format(($demografi['laki_laki'] / $demografi['perempuan']) * 100, 1) }}</p>
                </div>
            </div>
        </div>

        <!-- Data Usia -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">👶 Data Penduduk Berdasarkan Usia</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-desa-dark">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kelompok Usia</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Laki-laki</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Perempuan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Persentase</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($usia as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['range'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ number_format($item['laki']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ number_format($item['perempuan']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-desa-dark">{{ number_format($item['total']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 max-w-xs">
                                        <div class="bg-desa-gold rounded-full h-2 transition-all duration-500" style="width: {{ ($item['total'] / $demografi['total_penduduk']) * 100 }}%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">{{ number_format(($item['total'] / $demografi['total_penduduk']) * 100, 1) }}%</span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Data Pendidikan -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">🎓 Data Pendidikan</h2>
            <div class="space-y-4">
                @foreach($pendidikan as $item)
                <div class="border-l-4 border-blue-500 bg-gray-50 p-4 rounded-r-lg hover:shadow-md transition">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-gray-800">{{ $item['tingkat'] }}</span>
                        <span class="text-sm font-bold text-blue-600">{{ number_format($item['jumlah']) }} orang</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex-1 bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-400 rounded-full h-3 transition-all duration-500" style="width: {{ $item['persentase'] * 4 }}%"></div>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 w-12">{{ $item['persentase'] }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Data Pekerjaan -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">💼 Data Mata Pencaharian</h2>
            <div class="space-y-4">
                @foreach($pekerjaan as $item)
                <div class="border-l-4 border-green-500 bg-gray-50 p-4 rounded-r-lg hover:shadow-md transition">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-gray-800">{{ $item['jenis'] }}</span>
                        <span class="text-sm font-bold text-green-600">{{ number_format($item['jumlah']) }} orang</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex-1 bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-500 to-green-400 rounded-full h-3 transition-all duration-500" style="width: {{ $item['persentase'] * 3.5 }}%"></div>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 w-12">{{ $item['persentase'] }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Data Agama & Perkawinan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Data Agama -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">🕌 Data Agama</h2>
                <div class="space-y-4">
                    @foreach($agama as $item)
                    <div class="bg-gray-50 p-4 rounded-lg hover:shadow-md transition">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-gray-800">{{ $item['nama'] }}</span>
                            <span class="text-sm font-bold text-desa-gold">{{ number_format($item['jumlah']) }} ({{ $item['persentase'] }}%)</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-3">
                            <div class="bg-desa-gold rounded-full h-3 transition-all duration-500" style="width: {{ $item['persentase'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Data Perkawinan -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">💑 Data Status Perkawinan</h2>
                <div class="space-y-4">
                    @foreach($perkawinan as $item)
                    <div class="bg-gray-50 p-4 rounded-lg hover:shadow-md transition">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-gray-800">{{ $item['status'] }}</span>
                            <span class="text-sm font-bold text-purple-600">{{ number_format($item['jumlah']) }} ({{ $item['persentase'] }}%)</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-400 rounded-full h-3 transition-all duration-500" style="width: {{ $item['persentase'] * 1.8 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Fasilitas Umum -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">🏢 Fasilitas Umum</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pendidikan -->
                <div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-lg border border-blue-100">
                    <h3 class="text-lg font-bold text-blue-600 mb-4 flex items-center">
                        <span class="mr-2">🎓</span> Pendidikan
                    </h3>
                    @foreach($fasilitas['pendidikan'] as $item)
                    <div class="flex justify-between items-center py-2 border-b border-blue-100 last:border-0">
                        <span class="text-gray-700 text-sm">{{ $item['nama'] }}</span>
                        <span class="font-bold text-blue-600 bg-blue-100 px-3 py-1 rounded-full text-xs">{{ $item['jumlah'] }}</span>
                    </div>
                    @endforeach
                </div>

                <!-- Kesehatan -->
                <div class="bg-gradient-to-br from-green-50 to-white p-6 rounded-lg border border-green-100">
                    <h3 class="text-lg font-bold text-green-600 mb-4 flex items-center">
                        <span class="mr-2">🏥</span> Kesehatan
                    </h3>
                    @foreach($fasilitas['kesehatan'] as $item)
                    <div class="flex justify-between items-center py-2 border-b border-green-100 last:border-0">
                        <span class="text-gray-700 text-sm">{{ $item['nama'] }}</span>
                        <span class="font-bold text-green-600 bg-green-100 px-3 py-1 rounded-full text-xs">{{ $item['jumlah'] }}</span>
                    </div>
                    @endforeach
                </div>

                <!-- Peribadatan -->
                <div class="bg-gradient-to-br from-purple-50 to-white p-6 rounded-lg border border-purple-100">
                    <h3 class="text-lg font-bold text-purple-600 mb-4 flex items-center">
                        <span class="mr-2">🕌</span> Peribadatan
                    </h3>
                    @foreach($fasilitas['peribadatan'] as $item)
                    <div class="flex justify-between items-center py-2 border-b border-purple-100 last:border-0">
                        <span class="text-gray-700 text-sm">{{ $item['nama'] }}</span>
                        <span class="font-bold text-purple-600 bg-purple-100 px-3 py-1 rounded-full text-xs">{{ $item['jumlah'] }}</span>
                    </div>
                    @endforeach
                </div>

                <!-- Ekonomi -->
                <div class="bg-gradient-to-br from-orange-50 to-white p-6 rounded-lg border border-orange-100">
                    <h3 class="text-lg font-bold text-orange-600 mb-4 flex items-center">
                        <span class="mr-2">🏪</span> Ekonomi
                    </h3>
                    @foreach($fasilitas['ekonomi'] as $item)
                    <div class="flex justify-between items-center py-2 border-b border-orange-100 last:border-0">
                        <span class="text-gray-700 text-sm">{{ $item['nama'] }}</span>
                        <span class="font-bold text-orange-600 bg-orange-100 px-3 py-1 rounded-full text-xs">{{ $item['jumlah'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Potensi Desa -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-desa-dark mb-6 pb-4 border-b-2 border-desa-gold font-serif">🌾 Potensi Desa</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Pertanian -->
                <div class="bg-gradient-to-br from-green-50 to-white p-6 rounded-lg border border-green-100">
                    <h3 class="text-lg font-bold text-green-600 mb-4">🌾 Pertanian</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-green-100">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-green-700">Komoditas</th>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-green-700">Luas</th>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-green-700">Produksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100">
                                @foreach($potensi['pertanian'] as $item)
                                <tr class="hover:bg-green-50">
                                    <td class="px-3 py-2 text-gray-700">{{ $item['komoditas'] }}</td>
                                    <td class="px-3 py-2 text-gray-600">{{ $item['luas'] }}</td>
                                    <td class="px-3 py-2 text-gray-600">{{ $item['produksi'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Perkebunan -->
                <div class="bg-gradient-to-br from-yellow-50 to-white p-6 rounded-lg border border-yellow-100">
                    <h3 class="text-lg font-bold text-yellow-600 mb-4">🌴 Perkebunan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-yellow-100">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-yellow-700">Komoditas</th>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-yellow-700">Luas</th>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-yellow-700">Produksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-yellow-100">
                                @foreach($potensi['perkebunan'] as $item)
                                <tr class="hover:bg-yellow-50">
                                    <td class="px-3 py-2 text-gray-700">{{ $item['komoditas'] }}</td>
                                    <td class="px-3 py-2 text-gray-600">{{ $item['luas'] }}</td>
                                    <td class="px-3 py-2 text-gray-600">{{ $item['produksi'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Peternakan -->
                <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-lg border border-red-100">
                    <h3 class="text-lg font-bold text-red-600 mb-4">🐄 Peternakan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-red-100">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-red-700">Jenis Ternak</th>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-red-700">Populasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-100">
                                @foreach($potensi['peternakan'] as $item)
                                <tr class="hover:bg-red-50">
                                    <td class="px-3 py-2 text-gray-700">{{ $item['jenis'] }}</td>
                                    <td class="px-3 py-2 text-gray-600">{{ $item['populasi'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Note -->
        <div class="bg-gradient-to-r from-desa-gold/10 to-yellow-50 border-l-4 border-desa-gold rounded-r-lg p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-desa-gold mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold text-gray-800 mb-1">Catatan Penting</p>
                    <p class="text-gray-700 text-sm leading-relaxed">Data yang ditampilkan adalah data tahun 2026. Untuk informasi lebih detail atau data terkini, silakan hubungi kantor desa atau kunjungi langsung.</p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection