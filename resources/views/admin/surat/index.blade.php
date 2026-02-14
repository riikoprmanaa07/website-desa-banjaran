@extends('layout.admin')

@section('title', 'Data Surat')
@section('page-title', 'Pengelolaan Surat')
@section('page-subtitle', 'Kelola surat-menyurat desa')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Surat</h3>
            <p class="text-sm text-gray-500">Total: {{ $surat->total() }} surat</p>
        </div>
        <a href="{{ route('admin.surat.create') }}" class="bg-desa-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Buat Surat
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <form action="{{ route('admin.surat.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari nomor surat, jenis, atau nama pemohon..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent">
            </div>

            <!-- Filter Status -->
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>

            <!-- Filter Jenis -->
            <select name="jenis" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                <option value="">Semua Jenis</option>
                <option value="Surat Keterangan" {{ request('jenis') == 'Surat Keterangan' ? 'selected' : '' }}>Surat Keterangan</option>
                <option value="Surat Domisili" {{ request('jenis') == 'Surat Domisili' ? 'selected' : '' }}>Surat Domisili</option>
                <option value="Surat Pengantar" {{ request('jenis') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                <option value="SKCK" {{ request('jenis') == 'SKCK' ? 'selected' : '' }}>SKCK</option>
                <option value="Surat Kematian" {{ request('jenis') == 'Surat Kematian' ? 'selected' : '' }}>Surat Kematian</option>
                <option value="Surat Kelahiran" {{ request('jenis') == 'Surat Kelahiran' ? 'selected' : '' }}>Surat Kelahiran</option>
                <option value="Lainnya" {{ request('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Cari
                </button>
                @if(request()->hasAny(['search', 'status', 'jenis']))
                <a href="{{ route('admin.surat.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="px-6 py-4 bg-gray-50 border-b grid grid-cols-4 gap-4">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-yellow-800">{{ $surat->where('status', 'Pending')->count() }}</p>
            <p class="text-xs text-yellow-600">Pending</p>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-blue-800">{{ $surat->where('status', 'Diproses')->count() }}</p>
            <p class="text-xs text-blue-600">Diproses</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-green-800">{{ $surat->where('status', 'Selesai')->count() }}</p>
            <p class="text-xs text-green-600">Selesai</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
            <p class="text-2xl font-bold text-red-800">{{ $surat->where('status', 'Ditolak')->count() }}</p>
            <p class="text-xs text-red-600">Ditolak</p>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Surat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Surat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($surat as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">{{ $item->nomor_surat }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-900">{{ $item->jenis_surat }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm">
                            <div class="font-medium text-gray-900">{{ $item->penduduk->nama }}</div>
                            <div class="text-gray-500">NIK: {{ $item->penduduk->nik }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->tanggal_surat->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $item->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $item->status == 'Diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $item->status == 'Selesai' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $item->status == 'Ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <!-- Quick Status Update -->
                            @if($item->status != 'Selesai' && $item->status != 'Ditolak')
                            <div class="relative group">
                                <button class="text-purple-600 hover:text-purple-900" title="Update Status">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-xl py-1 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 z-10">
                                    <form action="{{ route('admin.surat.update-status', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="status" value="Diproses" class="block w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">Diproses</button>
                                        <button type="submit" name="status" value="Selesai" class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-green-50">Selesai</button>
                                        <button type="submit" name="status" value="Ditolak" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Ditolak</button>
                                    </form>
                                </div>
                            </div>
                            @endif

                            <!-- View -->
                            <a href="{{ route('admin.surat.show', $item->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('admin.surat.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.surat.destroy', $item->id) }}" method="POST" class="inline" 
                                onsubmit="return confirm('Yakin ingin menghapus surat {{ $item->nomor_surat }}?\n\nData yang sudah dihapus tidak dapat dikembalikan!')">
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
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-lg font-medium">Belum ada data surat</p>
                            <p class="text-sm mt-1">Klik tombol "Buat Surat" untuk menambah data</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($surat->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $surat->links() }}
    </div>
    @endif
</div>
@endsection