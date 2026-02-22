@extends('layout.app')

@section('title', 'Pengajuan Berhasil')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-lg w-full">

        {{-- Icon Sukses --}}
        <div class="text-center mb-6">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Pengajuan Berhasil Dikirim!</h1>
            <p class="text-gray-500 mt-2">Pengajuan surat Anda telah diterima dan sedang menunggu verifikasi admin.</p>
        </div>

        {{-- Card Info Pengajuan --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="bg-green-600 px-6 py-4">
                <h2 class="text-white font-semibold text-lg">Detail Pengajuan</h2>
            </div>
            <div class="p-6 space-y-4">
                <table class="w-full text-sm">
                    <tr class="border-b">
                        <td class="py-2 text-gray-500 w-40">Nama</td>
                        <td class="py-2 font-medium text-gray-800">{{ $surat->penduduk->nama }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-500">NIK</td>
                        <td class="py-2 font-medium text-gray-800">{{ $surat->penduduk->nik }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-500">Jenis Surat</td>
                        <td class="py-2 font-medium text-gray-800">{{ $surat->jenis_surat }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-500">Keperluan</td>
                        <td class="py-2 font-medium text-gray-800">{{ $surat->keperluan }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-500">Tanggal Pengajuan</td>
                        <td class="py-2 font-medium text-gray-800">{{ $surat->created_at->format('d F Y, H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-500">Status</td>
                        <td class="py-2">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                {{ $surat->status }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Info Langkah Selanjutnya --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
            <h3 class="font-semibold text-blue-800 mb-3">📋 Langkah Selanjutnya</h3>
            <ol class="space-y-2 text-sm text-blue-700">
                <li class="flex items-start gap-2">
                    <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">1</span>
                    <span>Admin desa akan memverifikasi data pengajuan Anda.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">2</span>
                    <span>Jika disetujui, surat akan disiapkan oleh pihak desa.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">3</span>
                    <span>Datang ke kantor desa untuk mengambil surat dengan membawa KTP asli.</span>
                </li>
            </ol>
        </div>

        {{-- Cek Status via NIK --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 mb-6">
            <h3 class="font-semibold text-gray-800 mb-1">🔍 Cek Status Pengajuan</h3>
            <p class="text-xs text-gray-500 mb-4">Gunakan NIK KTP untuk mengecek status pengajuan kapan saja.</p>
            <form action="{{ route('pengajuan.cek') }}" method="GET" class="flex gap-2">
                <input type="text" name="nik" maxlength="16"
                    value="{{ $surat->penduduk->nik }}"
                    placeholder="Masukkan NIK"
                    class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold">
                <button type="submit"
                    class="px-4 py-2.5 bg-desa-dark hover:bg-desa-gray text-white font-semibold text-sm rounded-lg transition">
                    Cek
                </button>
            </form>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3">
            <a href="{{ route('pengajuan.index') }}"
               class="flex-1 text-center px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition">
                Ajukan Surat Lagi
            </a>
            <a href="{{ route('home') }}"
               class="flex-1 text-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>
@endsection