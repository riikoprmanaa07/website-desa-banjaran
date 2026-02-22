@extends('layout.admin')

@section('title', 'Edit RW')
@section('page-title', 'Edit Data RW')
@section('page-subtitle', 'Update data Rukun Warga')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Edit Data RW {{ str_pad($rw->nomor_rw, 3, '0', STR_PAD_LEFT) }}</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $rw->nama_ketua }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.rw.update', $rw->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                
                <!-- Nomor RW -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor RW <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nomor_rw" value="{{ old('nomor_rw', $rw->nomor_rw) }}" maxlength="3" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent @error('nomor_rw') border-red-500 @enderror"
                        placeholder="Contoh: 001">
                    @error('nomor_rw')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Format: 001, 002, 003, dst (3 digit)</p>
                </div>

                <!-- Nama Ketua RW -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Ketua RW <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_ketua" value="{{ old('nama_ketua', $rw->nama_ketua) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('nama_ketua') border-red-500 @enderror"
                        placeholder="Nama lengkap Ketua RW">
                    @error('nama_ketua')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor HP/Telepon
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $rw->no_hp) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('no_hp') border-red-500 @enderror"
                        placeholder="08xx xxxx xxxx">
                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat Kantor RW
                    </label>
                    <textarea name="alamat" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('alamat') border-red-500 @enderror"
                        placeholder="Alamat lengkap kantor/sekretariat RW (opsional)">{{ old('alamat', $rw->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Statistics Display -->
            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-3">Statistik RW</h4>
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">{{ $rw->rt_count ?? 0 }}</p>
                        <p class="text-xs text-gray-600">Jumlah RT</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-purple-600">{{ number_format($rw->jumlah_kk) }}</p>
                        <p class="text-xs text-gray-600">Jumlah KK</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-blue-600">{{ number_format($rw->jumlah_penduduk) }}</p>
                        <p class="text-xs text-gray-600">Jumlah Penduduk</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3 text-center">Data dihitung otomatis dari database penduduk</p>
            </div>

            <!-- Warning if has RT -->
            @if($rw->rt_count > 0)
            <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Peringatan</h3>
                        <p class="mt-1 text-sm text-yellow-700">
                            RW ini memiliki {{ $rw->rt_count }} RT. Hapus semua RT terlebih dahulu sebelum menghapus RW.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <!-- Delete Button (disabled if has RT) -->
                @if($rw->rt_count > 0)
                <button type="button" disabled
                    class="px-6 py-2.5 bg-gray-400 text-white rounded-lg font-medium cursor-not-allowed opacity-50 flex items-center"
                    title="Tidak dapat menghapus RW yang masih memiliki RT">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Tidak Dapat Dihapus
                </button>
                @else
                <button type="button" onclick="confirmDelete()" 
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus RW
                </button>
                @endif

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.rw.index') }}" 
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Data
                    </button>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('admin.rw.destroy', $rw->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus RW {{ $rw->nomor_rw }}?\n\nData yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush