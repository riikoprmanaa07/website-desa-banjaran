@extends('layout.admin')

@section('title', 'Edit Template Surat')
@section('page-title', 'Edit Template Surat')
@section('page-subtitle', 'Update template surat')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Edit Template: {{ $template->nama_template }}</h3>
        </div>

        <form action="{{ route('admin.template-surat.update', $template->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Template <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_template" value="{{ old('nama_template', $template->nama_template) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_surat" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="Surat Keterangan" {{ $template->jenis_surat == 'Surat Keterangan' ? 'selected' : '' }}>Surat Keterangan</option>
                            <option value="Surat Domisili" {{ $template->jenis_surat == 'Surat Domisili' ? 'selected' : '' }}>Surat Domisili</option>
                            <option value="SKCK" {{ $template->jenis_surat == 'SKCK' ? 'selected' : '' }}>SKCK</option>
                            <option value="Surat Kematian" {{ $template->jenis_surat == 'Surat Kematian' ? 'selected' : '' }}>Surat Kematian</option>
                            <option value="Surat Kelahiran" {{ $template->jenis_surat == 'Surat Kelahiran' ? 'selected' : '' }}>Surat Kelahiran</option>
                            <option value="Surat Usaha" {{ $template->jenis_surat == 'Surat Usaha' ? 'selected' : '' }}>Surat Usaha</option>
                            <option value="Surat Tidak Mampu" {{ $template->jenis_surat == 'Surat Tidak Mampu' ? 'selected' : '' }}>Surat Tidak Mampu</option>
                            <option value="Lainnya" {{ $template->jenis_surat == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kop Surat <span class="text-red-500">*</span></label>
                        <textarea name="kop_surat" rows="3" required class="w-full px-4 py-2 border rounded-lg font-mono text-sm">{{ old('kop_surat', $template->kop_surat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Surat <span class="text-red-500">*</span></label>
                        <input type="text" name="judul_surat" value="{{ old('judul_surat', $template->judul_surat) }}" required class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pembuka <span class="text-red-500">*</span></label>
                        <textarea name="pembuka" rows="4" required class="w-full px-4 py-2 border rounded-lg font-mono text-sm">{{ old('pembuka', $template->pembuka) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Template <span class="text-red-500">*</span></label>
                        <textarea name="isi_template" rows="12" required class="w-full px-4 py-2 border rounded-lg font-mono text-sm">{{ old('isi_template', $template->isi_template) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penutup</label>
                        <textarea name="penutup" rows="3" class="w-full px-4 py-2 border rounded-lg font-mono text-sm">{{ old('penutup', $template->penutup) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan Penandatangan <span class="text-red-500">*</span></label>
                            <input type="text" name="penandatangan_jabatan" value="{{ old('penandatangan_jabatan', $template->penandatangan_jabatan) }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penandatangan <span class="text-red-500">*</span></label>
                            <input type="text" name="penandatangan_nama" value="{{ old('penandatangan_nama', $template->penandatangan_nama) }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">NIP</label>
                            <input type="text" name="penandatangan_nip" value="{{ old('penandatangan_nip', $template->penandatangan_nip) }}" class="w-full px-4 py-2 border rounded-lg">
                        </div>
                    </div>

                    {{-- ============================================================
                         TAMBAHAN: SECTION TTD PEMOHON
                         Sisipkan di antara bagian Penandatangan dan Status Aktif
                         Perbedaan dengan create: value diambil dari $template->...
                    ============================================================ --}}
                    <div class="border border-blue-200 rounded-lg p-4 bg-blue-50">
                        <h4 class="font-semibold text-blue-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6H9v-2l6-6z"/>
                            </svg>
                            Tanda Tangan Pemohon
                        </h4>

                        {{-- Toggle aktif/nonaktif — value diambil dari $template->butuh_ttd_pemohon --}}
                        <div class="mb-4">
                            <label class="flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="butuh_ttd_pemohon" value="1"
                                    id="toggle_ttd_pemohon"
                                    {{ old('butuh_ttd_pemohon', $template->butuh_ttd_pemohon) ? 'checked' : '' }}
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

                        {{-- Sub-opsi: tampil jika checkbox dicentang --}}
                        <div id="ttd_pemohon_options"
                            class="{{ old('butuh_ttd_pemohon', $template->butuh_ttd_pemohon) ? '' : 'hidden' }} space-y-4 pl-2 border-l-2 border-blue-300 ml-1">

                            {{-- Label TTD pemohon — value dari $template->label_ttd_pemohon --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Label Kolom Tanda Tangan
                                </label>
                                <input type="text" name="label_ttd_pemohon"
                                    value="{{ old('label_ttd_pemohon', $template->label_ttd_pemohon ?? 'Pemohon') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 text-sm"
                                    placeholder="Contoh: Pemohon / Yang Bersangkutan / Penerima"
                                    oninput="updatePreviewLabel(this.value)">
                                <p class="mt-1 text-xs text-gray-500">
                                    Label ini tampil di atas kolom TTD saat dicetak.
                                </p>
                            </div>

                            {{-- Toggle tampil nama — value dari $template->tampil_nama_pemohon --}}
                            <div>
                                <label class="flex items-center cursor-pointer select-none">
                                    <input type="checkbox" name="tampil_nama_pemohon" value="1"
                                        {{ old('tampil_nama_pemohon', $template->tampil_nama_pemohon ?? true) ? 'checked' : '' }}
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
                                        <p class="font-semibold text-blue-700" id="preview_label_ttd">
                                            {{ old('label_ttd_pemohon', $template->label_ttd_pemohon ?? 'Pemohon') }},
                                        </p>
                                        <div class="my-5 border-b border-blue-400 w-3/4 mx-auto"></div>
                                        <p class="text-blue-600 italic text-xs" id="preview_nama_ttd"
                                            style="visibility: {{ old('tampil_nama_pemohon', $template->tampil_nama_pemohon ?? true) ? 'visible' : 'hidden' }}">
                                            ( Nama Pemohon )
                                        </p>
                                    </div>
                                    {{-- Kolom kanan: TTD Kepala Desa --}}
                                    <div class="flex-1 text-center">
                                        <p class="font-semibold">Mengetahui,</p>
                                        <p class="text-gray-500 text-xs">{{ $template->penandatangan_jabatan }}</p>
                                        <div class="my-5 border-b border-gray-400 w-3/4 mx-auto"></div>
                                        <p class="font-semibold">{{ $template->penandatangan_nama }}</p>
                                        @if($template->penandatangan_nip)
                                            <p class="text-gray-400 text-xs">NIP. {{ $template->penandatangan_nip }}</p>
                                        @endif
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
                                        {{ old('masa_berlaku_default', $template->masa_berlaku_default ?? '') == $value ? 'selected' : '' }}>
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

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="aktif" value="1"
                                {{ old('aktif', $template->aktif) ? 'checked' : '' }}
                                class="rounded border-gray-300">
                            <span class="ml-2 text-sm">Template Aktif</span>
                        </label>
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-6 bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <h4 class="font-bold text-purple-900 mb-3">Placeholder Tersedia</h4>
                        <div class="space-y-4 text-sm">
                            @foreach($placeholders as $category => $items)
                            <div>
                                <p class="font-semibold text-purple-900 mb-2">{{ $category }}</p>
                                <div class="space-y-1">
                                    @foreach($items as $placeholder => $description)
                                    <code class="block bg-purple-100 text-purple-800 px-2 py-0.5 rounded text-xs font-mono cursor-pointer hover:bg-purple-200 transition"
                                        onclick="copyPlaceholder('{{ $placeholder }}')"
                                        title="{{ $description }} — Klik untuk copy">{{ $placeholder }}</code>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pt-4 border-t border-purple-300">
                            <p class="text-xs text-purple-700">💡 <strong>Tip:</strong> Klik placeholder untuk copy ke clipboard</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-8 pt-6 border-t">
                <button type="button" onclick="confirmDelete()" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                    Hapus Template
                </button>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.template-surat.index') }}" class="px-6 py-2.5 border rounded-lg hover:bg-gray-50">Batal</a>
                    <button type="submit" class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg">Update</button>
                </div>
            </div>
        </form>

        <form id="delete-form" action="{{ route('admin.template-surat.destroy', $template->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Yakin hapus template ini?')) {
        document.getElementById('delete-form').submit();
    }
}

function copyPlaceholder(placeholder) {
    navigator.clipboard.writeText(placeholder).then(function() {
        alert('Placeholder ' + placeholder + ' berhasil di-copy!');
    });
}

// Tampilkan/sembunyikan sub-opsi TTD pemohon
function toggleTtdPemohon(checkbox) {
    document.getElementById('ttd_pemohon_options').classList.toggle('hidden', !checkbox.checked);
}

// Update label preview secara live
function updatePreviewLabel(value) {
    document.getElementById('preview_label_ttd').textContent = (value || 'Pemohon') + ',';
}

// Toggle visibilitas nama di preview
function togglePreviewNama(checkbox) {
    document.getElementById('preview_nama_ttd').style.visibility = checkbox.checked ? 'visible' : 'hidden';
}
</script>
@endpush
@endsection