@extends('layout.admin')

@section('title', 'Edit Foto')
@section('page-title', 'Edit Foto Galeri')
@section('page-subtitle', 'Update informasi foto galeri')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Edit Foto Galeri</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $galeri->judul }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <!-- Current Image Display -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Foto Saat Ini
                </label>
                <div class="relative inline-block">
                    <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" 
                        class="w-full max-w-2xl h-auto rounded-lg shadow-lg border-2 border-gray-200">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-black bg-opacity-50 text-white text-sm rounded-full">
                            Foto Aktif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Upload New Image (Optional) -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Ganti Foto (Opsional)
                </label>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-desa-gold transition cursor-pointer" 
                    onclick="document.getElementById('gambar').click()">
                    <div id="upload-area">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-4 text-base text-gray-600">
                            <span class="font-semibold text-desa-gold">Klik untuk upload foto baru</span>
                        </p>
                        <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF hingga 5MB</p>
                        <p class="mt-2 text-xs text-gray-400">Kosongkan jika tidak ingin mengganti foto</p>
                    </div>
                    
                    <!-- New Image Preview -->
                    <div id="image-preview" class="hidden">
                        <p class="text-sm font-medium text-gray-700 mb-3">Preview Foto Baru:</p>
                        <img id="preview-img" src="" alt="Preview" class="mx-auto max-h-96 rounded-lg shadow-lg border-2 border-desa-gold">
                        <button type="button" onclick="removeNewImage(event)" 
                            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Batalkan Perubahan Foto
                        </button>
                    </div>
                </div>
                
                <input id="gambar" name="gambar" type="file" class="hidden" accept="image/*"
                    onchange="previewImage(event)">
                
                @error('gambar')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Judul -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Foto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent @error('judul') border-red-500 @enderror"
                        placeholder="Contoh: Musyawarah Desa 2024">
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Foto
                    </label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('deskripsi') border-red-500 @enderror"
                        placeholder="Deskripsi singkat tentang foto ini (opsional)">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('kategori') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="Kegiatan" {{ old('kategori', $galeri->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Infrastruktur" {{ old('kategori', $galeri->kategori) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                        <option value="Acara" {{ old('kategori', $galeri->kategori) == 'Acara' ? 'selected' : '' }}>Acara</option>
                        <option value="Budaya" {{ old('kategori', $galeri->kategori) == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                        <option value="Prestasi" {{ old('kategori', $galeri->kategori) == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="Sosial" {{ old('kategori', $galeri->kategori) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                        <option value="Pembangunan" {{ old('kategori', $galeri->kategori) == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                        <option value="Lainnya" {{ old('kategori', $galeri->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Foto -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Foto <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_foto" value="{{ old('tanggal_foto', $galeri->tanggal_foto->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('tanggal_foto') border-red-500 @enderror">
                    @error('tanggal_foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Info -->
            <div class="mt-6 bg-gray-50 rounded-lg p-4">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Ditambahkan:</span>
                        <span class="text-gray-900 font-medium ml-2">{{ $galeri->created_at->format('d F Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Update Terakhir:</span>
                        <span class="text-gray-900 font-medium ml-2">{{ $galeri->updated_at->format('d F Y H:i') }}</span>
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
                    Hapus Foto
                </button>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.galeri.index') }}" 
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Foto
                    </button>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" style="display: none;">
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
        // Check file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 5MB');
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

function removeNewImage(event) {
    event.preventDefault();
    event.stopPropagation();
    
    document.getElementById('gambar').value = '';
    document.getElementById('preview-img').src = '';
    document.getElementById('upload-area').classList.remove('hidden');
    document.getElementById('image-preview').classList.add('hidden');
}

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus foto "{{ $galeri->judul }}"?\n\nFoto yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}

// Drag and Drop
const uploadArea = document.querySelector('[onclick*="gambar"]');

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('border-desa-gold', 'bg-yellow-50');
});

uploadArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('border-desa-gold', 'bg-yellow-50');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('border-desa-gold', 'bg-yellow-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('gambar').files = files;
        previewImage({ target: { files: files } });
    }
});
</script>
@endpush