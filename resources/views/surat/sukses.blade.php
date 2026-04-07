@extends('layout.app')

@section('title', 'Pengajuan Berhasil - Desa Banjaran')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-inter">
    <div class="max-w-lg w-full bg-white p-8 sm:p-10 rounded-3xl shadow-lg border border-gray-100 text-center relative overflow-hidden">
        
        {{-- Garis Aksen Emas --}}
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-desa-dark via-desa-gold to-desa-dark"></div>

        {{-- Icon Sukses --}}
        <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 ring-8 ring-emerald-50/50 animate-bounce-short">
            <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        {{-- Header Teks --}}
        <h1 class="text-3xl font-extrabold text-desa-dark font-playfair mb-3">Pengajuan Berhasil!</h1>
        <p class="text-gray-500 text-sm mb-8 leading-relaxed px-2">
            Terima kasih, pengajuan surat Anda telah masuk ke dalam sistem dan sedang dalam antrean verifikasi oleh Pemerintah Desa Banjaran.
        </p>

        {{-- Detail Pengajuan (Berubah dari Tabel menjadi bergaya Tiket/Struk agar rapi di HP) --}}
        <div class="bg-gray-50 rounded-2xl p-6 mb-6 text-left border border-gray-200 shadow-inner">
            <h2 class="text-desa-dark font-bold text-sm mb-4 border-b border-gray-200 pb-3 flex items-center justify-between">
                <span class="uppercase tracking-wider">Detail Surat</span>
                <span class="text-xs font-medium px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg border border-amber-200">
                    {{ $surat->status }}
                </span>
            </h2>
            
            <div class="space-y-3">
                {{-- Tambahan: Tampilkan Nomor Referensi / Nomor Surat --}}
                <div class="flex justify-between items-center sm:items-start gap-4">
                    <span class="text-gray-500 text-sm shrink-0">No. Referensi</span>
                    <span class="font-bold text-desa-dark text-sm text-right bg-white px-2 py-1 border border-gray-200 rounded-md">
                        {{ $surat->nomor_surat }}
                    </span>
                </div>
                
                <div class="flex justify-between items-start gap-4">
                    <span class="text-gray-500 text-sm shrink-0">Nama Pemohon</span>
                    <span class="font-semibold text-gray-900 text-sm text-right">{{ $surat->penduduk->nama }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                    <span class="text-gray-500 text-sm shrink-0">NIK</span>
                    <span class="font-semibold text-gray-900 text-sm text-right">{{ $surat->penduduk->nik }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                    <span class="text-gray-500 text-sm shrink-0">Jenis Surat</span>
                    <span class="font-semibold text-gray-900 text-sm text-right">{{ $surat->jenis_surat }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                    <span class="text-gray-500 text-sm shrink-0">Keperluan</span>
                    <span class="font-medium text-gray-800 text-sm text-right italic break-words line-clamp-2">"{{ $surat->keperluan }}"</span>
                </div>
            </div>
        </div>

        {{-- Langkah Selanjutnya --}}
        <div class="text-left mb-8 bg-white border border-desa-gold/40 rounded-2xl p-5 shadow-sm">
            <h3 class="font-bold text-desa-dark text-sm mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Langkah Selanjutnya
            </h3>
            <ul class="space-y-4 text-sm text-gray-600">
                <li class="flex items-start gap-3">
                    <span class="bg-desa-dark text-desa-gold rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5 shadow-sm">1</span>
                    <span class="leading-relaxed">Admin akan memverifikasi data dan dokumen persyaratan Anda (1-2 hari kerja).</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-desa-dark text-desa-gold rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5 shadow-sm">2</span>
                    <span class="leading-relaxed">Surat akan dicetak dan ditandatangani oleh Kepala Desa secara resmi.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-desa-dark text-desa-gold rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5 shadow-sm">3</span>
                    <span class="leading-relaxed">Silakan ambil surat di Balai Desa dengan membawa <strong class="text-desa-dark">Dokumen Persyaratan Sesuai dengan Jenis Surat</strong>.</span>
                </li>
            </ul>
        </div>

        {{-- Tombol Aksi --}}
        <div class="space-y-3">
            
            {{-- Tombol Cek Surat (Diperbaiki agar langsung mengirim NIK & Tanggal Lahir tersembunyi) --}}
            <form action="{{ route('pengajuan.cek') }}" method="GET" class="w-full">
                {{-- Data otomatis dikirim agar warga tidak perlu mengetik ulang --}}
                <input type="hidden" name="nik" value="{{ $surat->penduduk->nik }}">
                <input type="hidden" name="tanggal_lahir" value="{{ \Carbon\Carbon::parse($surat->penduduk->tanggal_lahir)->format('Y-m-d') }}">
                
                <button type="submit" class="w-full py-3.5 bg-desa-dark hover:bg-black text-desa-gold rounded-xl font-bold text-sm transition-all shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Pantau Status Surat Ini
                </button>
            </form>

            {{-- Tombol WA --}}
            @php
                $nomorWA = config('desa.whatsapp', '6282290506890');
                $pesanWA = urlencode(
                    "Halo Admin Desa Banjaran,\n\nSaya baru saja mengajukan permohonan surat melalui website desa.\n\n*Nama:* {$surat->penduduk->nama}\n*NIK:* {$surat->penduduk->nik}\n*No Referensi:* {$surat->nomor_surat}\n*Jenis Surat:* {$surat->jenis_surat}\n\nMohon dibantu untuk proses verifikasinya ya Bapak/Ibu. Terima kasih 🙏"
                );
            @endphp
            <a href="https://wa.me/{{ $nomorWA }}?text={{ $pesanWA }}" target="_blank"
               class="flex items-center justify-center gap-2 w-full py-3.5 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-xl font-bold text-sm transition-colors shadow-md">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Konfirmasi via WhatsApp
            </a>

            {{-- Navigasi Bawah --}}
            <div class="flex gap-3 pt-2">
                <a href="{{ route('pengajuan.index') }}"
                   class="flex-1 py-3 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-desa-gold rounded-xl font-semibold text-sm transition-all shadow-sm">
                    Ajukan Surat Lain
                </a>
                <a href="{{ route('home') }}"
                   class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-xl font-semibold text-sm transition-all shadow-sm">
                    Kembali ke Beranda
                </a>
            </div>
        </div>

    </div>
</div>
@endsection