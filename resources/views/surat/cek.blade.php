@extends('layout.app')

@section('title', 'Cek Status Pengajuan - Desa Banjaran')

@section('content')

{{-- Hero Section --}}
<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-desa-gold/5 rounded-full -ml-12 -mb-12 blur-2xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Cek Status Pengajuan</h1>
        <p class="text-gray-400 text-base max-w-xl mx-auto">
             Masukkan NIK KTP dan Tanggal Lahir Anda untuk melihat riwayat serta status pengajuan surat.
        </p>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">

        {{-- Form Cek NIK & Tanggal Lahir --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Masukkan Data Identitas</h2>

            @if($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4">
                @foreach($errors->all() as $error)
                    <p class="text-sm text-red-600">⚠ {{ $error }}</p>
                @endforeach
            </div>
            @endif

            {{-- Form Pencarian --}}
            <form action="{{ route('pengajuan.cek') }}" method="GET" class="space-y-4">
                
                {{-- Baris 1: NIK & Tanggal Lahir --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Input NIK --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5 ml-1">NIK KTP <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                                </svg>
                            </div>
                            <input type="text" name="nik" maxlength="16"
                                inputmode="numeric" pattern="[0-9]*"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                value="{{ request('nik') }}"
                                placeholder="Masukkan 16 digit NIK"
                                class="w-full pl-12 pr-4 py-3 border border-gray-200 bg-gray-50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition"
                                required>
                        </div>
                    </div>

                    {{-- Input Tanggal Lahir (BARU) --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5 ml-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="date" name="tanggal_lahir"
                                value="{{ request('tanggal_lahir') }}"
                                class="w-full pl-12 pr-4 py-3 border border-gray-200 bg-gray-50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition"
                                required>
                        </div>
                    </div>
                </div>

                {{-- Baris 2: Filter Jenis Surat & Tombol --}}
                <div class="flex flex-col md:flex-row gap-4 pt-1">
                    {{-- Filter Jenis Surat --}}
                    <div class="relative flex-1">
                        <select name="jenis_surat" class="w-full pl-4 pr-10 py-3 border border-gray-200 bg-gray-50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition appearance-none cursor-pointer">
                            <option value="">Semua Jenis Surat</option>
                            @if(isset($templates))
                                @foreach($templates as $t)
                                    <option value="{{ $t->nama_template }}" {{ request('jenis_surat') == $t->nama_template ? 'selected' : '' }}>
                                        {{ $t->nama_template }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit"
                        class="px-8 py-3 bg-desa-dark hover:bg-black text-desa-gold font-bold rounded-xl transition-all duration-200 text-sm whitespace-nowrap shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cek Status
                    </button>
                </div>
            </form>
        </div>

        {{-- Hasil Pencarian --}}
        @isset($penduduk)

            {{-- Info Warga --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-desa-dark to-desa-gray px-6 py-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-white font-bold text-lg">{{ $penduduk->nama }}</h3>
                        <p class="text-gray-400 text-sm">NIK: {{ $penduduk->nik }}</p>
                    </div>
                    <div class="w-12 h-12 bg-desa-gold/20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Riwayat Pengajuan --}}
            @if($riwayat->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Data Pengajuan Surat Tidak Ditemukan</p>
                    <p class="text-gray-400 text-sm mt-1">Silakan melakukan pengajuan surat terlebih dahulu.</p>
                </div>
            @else
                <div class="space-y-4">
                    <p class="text-sm text-gray-500 font-medium">
                        Ditemukan <strong class="text-gray-800">{{ $riwayat->count() }} pengajuan</strong> untuk identitas ini.
                    </p>

                    @foreach($riwayat as $item)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-4">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-base">{{ $item->jenis_surat }}</h4>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        Diajukan: {{ $item->created_at->format('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                                {{-- Badge Status --}}
                                <span class="inline-flex w-fit items-center px-3 py-1 text-xs font-bold rounded-full
                                    {{ $item->status === 'Selesai'  ? 'bg-green-100 text-green-700'  : '' }}
                                    {{ $item->status === 'Ditolak'  ? 'bg-red-100 text-red-700'      : '' }}
                                    {{ $item->status === 'Diproses' ? 'bg-blue-100 text-blue-700'    : '' }}
                                    {{ $item->status === 'Pending'  ? 'bg-yellow-100 text-yellow-700': '' }}">
                                    {{ $item->status === 'Selesai'  ? '✅ Selesai'  : '' }}
                                    {{ $item->status === 'Ditolak'  ? '❌ Ditolak'  : '' }}
                                    {{ $item->status === 'Diproses' ? '⚙️ Diproses' : '' }}
                                    {{ $item->status === 'Pending'  ? '⏳ Pending'  : '' }}
                                </span>
                            </div>

                            {{-- Detail --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                                <div>
                                    <p class="text-gray-400 text-xs">Keperluan</p>
                                    <p class="text-gray-700 font-medium">{{ $item->keperluan }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Tanggal Surat</p>
                                    <p class="text-gray-700 font-medium">{{ $item->tanggal_surat->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Alamat</p>
                                    <p class="text-gray-700 font-medium">{{ $penduduk->alamat }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Nomor Surat / Referensi</p>
                                    <p class="text-gray-700 font-medium">{{ $item->nomor_surat }}</p>
                                </div>
                            </div>

                            {{-- Keterangan jika ditolak --}}
                            @if($item->status === 'Ditolak' && $item->keterangan)
                            <div class="mt-4 bg-red-50 border border-red-100 rounded-lg px-4 py-3">
                                <p class="text-xs text-red-500 font-semibold mb-1">Alasan Penolakan:</p>
                                <p class="text-sm text-red-700">{{ $item->keterangan }}</p>
                            </div>
                            @endif

                            {{-- Info jika selesai --}}
                            @if($item->status === 'Selesai')
                            <div class="mt-4 bg-green-50 border border-green-100 rounded-lg px-4 py-3">
                                <p class="text-sm text-green-700">
                                    🎉 Surat Anda sudah selesai diproses. Silakan datang ke kantor desa dengan membawa <strong>KTP dan KK Asli</strong> untuk mengambil surat.
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

        @endisset

        {{-- Tombol Ajukan Surat --}}
        <div class="mt-8 text-center">
            <a href="{{ route('pengajuan.index') }}"
               class="inline-flex items-center gap-2 bg-desa-gold hover:bg-yellow-500 text-desa-dark font-bold px-6 py-3 rounded-xl transition-all duration-200 text-sm shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Ajukan Surat Baru
            </a>
        </div>

    </div>
</section>

@endsection