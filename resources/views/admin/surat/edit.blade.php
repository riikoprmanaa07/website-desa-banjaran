@extends('layout.admin')

@section('title', 'Edit Surat')
@section('page-title', 'Edit Surat')
@section('page-subtitle', 'Edit data surat')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">

        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Edit Data Surat</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $surat->nomor_surat }} - {{ $surat->jenis_surat }}</p>
        </div>

        @if($errors->any())
        <div class="mx-6 mt-4 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.surat.update', $surat->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- Section: Informasi Surat -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Informasi Surat</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nomor Surat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor_surat"
                            value="{{ old('nomor_surat', $surat->nomor_surat) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent @error('nomor_surat') border-red-500 @enderror"
                            placeholder="Contoh: 470/001/DS-BJR/I/2025">
                        @error('nomor_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Surat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_surat"
                            value="{{ old('tanggal_surat', $surat->tanggal_surat->format('Y-m-d')) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('tanggal_surat') border-red-500 @enderror">
                        @error('tanggal_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ✅ Template Surat (dari database, bukan hardcode) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Template / Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select name="template_surat_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('template_surat_id') border-red-500 @enderror">
                            <option value="">Pilih Template Surat</option>
                            @foreach($templates as $t)
                            <option value="{{ $t->id }}"
                                {{ old('template_surat_id', $surat->template_surat_id) == $t->id ? 'selected' : '' }}>
                                {{ $t->nama_template }}
                            </option>
                            @endforeach
                        </select>
                        @error('template_surat_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">⚠️ Jika template diubah, isi surat akan di-generate ulang otomatis.</p>
                    </div>

                    <!-- Penandatangan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Penandatangan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="penandatangan"
                            value="{{ old('penandatangan', $surat->penandatangan) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('penandatangan') border-red-500 @enderror"
                            placeholder="Nama penandatangan surat">
                        @error('penandatangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Surat <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('status') border-red-500 @enderror">
                            @foreach(['Pending', 'Diproses', 'Selesai', 'Ditolak'] as $s)
                            <option value="{{ $s }}" {{ old('status', $surat->status) == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Section: Data Pemohon -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Data Pemohon</h4>
                <div class="grid grid-cols-1 gap-6">

                    <!-- Pilih Penduduk -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pemohon <span class="text-red-500">*</span>
                        </label>
                        <select name="penduduk_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('penduduk_id') border-red-500 @enderror">
                            <option value="">Pilih Penduduk</option>
                            @foreach($penduduk as $p)
                            <option value="{{ $p->id }}"
                                {{ old('penduduk_id', $surat->penduduk_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }} — NIK: {{ $p->nik }}
                            </option>
                            @endforeach
                        </select>
                        @error('penduduk_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Pemohon Saat Ini -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm font-medium text-blue-700 mb-3">Data Pemohon Saat Ini:</p>
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-blue-600">NIK:</span>
                                <span class="text-blue-900 font-medium ml-2">{{ $surat->penduduk->nik }}</span>
                            </div>
                            <div>
                                <span class="text-blue-600">Nama:</span>
                                <span class="text-blue-900 font-medium ml-2">{{ $surat->penduduk->nama }}</span>
                            </div>
                            <div>
                                <span class="text-blue-600">Tempat/Tgl Lahir:</span>
                                <span class="text-blue-900 font-medium ml-2">
                                    {{ $surat->penduduk->tempat_lahir }}, {{ $surat->penduduk->tanggal_lahir->format('d F Y') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-blue-600">Pekerjaan:</span>
                                <span class="text-blue-900 font-medium ml-2">{{ $surat->penduduk->pekerjaan }}</span>
                            </div>
                            <div class="col-span-2">
                                <span class="text-blue-600">Alamat:</span>
                                <span class="text-blue-900 font-medium ml-2">
                                    {{ $surat->penduduk->alamat }}, RT {{ $surat->penduduk->rt }}/RW {{ $surat->penduduk->rw }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Section: Keperluan -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Keperluan Surat</h4>
                <div class="grid grid-cols-1 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Keperluan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="keperluan" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('keperluan') border-red-500 @enderror"
                            placeholder="Jelaskan keperluan surat secara detail...">{{ old('keperluan', $surat->keperluan) }}</textarea>
                        @error('keperluan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <button type="button" onclick="confirmDelete()"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Surat
                </button>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.surat.show', $surat->id) }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Surat
                    </button>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
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