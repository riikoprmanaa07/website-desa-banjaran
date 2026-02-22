@extends('layout.admin')

@section('title', 'Detail Berita')
@section('page-title', 'Detail Berita')
@section('page-subtitle', 'Informasi lengkap berita')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Card Utama -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header Image -->
        @if($berita->gambar)
        <div class="relative h-96">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" 
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="px-3 py-1 bg-purple-600 text-white text-sm font-semibold rounded-full">
                        {{ $berita->kategori }}
                    </span>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        {{ $berita->status == 'Published' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                        {{ $berita->status }}
                    </span>
                </div>
                <h1 class="text-3xl font-bold text-white">{{ $berita->judul }}</h1>
            </div>
        </div>
        @else
        <div class="bg-gradient-to-r from-desa-dark to-desa-gray p-8">
            <div class="flex items-center justify-between mb-2">
                <span class="px-3 py-1 bg-purple-600 text-white text-sm font-semibold rounded-full">
                    {{ $berita->kategori }}
                </span>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ $berita->status == 'Published' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                    {{ $berita->status }}
                </span>
            </div>
            <h1 class="text-3xl font-bold text-white">{{ $berita->judul }}</h1>
        </div>
        @endif

        <!-- Content -->
        <div class="p-6">
            
            <!-- Meta Info -->
            <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-200">
                <div class="flex items-center space-x-6 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $berita->admin->name ?? 'Admin' }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $berita->published_at ? $berita->published_at->format('d F Y') : 'Belum dipublikasi' }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>{{ $berita->views }} views</span>
                    </div>
                </div>
            </div>

            <!-- Excerpt -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-blue-900 font-medium italic">{{ $berita->excerpt }}</p>
            </div>

            <!-- Content -->
            <div class="prose max-w-none">
                <div class="text-gray-800 leading-relaxed whitespace-pre-line">
                    {{ $berita->konten }}
                </div>
            </div>

            <!-- Tags/Kategori -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span class="text-sm text-gray-600 mr-2">Kategori:</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-semibold rounded-full">
                        {{ $berita->kategori }}
                    </span>
                </div>
            </div>

            <!-- Info Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Publikasi -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-bold text-gray-700 mb-3">Informasi Publikasi</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                {{ $berita->status == 'Published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $berita->status }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Slug URL:</span>
                            <span class="font-medium text-gray-900">{{ $berita->slug }}</span>
                        </div>
                        @if($berita->published_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Publish:</span>
                            <span class="font-medium text-gray-900">{{ $berita->published_at->format('d F Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Statistik -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-bold text-gray-700 mb-3">Statistik</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Views:</span>
                            <span class="font-bold text-gray-900">{{ $berita->views }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="font-medium text-gray-900">{{ $berita->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Update Terakhir:</span>
                            <span class="font-medium text-gray-900">{{ $berita->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <a href="{{ route('admin.berita.index') }}" 
                class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-white font-medium transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>

            <div class="flex items-center space-x-3">
                <!-- Publish/Unpublish Button -->
                @if($berita->status == 'Draft')
                <form action="{{ route('admin.berita.publish', $berita->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                        class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Publish
                    </button>
                </form>
                @endif

                <!-- View on Website (if published) -->
                @if($berita->status == 'Published')
                <a href="{{ route('news.show', $berita->id) }}" target="_blank"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Lihat di Website
                </a>
                @endif

                <!-- Delete Button -->
                <button onclick="confirmDelete()" 
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>

                <!-- Edit Button -->
                <a href="{{ route('admin.berita.edit', $berita->id) }}" 
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
            </div>
        </div>

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
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus berita "{{ $berita->judul }}"?\n\nData yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush