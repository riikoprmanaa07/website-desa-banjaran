@extends('layout.admin')

@section('title', 'Edit RT')
@section('page-title', 'Edit Data RT')
@section('page-subtitle', 'Update data Rukun Tetangga')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Edit Data RT {{ str_pad($rt->nomor_rt, 3, '0', STR_PAD_LEFT) }} / RW {{ str_pad($rt->rw->nomor_rw, 3, '0', STR_PAD_LEFT) }}</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $rt->nama_ketua }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.rt.update', $rt->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                
                <!-- RW -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih RW <span class="text-red-500">*</span>
                    </label>
                    <select name="rw_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('rw_id') border-red-500 @enderror">
                        <option value="">Pilih RW</option>
                        @foreach($rwList as $rwItem)
                        <option value="{{ $rwItem->id }}" {{ old('rw_id', $rt->rw_id) == $rwItem->id ? 'selected' : '' }}>
                            RW {{ str_pad($rwItem->nomor_rw, 3, '0', STR_PAD_LEFT) }} - {{ $rwItem->nama_ketua }}
                        </option>
                        @endforeach
                    </select>
                    @error('rw_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor RT -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor RT <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nomor_rt" value="{{ old('nomor_rt', $rt->nomor_rt) }}" maxlength="3" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent @error('nomor_rt') border-red-500 @enderror"
                        placeholder="Contoh: 001">
                    @error('nomor_rt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Ketua RT -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Ketua RT <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_ketua" value="{{ old('nama_ketua', $rt->nama_ketua) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('nama_ketua') border-red-500 @enderror"
                        placeholder="Nama lengkap Ketua RT">
                    @error('nama_ketua')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor HP/Telepon
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $rt->no_hp) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('no_hp') border-red-500 @enderror"
                        placeholder="08xx xxxx xxxx">
                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat Kantor RT
                    </label>
                    <textarea name="alamat" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('alamat') border-red-500 @enderror"
                        placeholder="Alamat lengkap kantor/sekretariat RT (opsional)">{{ old('alamat', $rt->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Statistics Display -->
            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-3">Statistik RT</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-purple-600">{{ number_format($rt->jumlah_kk) }}</p>
                        <p class="text-xs text-gray-600">Jumlah KK</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-blue-600">{{ number_format($rt->jumlah_penduduk) }}</p>
                        <p class="text-xs text-gray-600">Jumlah Penduduk</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3 text-center">Data dihitung otomatis dari database penduduk</p>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <!-- Delete Button -->
                <button type="button" onclick="confirmDelete()" 
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus RT
                </button>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.rt.index') }}" 
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
        <form id="delete-form" action="{{ route('admin.rt.destroy', $rt->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus RT {{ $rt->nomor_rt }} / RW {{ $rt->rw->nomor_rw }}?\n\nData yang sudah dihapus tidak dapat dikembalikan!')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush