@extends('layout.admin')

@section('title', 'Tambah Template Surat')
@section('page-title', 'Tambah Template Surat')
@section('page-subtitle', 'Buat template surat baru dengan sistem Find & Replace')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Template Surat</h3>
            <p class="text-sm text-gray-500 mt-1">Gunakan [PLACEHOLDER] untuk data yang akan otomatis diganti</p>
        </div>

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

                    {{-- ============================================================
                         TAMBAHAN: SECTION TTD PEMOHON — tempel di bawah penandatangan
                    ============================================================ --}}
                    <div class="border border-blue-200 rounded-lg p-4 bg-blue-50">
                        <h4 class="font-semibold text-blue-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6H9v-2l6-6z"/>
                            </svg>
                            Tanda Tangan Pemohon
                        </h4>

                        {{-- Toggle aktif/nonaktif TTD pemohon --}}
                        <div class="mb-4">
                            <label class="flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="butuh_ttd_pemohon" value="1" id="toggle_ttd_pemohon"
                                    {{ old('butuh_ttd_pemohon') ? 'checked' : '' }}
                                    onchange="toggleTtdPemohon(this)"
                                    class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm font-medium text-gray-800">
                                    Surat ini membutuhkan tanda tangan pemohon
                                </span>
                            </label>
                            <p class="mt-1 ml-6 text-xs text-gray-500">
                                Jika dicentang, kolom TTD pemohon akan muncul di sebelah kiri TTD Kepala Desa saat dicetak.
                            </p>
                        </div>

                        {{-- Sub-opsi (tampil hanya jika checkbox dicentang) --}}
                        <div id="ttd_pemohon_options" class="{{ old('butuh_ttd_pemohon') ? '' : 'hidden' }} space-y-4 pl-2 border-l-2 border-blue-300 ml-1">

                            {{-- Label TTD pemohon --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Label Kolom Tanda Tangan
                                </label>
                                <input type="text" name="label_ttd_pemohon"
                                    value="{{ old('label_ttd_pemohon', 'Pemohon') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 text-sm"
                                    placeholder="Contoh: Pemohon / Yang Bersangkutan / Penerima"
                                    oninput="updatePreviewLabel(this.value)">
                                <p class="mt-1 text-xs text-gray-500">
                                    Label ini tampil di atas kolom TTD saat dicetak.
                                </p>
                            </div>

                            {{-- Toggle tampil nama --}}
                            <div>
                                <label class="flex items-center cursor-pointer select-none">
                                    <input type="checkbox" name="tampil_nama_pemohon" value="1"
                                        {{ old('tampil_nama_pemohon', true) ? 'checked' : '' }}
                                        onchange="togglePreviewNama(this)"
                                        class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">
                                        Tampilkan nama pemohon di bawah garis tanda tangan
                                    </span>
                                </label>
                                <p class="mt-1 ml-6 text-xs text-gray-500">
                                    Nama diambil otomatis dari data pemohon saat surat digenerate.
                                </p>
                            </div>

                            {{-- Preview posisi TTD --}}
                            <div class="mt-3 p-3 bg-white border border-dashed border-blue-300 rounded-lg">
                                <p class="text-xs font-semibold text-gray-500 mb-3 uppercase tracking-wide">
                                    Preview posisi TTD di surat cetak:
                                </p>
                                <div class="flex gap-4 text-xs text-gray-700">
                                    {{-- Kolom kiri: TTD Pemohon --}}
                                    <div class="flex-1 text-center border border-dashed border-blue-300 rounded p-2 bg-blue-50">
                                        <p class="font-semibold text-blue-700" id="preview_label_ttd">Pemohon,</p>
                                        <div class="my-5 border-b border-blue-400 w-3/4 mx-auto"></div>
                                        <p class="text-blue-600 italic text-xs" id="preview_nama_ttd">( Nama Pemohon )</p>
                                    </div>
                                    {{-- Kolom kanan: TTD Kepala Desa --}}
                                    <div class="flex-1 text-center">
                                        <p class="font-semibold">Mengetahui,</p>
                                        <p class="text-gray-500 text-xs">Kepala Desa</p>
                                        <div class="my-5 border-b border-gray-400 w-3/4 mx-auto"></div>
                                        <p class="font-semibold">( Nama Kepala Desa )</p>
                                        <p class="text-gray-400 text-xs">NIP. xxxxxxxx</p>
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-center text-blue-500 italic">
                                    Area biru = kolom TTD pemohon (kosong saat dicetak, untuk ditandatangani secara fisik)
                                </p>
                            </div>

                        </div>
                    </div>
                    {{-- ============================================================
                         AKHIR SECTION TTD PEMOHON
                    ============================================================ --}}

                    {{-- ============================================================
                         TAMBAHAN: MASA BERLAKU DEFAULT TEMPLATE
                    ============================================================ --}}
                    <div class="border border-amber-200 rounded-lg p-4 bg-amber-50">
                        <h4 class="font-semibold text-amber-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Masa Berlaku Default
                        </h4>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Masa Berlaku Surat
                            </label>
                            <select name="masa_berlaku_default"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-400 text-sm bg-white">
                                @foreach(\App\Models\TemplateSurat::pilihanMasaBerlaku() as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old('masa_berlaku_default', '') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-amber-700">
                                Pilih masa berlaku default untuk template ini. Nilai ini otomatis muncul saat admin memverifikasi surat, namun tetap bisa diubah per surat.
                                Pilih <strong>"Tidak ada masa berlaku"</strong> jika surat tidak menggunakan masa berlaku (contoh: Surat Kematian, Surat Kelahiran).
                            </p>
                        </div>

                        <div class="mt-3 p-3 bg-white border border-dashed border-amber-300 rounded-lg text-xs text-gray-600">
                            <p class="font-semibold text-amber-800 mb-1">Cara menggunakan di template:</p>
                            <p>Tambahkan <code class="bg-amber-100 px-1 rounded font-mono">[BERLAKU]</code> di isi template untuk menampilkan rentang tanggal masa berlaku secara otomatis.</p>
                            <p class="mt-1 text-gray-400">Contoh: <code class="bg-gray-100 px-1 rounded">Berlaku : [BERLAKU]</code> → <em>09 Maret 2026 s/d 09 April 2026</em></p>
                        </div>
                    </div>
                    {{-- ============================================================
                         AKHIR SECTION MASA BERLAKU DEFAULT
                    ============================================================ --}}

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
                                                title="{{ $description }} — Klik untuk copy">{{ $placeholder }}</code>
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
        alert('Placeholder ' + placeholder + ' berhasil di-copy!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}

// Tampilkan/sembunyikan sub-opsi TTD pemohon
function toggleTtdPemohon(checkbox) {
    document.getElementById('ttd_pemohon_options').classList.toggle('hidden', !checkbox.checked);
}

// Update preview label TTD pemohon secara live
function updatePreviewLabel(value) {
    document.getElementById('preview_label_ttd').textContent = (value || 'Pemohon') + ',';
}

// Toggle visibilitas nama di preview
function togglePreviewNama(checkbox) {
    document.getElementById('preview_nama_ttd').style.visibility = checkbox.checked ? 'visible' : 'hidden';
}
</script>
@endpush