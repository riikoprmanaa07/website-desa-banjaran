@extends('layout.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Statistik dan ringkasan data desa')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card Total Penduduk -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Penduduk</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalPenduduk }}</h3>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card Surat -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Surat Pending</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $suratPending }}</h3>
            </div>
            <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card Berita -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Berita</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalBerita }}</h3>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card Galeri -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Galeri</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalGaleri }}</h3>
            </div>
            <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Surat Chart -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Surat (Bulan Ini)</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Pending</span>
                <div class="flex items-center">
                    <div class="w-48 h-3 bg-gray-200 rounded-full mr-3">
                        <div class="h-3 bg-yellow-500 rounded-full" style="width: {{ $suratStats['pending'] ?? 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold">{{ $suratStats['pending'] ?? 0 }}%</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Diproses</span>
                <div class="flex items-center">
                    <div class="w-48 h-3 bg-gray-200 rounded-full mr-3">
                        <div class="h-3 bg-blue-500 rounded-full" style="width: {{ $suratStats['diproses'] ?? 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold">{{ $suratStats['diproses'] ?? 0 }}%</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Selesai</span>
                <div class="flex items-center">
                    <div class="w-48 h-3 bg-gray-200 rounded-full mr-3">
                        <div class="h-3 bg-green-500 rounded-full" style="width: {{ $suratStats['selesai'] ?? 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold">{{ $suratStats['selesai'] ?? 0 }}%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Penduduk by Gender -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Komposisi Penduduk</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Laki-laki</span>
                <div class="flex items-center">
                    <div class="w-48 h-3 bg-gray-200 rounded-full mr-3">
                        <div class="h-3 bg-blue-500 rounded-full" style="width: {{ $genderStats['L'] ?? 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold">{{ $genderStats['L'] ?? 0 }}%</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Perempuan</span>
                <div class="flex items-center">
                    <div class="w-48 h-3 bg-gray-200 rounded-full mr-3">
                        <div class="h-3 bg-pink-500 rounded-full" style="width: {{ $genderStats['P'] ?? 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold">{{ $genderStats['P'] ?? 0 }}%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Latest Surat -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Surat Terbaru</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($latestSurat as $surat)
            <div class="px-6 py-4 hover:bg-gray-50 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-800">{{ $surat->jenis_surat }}</p>
                        <p class="text-sm text-gray-500">{{ $surat->penduduk->nama }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                        {{ $surat->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $surat->status == 'Diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $surat->status == 'Selesai' ? 'bg-green-100 text-green-800' : '' }}">
                        {{ $surat->status }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500">
                Belum ada data surat
            </div>
            @endforelse
        </div>
    </div>

    <!-- Latest News -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Berita Terbaru</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($latestBerita as $berita)
            <div class="px-6 py-4 hover:bg-gray-50 transition">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">{{ Str::limit($berita->judul, 40) }}</p>
                        <p class="text-sm text-gray-500">{{ $berita->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="ml-4 px-3 py-1 text-xs font-semibold rounded-full 
                        {{ $berita->status == 'Published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $berita->status }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500">
                Belum ada berita
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection