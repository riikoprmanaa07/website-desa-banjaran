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

            <!-- STEP 1: PILIH PENDUDUK -->
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h4 class="font-bold text-blue-900 mb-3">📋 Step 1: Pilih Penduduk</h4>
                
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

                <!-- Info Penduduk (Hidden by default) -->
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

            <!-- STEP 2: PILIH TEMPLATE -->
            <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-lg">
                <h4 class="font-bold text-purple-900 mb-3">📝 Step 2: Pilih Template Surat</h4>
                
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

                <!-- Jenis Surat (Auto filled from template) -->
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

            <!-- STEP 3: DATA SURAT -->
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <h4 class="font-bold text-green-900 mb-3">✍️ Step 3: Data Surat</h4>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold"
                            placeholder="001/SK/DS/II/2024">
                        @error('nomor_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', date('Y-m-d')) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold">
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

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Keterangan Tambahan
                    </label>
                    <textarea name="keterangan" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-desa-gold"
                        placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold">Cara Kerja:</p>
                        <ol class="list-decimal list-inside mt-2 space-y-1">
                            <li>Pilih penduduk yang akan dibuatkan surat</li>
                            <li>Pilih template surat yang sesuai</li>
                            <li>Isi nomor surat, tanggal, dan keperluan</li>
                            <li>System akan otomatis mengisi data penduduk ke template</li>
                            <li>Surat siap dicetak!</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
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
// Show penduduk info when selected
function showPendudukInfo() {
    const select = document.getElementById('penduduk_id');
    const option = select.options[select.selectedIndex];
    
    if (option.value) {
        document.getElementById('penduduk-info').classList.remove('hidden');
        document.getElementById('info-nama').textContent = option.dataset.nama;
        document.getElementById('info-nik').textContent = option.dataset.nik;
        document.getElementById('info-alamat').textContent = option.dataset.alamat;
        document.getElementById('info-rtrw').textContent = option.dataset.rt + '/' + option.dataset.rw;
    } else {
        document.getElementById('penduduk-info').classList.add('hidden');
    }
}

// Update jenis surat from template
function updateJenisSurat() {
    const select = document.getElementById('template_id');
    const option = select.options[select.selectedIndex];
    
    if (option.value) {
        document.getElementById('jenis_surat').value = option.dataset.jenis;
    } else {
        document.getElementById('jenis_surat').value = '';
    }
}
</script>
@endpush