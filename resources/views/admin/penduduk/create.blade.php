@extends('layout.admin')

@section('title', 'Tambah Penduduk')
@section('page-title', 'Tambah Penduduk')
@section('page-subtitle', 'Tambah data penduduk baru')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Data Penduduk</h3>
            <p class="text-sm text-gray-500 mt-1">Isi semua data dengan lengkap dan benar</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.penduduk.store') }}" method="POST" class="p-6">
            @csrf

            <!-- Section: Data Identitas -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Data Identitas</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- NIK -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold focus:border-transparent @error('nik') border-red-500 @enderror"
                            placeholder="Masukkan 16 digit NIK">
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Nomor Induk Kependudukan (16 digit)</p>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('nama') border-red-500 @enderror"
                            placeholder="Nama lengkap sesuai KTP">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('tempat_lahir') border-red-500 @enderror"
                            placeholder="Kota/Kabupaten">
                        @error('tempat_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('tanggal_lahir') border-red-500 @enderror">
                        @error('tanggal_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_kelamin" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('jenis_kelamin') border-red-500 @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Agama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Agama <span class="text-red-500">*</span>
                        </label>
                        <select name="agama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('agama') border-red-500 @enderror">
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Section: Data Alamat -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Data Alamat</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('alamat') border-red-500 @enderror"
                            placeholder="Alamat lengkap (Nama Jalan, No. Rumah, dll)">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- RT -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            RT <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="rt" value="{{ old('rt') }}" maxlength="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('rt') border-red-500 @enderror"
                            placeholder="001">
                        @error('rt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Format: 001, 002, dst</p>
                    </div>

                    <!-- RW -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            RW <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="rw" value="{{ old('rw') }}" maxlength="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('rw') border-red-500 @enderror"
                            placeholder="001">
                        @error('rw')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Format: 001, 002, dst</p>
                    </div>

                </div>
            </div>

            <!-- Section: Data Lainnya -->
            <div class="mb-8">
                <h4 class="text-md font-bold text-gray-700 mb-4 pb-2 border-b">Data Lainnya</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Status Perkawinan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Perkawinan <span class="text-red-500">*</span>
                        </label>
                        <select name="status_perkawinan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('status_perkawinan') border-red-500 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                            <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                        @error('status_perkawinan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('pekerjaan') border-red-500 @enderror"
                            placeholder="Contoh: Petani, Wiraswasta, PNS">
                        @error('pekerjaan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                <!-- Pendidikan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pendidikan Terakhir <span class="text-red-500">*</span>
                        </label>
                        <select name="pendidikan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('pendidikan') border-red-500 @enderror">
                            <option value="">Pilih Pendidikan</option>
                            <option value="Tidak/Belum Sekolah" {{ old('pendidikan') == 'Tidak/Belum Sekolah' ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                            <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA/SMK" {{ old('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                        @error('pendidikan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kewarganegaraan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kewarganegaraan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', 'WNI') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                    </div>

                    <!-- No KK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            No. Kartu Keluarga
                        </label>
                        <input type="text" name="no_kk" value="{{ old('no_kk') }}" maxlength="16"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('no_kk') border-red-500 @enderror"
                            placeholder="16 digit nomor KK">
                        @error('no_kk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Dalam Keluarga -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Dalam Keluarga
                        </label>
                        <select name="status_dalam_keluarga"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                            <option value="">Pilih Status</option>
                            <option value="Kepala Keluarga" {{ old('status_dalam_keluarga') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                            <option value="Istri" {{ old('status_dalam_keluarga') == 'Istri' ? 'selected' : '' }}>Istri</option>
                            <option value="Anak" {{ old('status_dalam_keluarga') == 'Anak' ? 'selected' : '' }}>Anak</option>
                            <option value="Orang Tua" {{ old('status_dalam_keluarga') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                            <option value="Lainnya" {{ old('status_dalam_keluarga') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.penduduk.index') }}" 
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
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection