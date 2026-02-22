@extends('layout.admin')

@section('title', 'Tambah Template Surat')
@section('page-title', 'Tambah Template Surat')
@section('page-subtitle', 'Buat template surat baru dengan sistem Find & Replace')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Template Surat</h3>
            <p class="text-sm text-gray-500 mt-1">Gunakan [PLACEHOLDER] untuk data yang akan otomatis diganti</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.template-surat.store') }}" method="POST" class="p-6">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column: Form Fields -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Nama Template -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Template <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_template" value="{{ old('nama_template') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('nama_template') border-red-500 @enderror"
                            placeholder="Contoh: Template Surat Keterangan Standar">
                        @error('nama_template')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                            <option value="SKCK" {{ old('jenis_surat') == 'SKCK' ? 'selected' : '' }}>SKCK (Surat Keterangan Catatan Kepolisian)</option>
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

                    <!-- Kop Surat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kop Surat (Header) <span class="text-red-500">*</span>
                        </label>
                        <textarea name="kop_surat" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold font-mono text-sm @error('kop_surat') border-red-500 @enderror"
                            placeholder="PEMERINTAH DESA BANJARAN&#10;KECAMATAN XXX - KABUPATEN XXX&#10;Alamat: Jl. Desa Banjaran No. 123">{{ old('kop_surat') }}</textarea>
                        @error('kop_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul Surat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul_surat" value="{{ old('judul_surat') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('judul_surat') border-red-500 @enderror"
                            placeholder="Contoh: SURAT KETERANGAN DOMISILI">
                        @error('judul_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pembuka -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pembuka Surat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="pembuka" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold font-mono text-sm @error('pembuka') border-red-500 @enderror"
                            placeholder="Yang bertanda tangan di bawah ini:&#10;Nama    : [PENANDATANGAN_NAMA]&#10;Jabatan : [PENANDATANGAN_JABATAN]&#10;&#10;Menerangkan bahwa:">{{ old('pembuka') }}</textarea>
                        @error('pembuka')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Isi Template -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Isi Template <span class="text-red-500">*</span>
                        </label>
                        <textarea name="isi_template" rows="12" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold font-mono text-sm @error('isi_template') border-red-500 @enderror"
                            placeholder="Nama    : [NAMA_PENDUDUK]&#10;NIK     : [NIK]&#10;Tempat/Tgl Lahir: [TEMPAT_LAHIR], [TANGGAL_LAHIR]&#10;Alamat  : [ALAMAT]&#10;RT/RW   : [RT]/[RW]&#10;Pekerjaan: [PEKERJAAN]&#10;&#10;Adalah benar penduduk Desa Banjaran dan bertempat tinggal di alamat tersebut di atas.&#10;&#10;Surat keterangan ini dibuat untuk keperluan: [KEPERLUAN]">{{ old('isi_template') }}</textarea>
                        @error('isi_template')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penutup -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Penutup Surat
                        </label>
                        <textarea name="penutup" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold font-mono text-sm @error('penutup') border-red-500 @enderror"
                            placeholder="Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.">{{ old('penutup') }}</textarea>
                        @error('penutup')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penandatangan -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jabatan Penandatangan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="penandatangan_jabatan" value="{{ old('penandatangan_jabatan', 'Kepala Desa') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('penandatangan_jabatan') border-red-500 @enderror">
                            @error('penandatangan_jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Penandatangan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="penandatangan_nama" value="{{ old('penandatangan_nama') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold @error('penandatangan_nama') border-red-500 @enderror">
                            @error('penandatangan_nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                NIP Penandatangan
                            </label>
                            <input type="text" name="penandatangan_nip" value="{{ old('penandatangan_nip') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                        </div>
                    </div>

                    <!-- Status Aktif -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="aktif" value="1" {{ old('aktif', true) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-desa-gold focus:ring-desa-gold">
                            <span class="ml-2 text-sm text-gray-700">Template Aktif</span>
                        </label>
                    </div>

                </div>

                <!-- Right Column: Placeholder Guide -->
                <div class="lg:col-span-1">
                    <div class="sticky top-6">
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <h4 class="font-bold text-purple-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                                Placeholder Tersedia
                            </h4>
                            
                            <div class="space-y-4 text-sm">
                                @foreach($placeholders as $category => $items)
                                <div>
                                    <p class="font-semibold text-purple-900 mb-2">{{ $category }}</p>
                                    <div class="space-y-1">
                                        @foreach($items as $placeholder => $description)
                                        <div class="flex items-start">
                                            <code class="bg-purple-100 text-purple-800 px-2 py-0.5 rounded text-xs font-mono cursor-pointer hover:bg-purple-200 transition"
                                                onclick="copyPlaceholder('{{ $placeholder }}')"
                                                title="Klik untuk copy">{{ $placeholder }}</code>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-4 pt-4 border-t border-purple-300">
                                <p class="text-xs text-purple-700">
                                    💡 <strong>Tip:</strong> Klik placeholder untuk copy ke clipboard
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.template-surat.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition">
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Template
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyPlaceholder(placeholder) {
    navigator.clipboard.writeText(placeholder).then(function() {
        // Show toast notification (optional)
        alert('Placeholder ' + placeholder + ' berhasil di-copy!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endpush