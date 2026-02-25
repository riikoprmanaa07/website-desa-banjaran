@extends('layout.admin')

@section('title', 'Edit Struktur')
@section('page-title', 'Edit Struktur Organisasi')
@section('page-subtitle', 'Update data anggota struktur')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Edit Data Struktur</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $struktur->nama }} - {{ $struktur->jabatan }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.struktur.update', $struktur->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column (Photo) -->
                <div class="md:col-span-1">
                    <!-- Current Photo -->
                    @if($struktur->foto)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Saat Ini
                        </label>
                        <img src="{{ asset('storage/' . $struktur->foto) }}" alt="{{ $struktur->nama }}" 
                            class="w-full h-auto rounded-lg border-2 border-gray-200">
                    </div>
                    @endif

                    <!-- Upload New Photo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            {{ $struktur->foto ? 'Ganti Foto' : 'Upload Foto' }}
                        </label>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-desa-gold transition cursor-pointer" 
                            onclick="document.getElementById('foto').click()">
                            <div id="upload-area">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">
                                    <span class="font-semibold text-desa-gold">Upload foto baru</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG max 2MB</p>
                                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti</p>
                            </div>
                            
                            <!-- New Preview -->
                            <div id="image-preview" class="hidden">
                                <p class="text-xs font-medium text-gray-700 mb-2">Preview Foto Baru:</p>
                                <img id="preview-img" src="" alt="Preview" class="w-full h-auto rounded-lg border-2 border-desa-gold">
                                <button type="button" onclick="removeImage(event)" 
                                    class="mt-2 text-sm text-red-600 hover:text-red-800">
                                    Batalkan Perubahan
                                </button>
                            </div>
                        </div>
                        
                        <input id="foto" name="foto" type="file" class="hidden" accept="image/*"
                            onchange="previewImage(event)">
                        
                        @error('foto')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column (Form Fields) -->
                <div class="md:col-span-2 space-y-6">
                    
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $struktur->nama) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('nama') border-red-500 @enderror"
                            placeholder="Nama lengkap sesuai KTP">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <select name="jabatan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('jabatan') border-red-500 @enderror">
                            <option value="">Pilih Jabatan</option>
                            <option value="Kepala Desa" {{ old('jabatan', $struktur->jabatan) == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                            <option value="Sekretaris Desa" {{ old('jabatan', $struktur->jabatan) == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                            <option value="Kaur Keuangan" {{ old('jabatan', $struktur->jabatan) == 'Kaur Keuangan' ? 'selected' : '' }}>Kaur Keuangan</option>
                            <option value="Kaur Perencanaan" {{ old('jabatan', $struktur->jabatan) == 'Kaur Perencanaan' ? 'selected' : '' }}>Kaur Perencanaan</option>
                            <option value="Kaur TU & Umum" {{ old('jabatan', $struktur->jabatan) == 'Kaur TU & Umum' ? 'selected' : '' }}>Kaur TU & Umum</option>
                            <option value="Kepala Seksi Pemerintahan" {{ old('jabatan', $struktur->jabatan) == 'Kepala Seksi Pemerintahan' ? 'selected' : '' }}>Kepala Seksi Pemerintahan</option>
                            <option value="Kepala Seksi Kesejahteraan" {{ old('jabatan', $struktur->jabatan) == 'Kepala Seksi Kesejahteraan' ? 'selected' : '' }}>Kepala Seksi Kesejahteraan</option>
                            <option value="Kepala Seksi Pelayanann" {{ old('jabatan', $struktur->jabatan) == 'Kepala Seksi Pelayanan' ? 'selected' : '' }}>Kepala Seksi Pelayanan</option>
                            <option value="Staf Pemerintahan" {{ old('jabatan', $struktur->jabatan) == 'Staf Pemerintahan' ? 'selected' : '' }}>Staf Pemerintahan</option>
                            <option value=">Staf Kesejahteraan" {{ old('jabatan', $struktur->jabatan) == '>Staf Kesejahteraan' ? 'selected' : '' }}>Staf Kesejahteraan</option>
                            <option value="Staf Pelayanan" {{ old('jabatan', $struktur->jabatan) == 'Staf Pelayanan' ? 'selected' : '' }}>Staf Pelayanan</option>
                        </select>
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            NIP
                        </label>
                        <input type="text" name="nip" value="{{ old('nip', $struktur->nip) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('nip') border-red-500 @enderror"
                            placeholder="Nomor Induk Pegawai (opsional)">
                        @error('nip')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pendidikan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pendidikan Terakhir
                        </label>
                        <select name="pendidikan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('pendidikan') border-red-500 @enderror">
                            <option value="">Pilih Pendidikan</option>
                            <option value="SD" {{ old('pendidikan', $struktur->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('pendidikan', $struktur->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA/SMK" {{ old('pendidikan', $struktur->pendidikan) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ old('pendidikan', $struktur->pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('pendidikan', $struktur->pendidikan) == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('pendidikan', $struktur->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('pendidikan', $struktur->pendidikan) == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                        @error('pendidikan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor HP
                        </label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $struktur->no_hp) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('no_hp') border-red-500 @enderror"
                            placeholder="08xx xxxx xxxx (opsional)">
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                     <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                            <option value="Aktif" {{ old('status', $struktur->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status', $struktur->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <!-- Urutan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Urutan Tampil
                        </label>
                        <input type="number" name="urutan" value="{{ old('urutan', $struktur->urutan) }}" min="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('urutan') border-red-500 @enderror"
                            placeholder="Urutan tampil (1, 2, 3, dst)">
                        @error('urutan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Atau gunakan drag & drop di halaman index</p>
                    </div>

                   

                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <!-- Delete Button -->
                <button type="button" onclick="confirmDelete()" 
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Data
                </button>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.struktur.index') }}" 
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Data
                    </button>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('admin.struktur.destroy', $struktur->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('upload-area').classList.add('hidden');
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function removeImage(event) {
    event.preventDefault();
    event.stopPropagation();
    
    document.getElementById('foto').value = '';
    document.getElementById('preview-img').src = '';
    document.getElementById('upload-area').classList.remove('hidden');
    document.getElementById('image-preview').classList.add('hidden');
}

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus {{ $struktur->nama }} dari struktur?\n\nData yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush