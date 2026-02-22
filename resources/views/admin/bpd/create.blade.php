@extends('layout.admin')

@section('title', 'Tambah Anggota BPD')
@section('page-title', 'Tambah Anggota BPD')
@section('page-subtitle', 'Tambahkan anggota Badan Permusyawaratan Desa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Anggota BPD</h3>
            <p class="text-sm text-gray-500 mt-1">Isi semua data dengan lengkap dan benar</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.bpd.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column (Upload Photo) -->
                <div class="md:col-span-1">
                    <!-- Upload Photo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Foto Profil <span class="text-red-500">*</span>
                        </label>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-desa-gold transition cursor-pointer" 
                            onclick="document.getElementById('foto').click()">
                            <div id="upload-area">
                                <svg class="mx-auto h-20 w-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <p class="mt-3 text-sm text-gray-600">
                                    <span class="font-semibold text-desa-gold">Upload foto</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG max 2MB</p>
                            </div>
                            
                            <!-- Preview -->
                            <div id="image-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" class="w-full h-auto rounded-lg">
                                <button type="button" onclick="removeImage(event)" 
                                    class="mt-3 text-sm text-red-600 hover:text-red-800">
                                    Hapus & Upload Ulang
                                </button>
                            </div>
                        </div>
                        
                        <input id="foto" name="foto" type="file" class="hidden" accept="image/*" required
                            onchange="previewImage(event)">
                        
                        @error('foto')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <h4 class="text-xs font-medium text-blue-800 mb-2">Tips Foto:</h4>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li>• Gunakan foto formal</li>
                            <li>• Latar belakang polos</li>
                            <li>• Ukuran 3x4 atau 4x6</li>
                            <li>• Maksimal 2MB</li>
                        </ul>
                    </div>
                </div>

                <!-- Right Column (Form Fields) -->
                <div class="md:col-span-2 space-y-6">
                    
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
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
                            <option value="Ketua BPD" {{ old('jabatan') == 'Ketua BPD' ? 'selected' : '' }}>Ketua BPD</option>
                            <option value="Wakil Ketua BPD" {{ old('jabatan') == 'Wakil Ketua BPD' ? 'selected' : '' }}>Wakil Ketua BPD</option>
                            <option value="Sekretaris BPD" {{ old('jabatan') == 'Sekretaris BPD' ? 'selected' : '' }}>Sekretaris BPD</option>
                            <option value="Anggota BPD" {{ old('jabatan') == 'Anggota BPD' ? 'selected' : '' }}>Anggota BPD</option>
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
                        <input type="text" name="nip" value="{{ old('nip') }}"
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
                            <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA/SMK" {{ old('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
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
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('no_hp') border-red-500 @enderror"
                            placeholder="08xx xxxx xxxx (opsional)">
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.bpd.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Data
                </button>
            </div>
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
</script>
@endpush