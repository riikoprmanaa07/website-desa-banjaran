@extends('layout.admin')

@section('title', 'Galeri Desa')
@section('page-title', 'Galeri Foto')
@section('page-subtitle', 'Kelola galeri foto kegiatan desa')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Galeri Foto Desa</h3>
            <p class="text-sm text-gray-500">Total: {{ $galeri->total() }} foto</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="bg-desa-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Upload Foto
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <form action="{{ route('admin.galeri.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari judul foto..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent">
            </div>

            <!-- Filter Kategori -->
            <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                <option value="">Semua Kategori</option>
                <option value="Kegiatan" {{ request('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="Infrastruktur" {{ request('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                <option value="Acara" {{ request('kategori') == 'Acara' ? 'selected' : '' }}>Acara</option>
                <option value="Budaya" {{ request('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                <option value="Prestasi" {{ request('kategori') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Cari
                </button>
                @if(request()->hasAny(['search', 'kategori']))
                <a href="{{ route('admin.galeri.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Bulk Actions (Optional) -->
    <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <label class="flex items-center">
                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-desa-gold focus:ring-desa-gold">
                <span class="ml-2 text-sm text-gray-700">Pilih Semua</span>
            </label>
            <button type="button" onclick="bulkDelete()" class="text-sm text-red-600 hover:text-red-800 font-medium hidden" id="bulk-delete-btn">
                Hapus Terpilih (<span id="selected-count">0</span>)
            </button>
        </div>
        <div class="text-sm text-gray-500">
            Tampilan: Grid
        </div>
    </div>

    <!-- Grid Gallery -->
    @if($galeri->count() > 0)
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid">
            @foreach($galeri as $item)
            <div class="group relative bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 gallery-item">
                <!-- Checkbox -->
                <div class="absolute top-2 left-2 z-10">
                    <input type="checkbox" name="selected[]" value="{{ $item->id }}" 
                        class="gallery-checkbox w-5 h-5 rounded border-gray-300 text-desa-gold focus:ring-desa-gold">
                </div>

                <!-- Image -->
                <div class="aspect-square relative overflow-hidden bg-gray-200">
                    @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif

                    <!-- Overlay on Hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <div class="flex space-x-2">
                            <!-- View -->
                            <button onclick="viewImage('{{ asset('storage/' . $item->gambar) }}', '{{ $item->judul }}')" 
                                class="p-2 bg-white rounded-full hover:bg-gray-100 transition" title="Lihat">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>

                            <!-- Edit -->
                            <a href="{{ route('admin.galeri.edit', $item->id) }}" 
                                class="p-2 bg-white rounded-full hover:bg-gray-100 transition" title="Edit">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus foto {{ $item->judul }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white rounded-full hover:bg-gray-100 transition" title="Hapus">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-4">
                    <h4 class="font-semibold text-gray-800 truncate mb-1">{{ $item->judul }}</h4>
                    <div class="flex items-center justify-between text-sm">
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs font-medium">
                            {{ $item->kategori }}
                        </span>
                        <span class="text-gray-500 text-xs">
                            {{ $item->tanggal_foto->format('d/m/Y') }}
                        </span>
                    </div>
                    @if($item->deskripsi)
                    <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ $item->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="px-6 py-12 text-center">
        <div class="flex flex-col items-center justify-center text-gray-500">
            <svg class="w-20 h-20 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-lg font-medium">Belum ada foto di galeri</p>
            <p class="text-sm mt-1">Klik tombol "Upload Foto" untuk menambah foto</p>
        </div>
    </div>
    @endif

    <!-- Pagination -->
    @if($galeri->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $galeri->links() }}
    </div>
    @endif
</div>

<!-- Image Preview Modal -->
<div id="image-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4" onclick="closeModal()">
    <div class="relative max-w-4xl max-h-screen" onclick="event.stopPropagation()">
        <button onclick="closeModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modal-image" src="" alt="" class="max-w-full max-h-screen rounded-lg">
        <p id="modal-title" class="text-white text-center mt-4 text-lg font-medium"></p>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Image Modal
function viewImage(src, title) {
    document.getElementById('modal-image').src = src;
    document.getElementById('modal-title').textContent = title;
    document.getElementById('image-modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('image-modal').classList.add('hidden');
}

// Select All
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.gallery-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
    updateBulkDelete();
});

// Update Bulk Delete Button
document.querySelectorAll('.gallery-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateBulkDelete);
});

function updateBulkDelete() {
    const selected = document.querySelectorAll('.gallery-checkbox:checked').length;
    document.getElementById('selected-count').textContent = selected;
    
    if (selected > 0) {
        document.getElementById('bulk-delete-btn').classList.remove('hidden');
    } else {
        document.getElementById('bulk-delete-btn').classList.add('hidden');
    }
}

// Bulk Delete
function bulkDelete() {
    const selected = Array.from(document.querySelectorAll('.gallery-checkbox:checked')).map(cb => cb.value);
    
    if (selected.length === 0) {
        alert('Pilih foto yang ingin dihapus');
        return;
    }
    
    if (confirm(`Yakin ingin menghapus ${selected.length} foto?\n\nData yang sudah dihapus tidak dapat dikembalikan!`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.galeri.bulk-delete") }}';
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);
        
        selected.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            form.appendChild(input);
        });
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush