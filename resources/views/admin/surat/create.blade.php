@extends('layout.admin')

@section('title', 'Buat Surat')
@section('page-title', 'Buat Surat Baru')
@section('page-subtitle', 'Buat surat menggunakan template')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Form Buat Surat</h3>
        </div>

        <form action="{{ route('admin.surat.store') }}" method="POST" class="p-6">
            @csrf

            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h4 class="font-bold text-blue-900 mb-3">👤 Step 1: Pilih Penduduk</h4>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Penduduk <span class="text-red-500">*</span>
                    </label>
                    <select name="penduduk_id" id="penduduk_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold"
                        onchange="showPendudukInfo()">
                        <option value="">-- Pilih Penduduk --</option>
                        @foreach($penduduk as $p)
                        <option value="{{ $p->id }}"
                            data-nama="{{ $p->nama }}"
                            data-nik="{{ $p->nik }}"
                            data-alamat="{{ $p->alamat }}"
                            data-rt="{{ $p->rt }}"
                            data-rw="{{ $p->rw }}"
                            {{ old('penduduk_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }} - {{ $p->nik }}
                        </option>
                        @endforeach
                    </select>
                    @error('penduduk_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div id="penduduk-info" class="mt-4 p-3 bg-white rounded-lg border hidden">
                    <h5 class="font-semibold text-gray-800 mb-2">Data Penduduk:</h5>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div><span class="text-gray-600">Nama:</span> <span id="info-nama" class="font-medium"></span></div>
                        <div><span class="text-gray-600">NIK:</span> <span id="info-nik" class="font-medium"></span></div>
                        <div><span class="text-gray-600">Alamat:</span> <span id="info-alamat" class="font-medium"></span></div>
                        <div><span class="text-gray-600">RT/RW:</span> <span id="info-rtrw" class="font-medium"></span></div>
                    </div>
                </div>
            </div>

            <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-lg">
                <h4 class="font-bold text-purple-900 mb-3">📄 Step 2: Pilih Template Surat</h4>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Template <span class="text-red-500">*</span>
                    </label>
                    <select name="template_surat_id" id="template_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold"
                        onchange="updateJenisSurat()">
                        <option value="">-- Pilih Template --</option>
                        @foreach($templates as $template)
                        <option value="{{ $template->id }}"
                            data-jenis="{{ $template->jenis_surat }}"
                            {{ old('template_surat_id') == $template->id ? 'selected' : '' }}>
                            {{ $template->nama_template }} ({{ $template->jenis_surat }})
                        </option>
                        @endforeach
                    </select>
                    @error('template_surat_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-purple-700">
                        💡 Template berisi format surat yang akan otomatis diisi dengan data penduduk
                    </p>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Surat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jenis_surat" id="jenis_surat"
                        value="{{ old('jenis_surat') }}" required readonly
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100"
                        placeholder="Otomatis terisi dari template">
                </div>
            </div>

            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <h4 class="font-bold text-green-900 mb-3">📝 Step 3: Data Surat</h4>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Surat <span class="text-gray-400 font-normal italic">(Otomatis)</span>
                        </label>
                        {{-- PERUBAHAN: Input Nomor Surat Dibuat Readonly --}}
                        <input type="text" value="Akan di-generate otomatis oleh sistem" readonly
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed focus:outline-none">
                        <p class="mt-1 text-xs text-gray-500">Nomor surat akan berurutan secara otomatis setelah tombol Generate ditekan.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_surat" id="tanggal_surat"
                            value="{{ old('tanggal_surat', date('Y-m-d')) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold"
                            onchange="previewMasaBerlaku()">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Keperluan Surat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keperluan" rows="3" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold"
                        placeholder="Contoh: Pengurusan KTP, Pendaftaran Sekolah, dll">{{ old('keperluan') }}</textarea>
                    @error('keperluan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Keterangan Tambahan
                    </label>
                    <textarea name="keterangan" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold"
                        placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                </div>

                {{-- ============================================================
                     TAMBAHAN: MASA BERLAKU
                     Admin ketik bebas, preview otomatis tampil di bawah input
                ============================================================ --}}
                <div class="border border-green-300 rounded-lg p-4 bg-white">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Masa Berlaku Surat
                    </label>

                    {{-- Input bebas --}}
                    <input type="text" name="masa_berlaku" id="masa_berlaku"
                        value="{{ old('masa_berlaku') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold text-sm"
                        placeholder="Contoh: 1 bulan, 2 minggu, 3 bulan, 1 tahun"
                        oninput="previewMasaBerlaku()">

                    {{-- Tombol pintasan --}}
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach(['1 minggu', '1 bulan', '3 bulan', '6 bulan', '1 tahun'] as $pilihan)
                        <button type="button"
                            onclick="setPilihan('{{ $pilihan }}')"
                            class="px-3 py-1 text-xs border border-green-400 text-green-700 rounded-full hover:bg-green-100 transition">
                            {{ $pilihan }}
                        </button>
                        @endforeach
                    </div>

                    {{-- Preview rentang tanggal otomatis --}}
                    <div id="preview-berlaku" class="hidden mt-3 px-3 py-2 bg-green-50 border border-green-200 rounded-lg text-sm">
                        <span class="text-green-700">⏳ Berlaku: </span>
                        <span id="preview-berlaku-teks" class="font-semibold text-green-800"></span>
                    </div>

                    <p class="mt-2 text-xs text-gray-500">
                        Kosongkan jika surat tidak memiliki masa berlaku.
                        Sistem otomatis menghitung dari tanggal surat.
                    </p>
                    @error('masa_berlaku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- ============================================================
                     AKHIR MASA BERLAKU
                ============================================================ --}}

            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold">Cara Kerja:</p>
                        <ol class="list-decimal list-inside mt-2 space-y-1">
                            <li>Pilih penduduk yang akan dibuatkan surat</li>
                            <li>Pilih template surat yang sesuai</li>
                            <li>Isi tanggal, keperluan, dan masa berlaku (opsional)</li>
                            <li>Sistem akan men-generate nomor surat secara otomatis</li>
                            <li>Sistem otomatis mengisi data penduduk ke template</li>
                            <li>Surat siap dicetak!</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('admin.surat.index') }}"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-desa-gold hover:bg-yellow-600 text-white rounded-lg font-medium transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Generate Surat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
const bulanId = ['Januari','Februari','Maret','April','Mei','Juni',
                 'Juli','Agustus','September','Oktober','November','Desember'];

function formatTanggal(date) {
    const d = String(date.getDate()).padStart(2, '0');
    const b = bulanId[date.getMonth()];
    const y = date.getFullYear();
    return d + ' ' + b + ' ' + y;
}

// Hitung tanggal akhir dari input masa_berlaku
function hitungAkhir(tanggalMulai, masaBerlaku) {
    const input = masaBerlaku.toLowerCase().trim();
    const match = input.match(/(\d+)\s*(bulan|minggu|hari|tahun)?/);
    if (!match) return null;

    const angka  = parseInt(match[1]);
    const satuan = match[2] || 'hari';
    const hasil  = new Date(tanggalMulai);

    if (satuan === 'bulan')  hasil.setMonth(hasil.getMonth() + angka);
    else if (satuan === 'tahun') hasil.setFullYear(hasil.getFullYear() + angka);
    else if (satuan === 'minggu') hasil.setDate(hasil.getDate() + angka * 7);
    else hasil.setDate(hasil.getDate() + angka);

    return hasil;
}

function previewMasaBerlaku() {
    const masaBerlaku = document.getElementById('masa_berlaku').value.trim();
    const tanggalVal  = document.getElementById('tanggal_surat').value;
    const previewDiv  = document.getElementById('preview-berlaku');
    const previewTeks = document.getElementById('preview-berlaku-teks');

    if (!masaBerlaku || !tanggalVal) {
        previewDiv.classList.add('hidden');
        return;
    }

    const tanggalMulai = new Date(tanggalVal);
    const tanggalAkhir = hitungAkhir(tanggalMulai, masaBerlaku);

    if (!tanggalAkhir) {
        previewDiv.classList.add('hidden');
        return;
    }

    previewTeks.textContent = formatTanggal(tanggalMulai) + ' s/d ' + formatTanggal(tanggalAkhir);
    previewDiv.classList.remove('hidden');
}

// Tombol pintasan
function setPilihan(nilai) {
    document.getElementById('masa_berlaku').value = nilai;
    previewMasaBerlaku();
}

// Tampil info penduduk
function showPendudukInfo() {
    const select = document.getElementById('penduduk_id');
    const option = select.options[select.selectedIndex];
    if (option.value) {
        document.getElementById('penduduk-info').classList.remove('hidden');
        document.getElementById('info-nama').textContent   = option.dataset.nama;
        document.getElementById('info-nik').textContent    = option.dataset.nik;
        document.getElementById('info-alamat').textContent = option.dataset.alamat;
        document.getElementById('info-rtrw').textContent   = option.dataset.rt + '/' + option.dataset.rw;
    } else {
        document.getElementById('penduduk-info').classList.add('hidden');
    }
}

// Update jenis surat dari template
function updateJenisSurat() {
    const select = document.getElementById('template_id');
    const option = select.options[select.selectedIndex];
    document.getElementById('jenis_surat').value = option.value ? option.dataset.jenis : '';
}

// Jalankan preview saat halaman load (jika ada old value)
document.addEventListener('DOMContentLoaded', previewMasaBerlaku);
</script>
@endpush