@extends('layout.app')

@section('title', 'Pengajuan Berhasil - Desa Banjaran')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-inter">
    <div class="max-w-lg w-full bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-gray-100 text-center relative overflow-hidden">
        
        {{-- Garis Aksen Emas --}}
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-desa-dark via-desa-gold to-desa-dark"></div>

        {{-- Icon Sukses --}}
        <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-5 ring-4 ring-emerald-50/50">
            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        {{-- Header Teks --}}
        <h1 class="text-2xl font-bold text-desa-dark font-playfair mb-2">Pengajuan Berhasil!</h1>
        <p class="text-gray-500 text-sm mb-6 leading-relaxed">
            Terima kasih, pengajuan surat Anda sedang dalam antrean verifikasi oleh admin Pemerintah Desa Banjaran.
        </p>

        {{-- Detail Pengajuan --}}
        <div class="bg-gray-50 rounded-2xl p-5 mb-5 text-left border border-gray-100">
            <h2 class="text-desa-dark font-semibold text-sm mb-3 border-b border-gray-200 pb-2 uppercase tracking-wider">Detail Surat</h2>
            <table class="w-full text-sm">
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-2.5 text-gray-500 w-1/3">Nama</td>
                        <td class="py-2.5 font-medium text-gray-900">{{ $surat->penduduk->nama }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500">NIK</td>
                        <td class="py-2.5 font-medium text-gray-900">{{ $surat->penduduk->nik }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500">Tanggal Lahir</td>
                        <td class="py-2.5 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($surat->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500">Jenis Surat</td>
                        <td class="py-2.5 font-medium text-gray-900">{{ $surat->jenis_surat }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500">Keperluan</td>
                        <td class="py-2.5 font-medium text-gray-900">{{ $surat->keperluan }}</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 text-gray-500">Status</td>
                        <td class="py-2.5">
                            <span class="px-2.5 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-md border border-amber-100">
                                {{ $surat->status }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Langkah Selanjutnya --}}
        <div class="text-left mb-6 bg-white border border-desa-gold/30 rounded-2xl p-5 shadow-sm">
            <h3 class="font-semibold text-desa-dark text-sm mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Langkah Selanjutnya
            </h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-start gap-3">
                    <span class="bg-desa-dark text-desa-gold rounded-full w-5 h-5 flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">1</span>
                    <span class="leading-relaxed">Admin memverifikasi data dan dokumen pengajuan Anda.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-desa-dark text-desa-gold rounded-full w-5 h-5 flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">2</span>
                    <span class="leading-relaxed">Surat dicetak dan ditandatangani oleh Kepala Desa.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-desa-dark text-desa-gold rounded-full w-5 h-5 flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">3</span>
                    <span class="leading-relaxed">Ambil surat di balai desa dengan membawa <strong class="text-desa-dark">KTP/KK Asli</strong>.</span>
                </li>
            </ul>
        </div>

        {{-- Fitur Cek Surat --}}
        <div class="text-left mb-8 bg-gray-50 rounded-2xl p-5 border border-gray-100">
            <h3 class="font-semibold text-desa-dark text-sm mb-1">Pantau Status Pengajuan</h3>
            <p class="text-xs text-gray-500 mb-3">Gunakan NIK Anda untuk melacak progress surat ini.</p>
            <form action="{{ route('pengajuan.cek') }}" method="GET" class="flex gap-2">
                <input type="text" name="nik" maxlength="16" value="{{ $surat->penduduk->nik }}" required
                    class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-1 focus:ring-desa-gold focus:border-desa-gold" 
                    placeholder="Masukkan NIK...">
                <button type="submit" 
                    class="px-5 py-2.5 bg-desa-dark hover:bg-black text-desa-gold text-sm font-semibold rounded-xl transition-all shadow-sm whitespace-nowrap flex items-center gap-1">
                    Cek Surat
                </button>
            </form>
        </div>

        {{-- Tombol Aksi --}}
        <div class="space-y-3">
            {{-- Tombol WA --}}
            @php
                $nomorWA = config('desa.whatsapp', '6281234567890');
                $pesanWA = urlencode(
                    "Halo Admin Desa Banjaran, saya *{$surat->penduduk->nama}* (NIK: {$surat->penduduk->nik}) baru mengajukan *{$surat->jenis_surat}*. Mohon bantu proses verifikasinya. Terima kasih 剌"
                );
            @endphp
            <a href="https://wa.me/{{ $nomorWA }}?text={{ $pesanWA }}" target="_blank"
               class="flex items-center justify-center gap-2 w-full py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-xl font-medium text-sm transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Konfirmasi via WhatsApp
            </a>

            {{-- Navigasi Bawah --}}
            <div class="flex gap-3 pt-2">
                <a href="{{ route('pengajuan.index') }}"
                   class="flex-1 py-3 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-desa-gold rounded-xl font-semibold text-sm transition-all shadow-sm">
                    Ajukan Lagi
                </a>
                <a href="{{ route('home') }}"
                   class="flex-1 py-3 bg-desa-dark hover:bg-black text-desa-gold rounded-xl font-semibold text-sm transition-all shadow-sm">
                    Ke Beranda
                </a>
            </div>
        </div>

    </div>
</div>
@endsection