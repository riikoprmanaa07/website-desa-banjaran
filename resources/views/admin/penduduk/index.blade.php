@extends('layout.admin')

@section('title', 'Data Penduduk')
@section('page-title', 'Data Penduduk')
@section('page-subtitle', 'Kelola data penduduk Desa Banjaran')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Penduduk</h3>
            <p class="text-sm text-gray-500">Total: {{ $penduduk->total() }} orang</p>
        </div>
        <a href="{{ route('admin.penduduk.create') }}" class="bg-desa-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Penduduk
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <form action="{{ route('admin.penduduk.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari NIK atau Nama..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent">
            </div>
            <select name="rt" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                <option value="">Semua RT</option>
                @for($i = 1; $i <= 10; $i++)
                <option value="{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}" {{ request('rt') == str_pad($i, 3, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                    RT {{ str_pad($i, 3, '0', STR_PAD_LEFT) }}
                </option>
                @endfor
            </select>
            <select name="gender" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                <option value="">Semua JK</option>
                <option value="L" {{ request('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ request('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                Cari
            </button>
            @if(request()->hasAny(['search', 'rt', 'gender']))
            <a href="{{ route('admin.penduduk.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RT/RW</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendidikan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($penduduk as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                        <div class="text-sm text-gray-500">{{ $item->agama }}</div>
                    </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->status_perkawinan }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->tempat_lahir }}, {{ $item->tanggal_lahir->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->rt }}/{{ $item->rw }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->pekerjaan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->pendidikan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.penduduk.show', $item->id) }}" class="text-blue-600 hover:text-blue-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.penduduk.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.penduduk.destroy', $item->id) }}" method="POST" class="inline" 
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
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
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data penduduk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($penduduk->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $penduduk->links() }}
    </div>
    @endif
</div>
@endsection