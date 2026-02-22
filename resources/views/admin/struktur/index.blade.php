@extends('layout.admin')

@section('title', 'Struktur Desa')
@section('page-title', 'Struktur Organisasi Desa')
@section('page-subtitle', 'Kelola struktur pemerintahan Desa Banjaran')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Struktur Pemerintahan Desa</h3>
            <p class="text-sm text-gray-500">Total: {{ $struktur->count() }} jabatan</p>
        </div>
        <a href="{{ route('admin.struktur.create') }}" class="bg-desa-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Jabatan
        </a>
    </div>

    <!-- Info Box -->
    <div class="px-6 py-4 bg-blue-50 border-b border-blue-200">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-blue-800">
                <strong>Drag & Drop</strong> untuk mengubah urutan tampil. Urutan akan tersimpan otomatis.
            </p>
        </div>
    </div>

    <!-- Structure Cards (Sortable) -->
    @if($struktur->count() > 0)
    <div class="p-6">
        <div id="sortable-struktur" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($struktur as $item)
            <div class="struktur-card bg-white border-2 border-gray-200 rounded-lg shadow-md hover:shadow-xl transition duration-300 cursor-move" 
                data-id="{{ $item->id }}">
                
                <!-- Drag Handle -->
                <div class="bg-gray-100 px-4 py-2 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span class="text-xs font-medium">Drag untuk pindah</span>
                    </div>
                    <span class="text-xs font-semibold text-gray-500">Urutan: {{ $item->urutan }}</span>
                </div>

                <!-- Photo -->
                <div class="relative">
                    @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" 
                        class="w-full h-full object-cover object-top">
                    @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-20 h-20 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <p class="text-sm text-gray-500 mt-2">Tidak ada foto</p>
                        </div>
                    </div>
                    @endif

                    <!-- Badge Jabatan -->
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 bg-desa-gold text-white text-xs font-bold rounded-full shadow-lg">
                            {{ $item->jabatan }}
                        </span>
                    </div>

                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 {{ $item->status == 'Aktif' ? 'bg-green-500' : 'bg-gray-500' }} text-white text-xs font-bold rounded-full shadow-lg">
                            {{ $item->status }}
                        </span>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-4">
                    <h4 class="font-bold text-lg text-gray-800 mb-1">{{ $item->nama }}</h4>
                    <p class="text-sm text-gray-600 mb-3">{{ $item->jabatan }}</p>
                    
                    @if($item->nip)
                    <div class="flex items-center text-xs text-gray-500 mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                        </svg>
                        NIP: {{ $item->nip }}
                    </div>
                    @endif

                    @if($item->pendidikan)
                    <div class="flex items-center text-xs text-gray-500 mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                        {{ $item->pendidikan }}
                    </div>
                    @endif

                    @if($item->no_hp)
                    <div class="flex items-center text-xs text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $item->no_hp }}
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-2">
                    <!-- Edit -->
                    <a href="{{ route('admin.struktur.edit', $item->id) }}" 
                        class="p-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.struktur.destroy', $item->id) }}" method="POST" class="inline"
                        onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama }} dari struktur?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-lg font-medium">Belum ada struktur organisasi</p>
            <p class="text-sm mt-1">Klik tombol "Tambah Jabatan" untuk menambah anggota struktur</p>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableContainer = document.getElementById('sortable-struktur');
    
    if (sortableContainer) {
        new Sortable(sortableContainer, {
            animation: 150,
            ghostClass: 'bg-blue-50',
            chosenClass: 'ring-2 ring-desa-gold',
            dragClass: 'opacity-50',
            handle: '.struktur-card',
            
            onEnd: function(evt) {
                // Get new order
                const items = sortableContainer.querySelectorAll('.struktur-card');
                const order = Array.from(items).map((item, index) => ({
                    id: item.dataset.id,
                    urutan: index + 1
                }));
                
                // Send to server
                fetch('{{ route("admin.struktur.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update urutan display
                        items.forEach((item, index) => {
                            const urutanSpan = item.querySelector('.text-xs.font-semibold');
                            if (urutanSpan) {
                                urutanSpan.textContent = 'Urutan: ' + (index + 1);
                            }
                        });
                        
                        // Show success notification (optional)
                        console.log('Urutan berhasil diupdate');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menyimpan urutan. Silakan refresh halaman.');
                });
            }
        });
    }
});
</script>
@endpush