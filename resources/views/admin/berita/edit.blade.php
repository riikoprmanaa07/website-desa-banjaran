@extends('layout.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Update berita dan informasi desa')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Edit Berita</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $berita->judul }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column (2/3) -->
                <div class="md:col-span-2 space-y-6">
                    
                    <!-- Judul -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent @error('judul') border-red-500 @enderror"
                            placeholder="Masukkan judul berita yang menarik">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug (readonly, auto from judul) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Slug URL
                        </label>
                        <input type="text" value="{{ $berita->slug }}" readonly
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500">
                        <p class="mt-1 text-xs text-gray-500">URL otomatis dibuat dari judul</p>
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ringkasan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="excerpt" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('excerpt') border-red-500 @enderror"
                            placeholder="Ringkasan singkat berita (maks. 200 karakter)">{{ old('excerpt', $berita->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konten -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Konten Berita <span class="text-red-500">*</span>
                        </label>
                        <textarea name="konten" rows="12" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('konten') border-red-500 @enderror"
                            placeholder="Tulis konten berita lengkap di sini...">{{ old('konten', $berita->konten) }}</textarea>
                        @error('konten')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Right Column (1/3) -->
                <div class="space-y-6">
                    
                    <!-- Current Image -->
                    @if($berita->gambar)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Saat Ini
                        </label>
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" 
                            class="w-full h-48 object-cover rounded-lg border border-gray-200">
                    </div>
                    @endif

                    <!-- Upload Gambar Baru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $berita->gambar ? 'Ganti Gambar' : 'Upload Gambar' }}
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-desa-gold transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-desa-gold hover:text-yellow-600">
                                        <span>Upload gambar</span>
                                        <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">{{ $berita->gambar ? 'Kosongkan jika tidak ingin mengganti gambar' : '' }}</p>
                        
                        <!-- New Image Preview -->
                        <div id="image-preview" class="mt-4 hidden">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar Baru:</p>
                            <img id="preview-img" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg border-2 border-desa-gold">
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
                            <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Kegiatan" {{ old('kategori', $berita->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Pembangunan" {{ old('kategori', $berita->kategori) == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="Kesehatan" {{ old('kategori', $berita->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Pendidikan" {{ old('kategori', $berita->kategori) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Sosial" {{ old('kategori', $berita->kategori) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Budaya" {{ old('kategori', $berita->kategori) == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                            <option value="Lainnya" {{ old('kategori', $berita->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                            <option value="Draft" {{ old('status', $berita->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Published" {{ old('status', $berita->status) == 'Published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stats -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Statistik</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Views:</span>
                                <span class="font-semibold text-gray-900">{{ $berita->views }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dibuat:</span>
                                <span class="font-medium text-gray-900">{{ $berita->created_at->format('d/m/Y') }}</span>
                            </div>
                            @if($berita->published_at)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Published:</span>
                                <span class="font-medium text-gray-900">{{ $berita->published_at->format('d/m/Y') }}</span>
                            </div>
                            @endif
                        </div>
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
                    Hapus Berita
                </button>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.berita.index') }}" 
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Berita
                    </button>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" style="display: none;">
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
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus berita "{{ $berita->judul }}"?\n\nData yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush