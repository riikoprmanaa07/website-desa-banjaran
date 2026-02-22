@extends('layout.admin')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita Baru')
@section('page-subtitle', 'Buat berita dan informasi desa')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Berita</h3>
            <p class="text-sm text-gray-500 mt-1">Isi semua data dengan lengkap dan benar</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column (2/3) -->
                <div class="md:col-span-2 space-y-6">
                    
                    <!-- Judul -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent @error('judul') border-red-500 @enderror"
                            placeholder="Masukkan judul berita yang menarik">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ringkasan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="excerpt" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('excerpt') border-red-500 @enderror"
                            placeholder="Ringkasan singkat berita (maks. 200 karakter)">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Ringkasan yang akan muncul di halaman utama</p>
                    </div>

                    <!-- Konten -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Konten Berita <span class="text-red-500">*</span>
                        </label>
                        <textarea name="konten" rows="12" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('konten') border-red-500 @enderror"
                            placeholder="Tulis konten berita lengkap di sini...">{{ old('konten') }}</textarea>
                        @error('konten')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Konten lengkap berita</p>
                    </div>

                </div>

                <!-- Right Column (1/3) -->
                <div class="space-y-6">
                    
                    <!-- Upload Gambar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Berita <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-desa-gold transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-desa-gold hover:text-yellow-600 focus-within:outline-none">
                                        <span>Upload gambar</span>
                                        <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror>
                        
                        <!-- Preview -->
                        <div id="image-preview" class="mt-4 hidden">
                            <img id="preview-img" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('kategori') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Budaya" {{ old('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Publikasi <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('status') border-red-500 @enderror">
                            <option value="Draft" {{ old('status', 'Draft') == 'Draft' ? 'selected' : '' }}>Draft (Simpan Dulu)</option>
                            <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published (Langsung Publikasi)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            <strong>Draft:</strong> Berita disimpan tapi belum muncul di website<br>
                            <strong>Published:</strong> Berita langsung tayang di website
                        </p>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Tips Menulis Berita</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Gunakan judul yang menarik</li>
                                        <li>Ringkasan maksimal 200 karakter</li>
                                        <li>Upload gambar berkualitas baik</li>
                                        <li>Simpan sebagai Draft untuk review</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.berita.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Berita
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
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush