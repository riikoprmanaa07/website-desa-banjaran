@extends('layout.admin')

@section('title', 'Buat Surat')
@section('page-title', 'Buat Surat Baru')
@section('page-subtitle', 'Tambah surat menyurat desa')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Surat</h3>
            <p class="text-sm text-gray-500 mt-1">Isi semua data dengan lengkap dan benar</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.surat.store') }}" method="POST" class="p-6">
            @csrf

            <!-- Section: Informasi Surat -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Informasi Surat</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nomor Surat -->
                    <div>
                         <label class="block text-sm font-medium text-gray-700 mb-2">
                         Nomor Surat
                            </label>
                    <input type="text" 
                    value="Akan dibuat otomatis saat disimpan"
                    readonly
                    class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-500">
                 </div>


                    <!-- Jenis Surat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_surat" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('jenis_surat') border-red-500 @enderror">
                            <option value="">Pilih Jenis Surat</option>
                            <option value="Surat Keterangan" {{ old('jenis_surat') == 'Surat Keterangan' ? 'selected' : '' }}>Surat Keterangan</option>
                            <option value="Surat Domisili" {{ old('jenis_surat') == 'Surat Domisili' ? 'selected' : '' }}>Surat Domisili</option>
                            <option value="Surat Pengantar" {{ old('jenis_surat') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                            <option value="SKCK" {{ old('jenis_surat') == 'SKCK' ? 'selected' : '' }}>SKCK</option>
                            <option value="Surat Kematian" {{ old('jenis_surat') == 'Surat Kematian' ? 'selected' : '' }}>Surat Kematian</option>
                            <option value="Surat Kelahiran" {{ old('jenis_surat') == 'Surat Kelahiran' ? 'selected' : '' }}>Surat Kelahiran</option>
                            <option value="Surat Usaha" {{ old('jenis_surat') == 'Surat Usaha' ? 'selected' : '' }}>Surat Usaha</option>
                            <option value="Surat Tidak Mampu" {{ old('jenis_surat') == 'Surat Tidak Mampu' ? 'selected' : '' }}>Surat Tidak Mampu</option>
                            <option value="Lainnya" {{ old('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Surat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', date('Y-m-d')) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('tanggal_surat') border-red-500 @enderror">
                        @error('tanggal_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penandatangan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Penandatangan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="penandatangan" value="{{ old('penandatangan', 'Kepala Desa Banjaran') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('penandatangan') border-red-500 @enderror"
                            placeholder="Nama penandatangan">
                        @error('penandatangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Section: Data Pemohon -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Data Pemohon</h4>
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Pilih Penduduk -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pemohon <span class="text-red-500">*</span>
                        </label>
                        <select name="penduduk_id" id="penduduk_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('penduduk_id') border-red-500 @enderror">
                            <option value="">Pilih Penduduk</option>
                            @foreach($penduduk as $p)
                            <option value="{{ $p->id }}" {{ old('penduduk_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }} - NIK: {{ $p->nik }}
                            </option>
                            @endforeach
                        </select>
                        @error('penduduk_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Pilih nama pemohon surat dari data penduduk</p>
                    </div>

                    <!-- Preview Data Pemohon (Optional - dengan JavaScript) -->
                    <div id="preview-pemohon" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm font-medium text-blue-800 mb-2">Data Pemohon:</p>
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-blue-600">NIK:</span>
                                <span class="text-blue-900 font-medium ml-2" id="preview-nik">-</span>
                            </div>
                            <div>
                                <span class="text-blue-600">Nama:</span>
                                <span class="text-blue-900 font-medium ml-2" id="preview-nama">-</span>
                            </div>
                            <div>
                                <span class="text-blue-600">Alamat:</span>
                                <span class="text-blue-900 font-medium ml-2" id="preview-alamat">-</span>
                            </div>
                            <div>
                                <span class="text-blue-600">RT/RW:</span>
                                <span class="text-blue-900 font-medium ml-2" id="preview-rtrw">-</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Section: Keperluan -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Keperluan Surat</h4>
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Keperluan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Keperluan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="keperluan" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('keperluan') border-red-500 @enderror"
                            placeholder="Jelaskan keperluan surat secara detail...">{{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Contoh: Untuk melamar pekerjaan di PT. ABC</p>
                    </div>


                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.surat.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition duration-200">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Surat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Preview data pemohon (optional enhancement)
document.getElementById('penduduk_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const text = selectedOption.text;
    
    if (this.value) {
        // Extract NIK from option text
        const nik = text.split('NIK: ')[1];
        const nama = text.split(' - NIK:')[0];
        
        // Show preview (you can enhance this with AJAX to fetch full data)
        document.getElementById('preview-pemohon').classList.remove('hidden');
        document.getElementById('preview-nik').textContent = nik;
        document.getElementById('preview-nama').textContent = nama;
    } else {
        document.getElementById('preview-pemohon').classList.add('hidden');
    }
});
</script>
@endpush