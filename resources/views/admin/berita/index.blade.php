@extends('layout.admin')

@section('title', 'Data Berita')
@section('page-title', 'Kelola Berita')
@section('page-subtitle', 'Manajemen berita dan informasi desa')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Berita</h3>
            <p class="text-sm text-gray-500">Total: {{ $berita->total() }} berita</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="bg-desa-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Berita
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <form action="{{ route('admin.berita.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari judul atau konten berita..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent">
            </div>

            <!-- Filter Status -->
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                <option value="">Semua Status</option>
                <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>Published</option>
                <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
            </select>

            <!-- Filter Kategori -->
            <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                <option value="">Semua Kategori</option>
                <option value="Pengumuman" {{ request('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="Kegiatan" {{ request('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="Pembangunan" {{ request('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                <option value="Kesehatan" {{ request('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                <option value="Pendidikan" {{ request('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>

            <!-- Buttons -->
            <div class="md:col-span-4 flex gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Cari
                </button>
                @if(request()->hasAny(['search', 'status', 'kategori']))
                <a href="{{ route('admin.berita.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Statistics -->
    <div class="px-6 py-4 bg-gray-50 border-b grid grid-cols-3 gap-4">
        <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-green-800">{{ $berita->where('status', 'Published')->count() }}</p>
            <p class="text-xs text-green-600">Published</p>
        </div>
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-gray-800">{{ $berita->where('status', 'Draft')->count() }}</p>
            <p class="text-xs text-gray-600">Draft</p>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-blue-800">{{ $berita->sum('views') }}</p>
            <p class="text-xs text-blue-600">Total Views</p>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($berita as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" 
                            class="w-16 h-16 object-cover rounded-lg">
                        @else
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm">
                            <div class="font-medium text-gray-900">{{ Str::limit($item->judul, 50) }}</div>
                            <div class="text-gray-500">{{ Str::limit($item->excerpt, 60) }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->admin->name ?? 'Admin' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->published_at ? $item->published_at->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $item->status == 'Published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ $item->views }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <!-- Quick Publish (if Draft) -->
                            @if($item->status == 'Draft')
                            <form action="{{ route('admin.berita.publish', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900" title="Publish">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            </form>
                            @endif

                            <!-- View -->
                            <a href="{{ route('admin.berita.show', $item->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('admin.berita.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="inline" 
                                onsubmit="return confirm('Yakin ingin menghapus berita {{ $item->judul }}?\n\nData yang sudah dihapus tidak dapat dikembalikan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <p class="text-lg font-medium">Belum ada berita</p>
                            <p class="text-sm mt-1">Klik tombol "Tambah Berita" untuk membuat berita baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($berita->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $berita->links() }}
    </div>
    @endif
</div>
@endsection