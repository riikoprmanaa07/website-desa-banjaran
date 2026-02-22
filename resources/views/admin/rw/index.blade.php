@extends('layout.admin')

@section('title', 'Data RW')
@section('page-title', 'Data Rukun Warga (RW)')
@section('page-subtitle', 'Kelola data RW Desa Banjaran')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar RW</h3>
            <p class="text-sm text-gray-500">Total: {{ $rw->total() }} RW</p>
        </div>
        <a href="{{ route('admin.rw.create') }}" class="bg-desa-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah RW
        </a>
    </div>

    <!-- Statistics -->
    <div class="px-6 py-4 bg-gray-50 border-b grid grid-cols-4 gap-4">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-blue-800">{{ $rw->count() }}</p>
            <p class="text-sm text-blue-600">Total RW</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-green-800">{{ $rw->sum('rt_count') }}</p>
            <p class="text-sm text-green-600">Total RT</p>
        </div>
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-purple-800">{{ number_format($rw->sum('jumlah_kk')) }}</p>
            <p class="text-sm text-purple-600">Total KK</p>
        </div>
        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-orange-800">{{ number_format($rw->sum('jumlah_penduduk')) }}</p>
            <p class="text-sm text-orange-600">Total Penduduk</p>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RW</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketua RW</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah RT</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah KK</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Penduduk</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rw as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-lg">{{ $item->nomor_rw }}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-gray-900">RW {{ str_pad($item->nomor_rw, 3, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $item->nama_ketua }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->no_hp)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $item->no_hp }}
                        </div>
                        @else
                        <span class="text-sm text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600">{{ $item->alamat ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $item->rt_count ?? 0 }} RT
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="text-sm font-semibold text-gray-900">{{ number_format($item->jumlah_kk) }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="text-sm font-semibold text-gray-900">{{ number_format($item->jumlah_penduduk) }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <!-- Edit -->
                            <a href="{{ route('admin.rw.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.rw.destroy', $item->id) }}" method="POST" class="inline" 
                                onsubmit="return confirm('Yakin ingin menghapus RW {{ $item->nomor_rw }}?\n\n{{ $item->rt_count > 0 ? 'RW ini masih memiliki ' . $item->rt_count . ' RT. Hapus RT terlebih dahulu!' : 'Data yang sudah dihapus tidak dapat dikembalikan!' }}')">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-lg font-medium">Belum ada data RW</p>
                            <p class="text-sm mt-1">Klik tombol "Tambah RW" untuk menambah data</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($rw->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $rw->links() }}
    </div>
    @endif
</div>
@endsection