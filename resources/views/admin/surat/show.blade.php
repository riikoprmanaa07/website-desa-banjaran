@extends('layout.admin')

@section('title', 'Detail Surat')
@section('page-title', 'Detail Surat')
@section('page-subtitle', 'Informasi lengkap surat')

@section('content')
<div class="max-w-5xl mx-auto">

    <!-- Notifikasi -->
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
    @endif

    <!-- Card Utama -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-desa-dark to-desa-gray p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-1">{{ $surat->jenis_surat }}</h2>
                    <p class="text-gray-300">{{ $surat->nomor_surat }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ $surat->status == 'Pending'  ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $surat->status == 'Diproses' ? 'bg-blue-100 text-blue-800'    : '' }}
                    {{ $surat->status == 'Selesai'  ? 'bg-green-100 text-green-800'  : '' }}
                    {{ $surat->status == 'Ditolak'  ? 'bg-red-100 text-red-800'      : '' }}">
                    {{ $surat->status }}
                </span>
            </div>
        </div>

        <div class="p-6">

            <!-- Section: Informasi Surat -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Informasi Surat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Nomor Surat</label>
                        <p class="font-semibold text-gray-800">{{ $surat->nomor_surat }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Jenis Surat</label>
                        <p class="font-semibold text-gray-800">{{ $surat->jenis_surat }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Tanggal Surat</label>
                        <p class="font-semibold text-gray-800">{{ $surat->tanggal_surat->format('d F Y') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Penandatangan</label>
                        <p class="font-semibold text-gray-800">{{ $surat->penandatangan }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Data Pemohon -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Pemohon
                </h3>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">NIK</label>
                            <p class="font-semibold text-blue-900">{{ $surat->penduduk->nik }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">Nama Lengkap</label>
                            <p class="font-semibold text-blue-900">{{ $surat->penduduk->nama }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">Tempat, Tanggal Lahir</label>
                            <p class="font-semibold text-blue-900">
                                {{ $surat->penduduk->tempat_lahir }}, {{ $surat->penduduk->tanggal_lahir->format('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">Jenis Kelamin</label>
                            <p class="font-semibold text-blue-900">
                                {{ $surat->penduduk->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">Agama</label>
                            <p class="font-semibold text-blue-900">{{ $surat->penduduk->agama }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">Pekerjaan</label>
                            <p class="font-semibold text-blue-900">{{ $surat->penduduk->pekerjaan }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">Status Perkawinan</label>
                            <p class="font-semibold text-blue-900">{{ $surat->penduduk->status_perkawinan }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-blue-600 block mb-1">No. KK</label>
                            <p class="font-semibold text-blue-900">{{ $surat->penduduk->no_kk ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-sm text-blue-600 block mb-1">Alamat</label>
                            <p class="font-semibold text-blue-900">
                                {{ $surat->penduduk->alamat }}, RT {{ $surat->penduduk->rt }}/RW {{ $surat->penduduk->rw }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-blue-200">
                        <a href="{{ route('admin.penduduk.show', $surat->penduduk->id) }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat Detail Penduduk
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section: Keperluan -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Keperluan Surat
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-800 leading-relaxed">{{ $surat->keperluan }}</p>
                </div>

                @if($surat->keterangan)
                <div class="mt-4">
                    <label class="text-sm font-medium text-gray-700 block mb-2">Keterangan Tambahan:</label>
                    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                        <p class="text-gray-800 leading-relaxed">{{ $surat->keterangan }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- ✅ TAMBAHAN: Form Verifikasi (hanya muncul jika status Pending atau Diproses) -->
            @if(in_array($surat->status, ['Pending', 'Diproses']))
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Verifikasi & Setujui Surat
                </h3>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <p class="text-sm text-green-700 mb-4">
                        Masukkan nomor surat resmi lalu klik <strong>Verifikasi</strong>. Status akan berubah menjadi <strong>Selesai</strong> dan surat siap dicetak.
                    </p>
                    <form action="{{ route('admin.surat.verifikasi', $surat->id) }}" method="POST" class="flex gap-3 items-end">
                        @csrf
                        @method('PATCH')
                        <div class="flex-1">
                            <label class="text-sm font-medium text-gray-700 block mb-1">Nomor Surat Resmi</label>
                            <input type="text" name="nomor_surat"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('nomor_surat') border-red-500 @enderror"
                                   placeholder="Contoh: 470/001/DS-BJR/I/2025"
                                   value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                            @error('nomor_surat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition"
                                onclick="return confirm('Yakin ingin memverifikasi dan menyelesaikan surat ini?')">
                            ✓ Verifikasi
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- ✅ TAMBAHAN: Form Tolak (hanya jika belum Ditolak/Selesai) -->
            @if(in_array($surat->status, ['Pending', 'Diproses']))
            <div class="mb-8">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-sm font-medium text-red-700 mb-3">Tolak Pengajuan</p>
                    <form action="{{ route('admin.surat.update-status', $surat->id) }}" method="POST" class="flex gap-3 items-end">
                        @csrf
                        <input type="hidden" name="status" value="Ditolak">
                        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition"
                                onclick="return confirm('Yakin ingin menolak pengajuan ini?')">
                            ✕ Tolak Pengajuan
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Status Timeline -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Status Progress</h3>
                <div class="flex items-center justify-between">
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center {{ in_array($surat->status, ['Pending', 'Diproses', 'Selesai']) ? 'bg-yellow-500' : 'bg-gray-300' }}">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs mt-2 font-medium">Pending</p>
                    </div>
                    <div class="flex-1 h-1 {{ in_array($surat->status, ['Diproses', 'Selesai']) ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center {{ in_array($surat->status, ['Diproses', 'Selesai']) ? 'bg-blue-500' : 'bg-gray-300' }}">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                        <p class="text-xs mt-2 font-medium">Diproses</p>
                    </div>
                    <div class="flex-1 h-1 {{ $surat->status == 'Selesai' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $surat->status == 'Selesai' ? 'bg-green-500' : 'bg-gray-300' }}">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-xs mt-2 font-medium">Selesai</p>
                    </div>
                </div>

                @if($surat->status == 'Ditolak')
                <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-red-800 font-medium">❌ Surat Ditolak</p>
                </div>
                @endif
            </div>

            <!-- Metadata -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="text-gray-800 font-medium ml-2">{{ $surat->created_at->format('d F Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Terakhir Update:</span>
                        <span class="text-gray-800 font-medium ml-2">{{ $surat->updated_at->format('d F Y H:i') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <a href="{{ route('admin.surat.index') }}"
                class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-white font-medium transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>

            <div class="flex items-center space-x-3">
                <!-- ✅ PERBAIKAN: Tombol cetak hanya aktif jika status Selesai -->
                @if($surat->status === 'Selesai')
                <a href="{{ route('admin.surat.print', $surat->id) }}"
                    class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak PDF
                </a>
                @else
                <button disabled
                    class="px-6 py-2.5 bg-gray-300 text-gray-500 rounded-lg font-medium cursor-not-allowed flex items-center"
                    title="Surat harus diverifikasi dulu sebelum bisa dicetak">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak PDF
                </button>
                @endif

                <!-- Delete -->
                <button onclick="confirmDelete()"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>

                <!-- Edit -->
                <a href="{{ route('admin.surat.edit', $surat->id) }}"
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
            </div>
        </div>

        <form id="delete-form" action="{{ route('admin.surat.destroy', $surat->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus surat "{{ $surat->nomor_surat }}"?\n\nData yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush