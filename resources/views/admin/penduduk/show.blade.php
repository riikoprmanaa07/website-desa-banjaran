@extends('layout.admin')

@section('title', 'Detail Penduduk')
@section('page-title', 'Detail Penduduk')
@section('page-subtitle', 'Informasi lengkap data penduduk')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Card Utama -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header with Avatar -->
        <div class="bg-gradient-to-r from-desa-dark to-desa-gray p-6">
            <div class="flex items-center space-x-4">
                <div class="w-20 h-20 bg-desa-gold rounded-full flex items-center justify-center text-white text-3xl font-bold">
                    {{ strtoupper(substr($penduduk->nama, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $penduduk->nama }}</h2>
                    <p class="text-gray-300">NIK: {{ $penduduk->nik }}</p>
                </div>
            </div>
        </div>

        <!-- Data Detail -->
        <div class="p-6">
            
            <!-- Section: Data Identitas -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Data Identitas
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">NIK</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->nik }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Nama Lengkap</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->nama }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Tempat, Tanggal Lahir</label>
                        <p class="font-semibold text-gray-800">
                            {{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir->format('d F Y') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Umur: {{ $penduduk->tanggal_lahir->age }} tahun</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Jenis Kelamin</label>
                        <p class="font-semibold text-gray-800">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm 
                                {{ $penduduk->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Agama</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->agama }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Kewarganegaraan</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->kewarganegaraan }}</p>
                    </div>

                </div>
            </div>

            <!-- Section: Data Alamat -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Data Alamat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Alamat Lengkap</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->alamat }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">RT</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->rt }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">RW</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->rw }}</p>
                    </div>

                </div>
            </div>

            <!-- Section: Data Lainnya -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Data Lainnya
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Status Perkawinan</label>
                        <p class="font-semibold text-gray-800">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800">
                                {{ $penduduk->status_perkawinan }}
                            </span>
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Pekerjaan</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->pekerjaan }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Pendidikan Terakhir</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->pendidikan }}</p>
                    </div>

                    @if($penduduk->no_kk)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">No. Kartu Keluarga</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->no_kk }}</p>
                    </div>
                    @endif

                    @if($penduduk->status_dalam_keluarga)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm text-gray-500 block mb-1">Status Dalam Keluarga</label>
                        <p class="font-semibold text-gray-800">{{ $penduduk->status_dalam_keluarga }}</p>
                    </div>
                    @endif

                </div>
            </div>

            <!-- Section: Riwayat Surat (Jika ada relasi) -->
            @if($penduduk->surat && $penduduk->surat->count() > 0)
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center">
                    <svg class="w-6 h-6 mr-2 text-desa-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Riwayat Surat
                    <span class="ml-2 px-2 py-1 bg-desa-gold text-white text-xs rounded-full">{{ $penduduk->surat->count() }}</span>
                </h3>
                <div class="space-y-3">
                    @foreach($penduduk->surat->take(5) as $surat)
                    <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $surat->jenis_surat }}</p>
                            <p class="text-sm text-gray-500">{{ $surat->tanggal_surat->format('d F Y') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $surat->status == 'Selesai' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $surat->status == 'Diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $surat->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                            {{ $surat->status }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Metadata -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="text-gray-800 font-medium ml-2">{{ $penduduk->created_at->format('d F Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Terakhir Update:</span>
                        <span class="text-gray-800 font-medium ml-2">{{ $penduduk->updated_at->format('d F Y H:i') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <a href="{{ route('admin.penduduk.index') }}" 
                class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-white font-medium transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>

            <div class="flex items-center space-x-3">
                <button onclick="confirmDelete()" 
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>

                <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" 
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Data
                </a>
            </div>
        </div>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('admin.penduduk.destroy', $penduduk->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus data penduduk "{{ $penduduk->nama }}"?\n\nData yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush