@extends('layout.admin')

@section('title', 'Upload Foto')
@section('page-title', 'Upload Foto Galeri')
@section('page-subtitle', 'Tambahkan foto ke galeri desa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Upload Foto</h3>
            <p class="text-sm text-gray-500 mt-1">Upload foto kegiatan atau dokumentasi desa</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <!-- Upload Image Area (Large) -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Upload Foto <span class="text-red-500">*</span>
                </label>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-desa-gold transition cursor-pointer" 
                    onclick="document.getElementById('gambar').click()">
                    <div id="upload-area">
                        <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-4 text-lg text-gray-600">
                            <span class="font-semibold text-desa-gold">Klik untuk upload</span> atau drag & drop
                        </p>
                        <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF hingga 5MB</p>
                    </div>
                    
                    <!-- Preview -->
                    <div id="image-preview" class="hidden">
                        <img id="preview-img" src="" alt="Preview" class="mx-auto max-h-96 rounded-lg shadow-lg">
                        <button type="button" onclick="removeImage(event)" 
                            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Hapus & Upload Ulang
                        </button>
                    </div>
                </div>
                
                <input id="gambar" name="gambar" type="file" class="hidden" accept="image/*" required
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
                    <input type="text" name="judul" value="{{ old('judul') }}" required
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
                        placeholder="Deskripsi singkat tentang foto ini (opsional)">{{ old('deskripsi') }}</textarea>
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
                        <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Infrastruktur" {{ old('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                        <option value="Acara" {{ old('kategori') == 'Acara' ? 'selected' : '' }}>Acara</option>
                        <option value="Budaya" {{ old('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                        <option value="Prestasi" {{ old('kategori') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                        <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                        <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                    <input type="date" name="tanggal_foto" value="{{ old('tanggal_foto', date('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('tanggal_foto') border-red-500 @enderror">
                    @error('tanggal_foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Tanggal foto diambil</p>
                </div>

            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Tips Upload Foto</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Gunakan foto dengan resolusi tinggi (minimal 1200x800px)</li>
                                <li>Format yang didukung: JPG, PNG, GIF</li>
                                <li>Ukuran maksimal 5MB per foto</li>
                                <li>Gunakan judul yang deskriptif dan mudah dicari</li>
                                <li>Pilih kategori yang sesuai dengan konten foto</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.galeri.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Upload Foto
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

function removeImage(event) {
    event.preventDefault();
    event.stopPropagation();
    
    document.getElementById('gambar').value = '';
    document.getElementById('preview-img').src = '';
    document.getElementById('upload-area').classList.remove('hidden');
    document.getElementById('image-preview').classList.add('hidden');
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