@extends('layout.app')

@section('title', 'Ajukan Surat - Desa Banjaran')

@section('content')

{{-- Hero Section --}}
<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-desa-gold/5 rounded-full -ml-12 -mb-12 blur-2xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Pengajuan Surat Desa</h1>
        <p class="text-gray-400 text-base max-w-xl mx-auto">
            Ajukan surat keterangan secara online. Cukup masukkan NIK dan Tanggal Lahir, data Anda akan otomatis terisi dari sistem.
        </p>
    </div>
</section>

{{-- Form Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">

        {{-- Error Alert --}}
        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <span class="text-red-500 text-xl">⚠️</span>
                <div>
                    <p class="font-semibold text-red-700 mb-1">Terdapat kesalahan:</p>
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-red-600">• {{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Success Alert --}}
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <span class="text-green-500 text-xl">✅</span>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-desa-dark to-desa-gray px-8 py-6">
                <h2 class="text-xl font-bold text-white">Form Pengajuan Surat</h2>
                <p class="text-gray-400 text-sm mt-1">Isi semua data dengan benar dan lengkap</p>
            </div>

            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- NIK --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            NIK KTP
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                                </svg>
                            </div>
                            <input type="text" name="nik" maxlength="16"
                                pattern="[0-9]*" 
                                inputmode="numeric" 
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                value="{{ old('nik') }}"
                                placeholder="16 digit NIK"
                                class="w-full pl-12 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition
                                    {{ $errors->has('nik') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-gray-300' }}"
                                required>
                        </div>
                        @error('nik')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <span>⚠</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- TANGGAL LAHIR (BARU) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Lahir
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}"
                                class="w-full pl-12 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition
                                    {{ $errors->has('tanggal_lahir') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-gray-300' }}"
                                required>
                        </div>
                        @error('tanggal_lahir')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <span>⚠</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                
                <p class="mt-[-10px] text-xs text-gray-500">
                    Kombinasi NIK dan Tanggal Lahir digunakan untuk memvalidasi bahwa Anda adalah pemilik identitas tersebut.
                </p>

                {{-- Divider --}}
                <div class="border-t border-gray-100"></div>

                {{-- Jenis Surat --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Jenis Surat yang Diajukan
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <select name="template_surat_id"
                            class="w-full pl-12 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition appearance-none
                                {{ $errors->has('template_surat_id') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-gray-300' }}"
                            required>
                            <option value="">Pilih Jenis Surat</option>
                            @foreach($templates as $t)
                                <option value="{{ $t->id }}" {{ old('template_surat_id') == $t->id ? 'selected' : '' }}>
                                    {{ $t->nama_template }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('template_surat_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <span>⚠</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Keperluan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Keperluan Surat
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keperluan" rows="4"
                        placeholder="Contoh: Melamar pekerjaan di PT. ABC"
                        class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition resize-none
                            {{ $errors->has('keperluan') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-gray-300' }}"
                        required>{{ old('keperluan') }}</textarea>
                    @error('keperluan')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <span>⚠</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Keterangan Tambahan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Keterangan Tambahan
                    </label>
                    <textarea name="keterangan" rows="3"
                        placeholder="Contoh: Keterangan lain yang mendukung pengajuan surat..."
                        class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition resize-none
                            {{ $errors->has('keterangan') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-gray-300' }}">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <span>⚠</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Upload Dokumen Persyaratan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Upload Dokumen Persyaratan
                        <span class="text-red-500">*</span>
                    </label>
                    <p class="text-xs text-gray-500 mb-3">Upload Dokumen Persyaratan Sesuai dengan Jenis Surat Yang Anda Pilih</p>

                    {{-- Area Upload --}}
                    <div class="relative border-2 border-dashed rounded-xl min-h-[120px] flex items-center justify-center p-4 text-center
                        {{ $errors->has('file_dokumen') || $errors->has('file_dokumen.*') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-desa-gold' }}
                        transition group cursor-pointer" id="upload_area">
                        
                        <input type="file" name="file_dokumen[]" id="file_dokumen" multiple
                               accept=".jpg,.jpeg,.png,.pdf"
                               class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-20">
                        
                        <div id="upload_placeholder" class="flex flex-col items-center gap-2 pointer-events-none z-10">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p id="upload_text" class="text-sm font-medium text-gray-600">Klik untuk upload atau drag & drop</p>
                            <p class="text-xs text-gray-400">Format file (JPG, PNG, PDF) — maks. 2MB/file</p>
                        </div>
                    </div>

                    {{-- Tempat untuk menampilkan list file --}}
                    <div id="file_list_container" class="mt-4 space-y-2 hidden"></div>

                    {{-- Error handling file upload --}}
                    @error('file_dokumen')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <span>⚠</span> {{ $message }}
                        </p>
                    @enderror
                    @if($errors->has('file_dokumen.*'))
                        @foreach($errors->get('file_dokumen.*') as $errorsItem)
                            @foreach($errorsItem as $error)
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <span>⚠</span> {{ $error }}
                                </p>
                            @endforeach
                        @endforeach
                    @endif
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <p class="text-sm font-semibold text-blue-800 mb-2">📋 Informasi Penting</p>
                    <ul class="text-xs text-blue-700 space-y-1">
                        <li>• Pastikan NIK dan Tanggal Lahir sesuai dengan KTP Anda</li>
                        <li>• Pengajuan akan diverifikasi oleh admin desa</li>
                        <li>• Surat dapat diambil di kantor desa setelah status <strong>Selesai</strong></li>
                        <li>• Proses verifikasi membutuhkan waktu 1-3 hari kerja</li>
                    </ul>
                </div>

                {{-- Button --}}
                <div class="flex flex-col sm:flex-row gap-4 mt-6">
                    <a href="{{ url('layanan') }}" class="w-full sm:w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-6 rounded-xl transition-all duration-200 flex items-center justify-center text-center shadow-sm">
                        Batal
                    </a>
                    <button type="submit" id="btn-submit" class="w-full sm:w-2/3 bg-desa-gold hover:bg-yellow-500 text-desa-dark font-bold py-4 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-md hover:shadow-lg hover:-translate-y-0.5 transform">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    const dt = new DataTransfer();
    const fileInput = document.getElementById('file_dokumen');
    const fileListContainer = document.getElementById('file_list_container');
    const uploadText = document.getElementById('upload_text');

    fileInput.addEventListener('change', function (e) {
        for (let i = 0; i < this.files.length; i++) {
            dt.items.add(this.files[i]);
        }
        this.files = dt.files;
        renderFileList();
    });

    function renderFileList() {
        fileListContainer.innerHTML = '';
        if (dt.files.length > 0) {
            fileListContainer.classList.remove('hidden');
            uploadText.textContent = `${dt.files.length} dokumen dipilih (Klik area kotak untuk menambah file lagi)`;
            uploadText.classList.add('text-desa-gold');

            Array.from(dt.files).forEach((file, index) => {
                let icon = '';
                if (file.type.startsWith('image/')) {
                    icon = `<svg class="w-6 h-6 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>`;
                } else if (file.type === 'application/pdf') {
                    icon = `<svg class="w-6 h-6 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>`;
                } else {
                    icon = `<svg class="w-6 h-6 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>`;
                }

                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const fileUrl = URL.createObjectURL(file);

                const item = document.createElement('div');
                item.className = 'flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg shadow-sm';
                item.innerHTML = `
                    <div class="flex items-center gap-3 w-full overflow-hidden">
                        ${icon}
                        <div class="truncate w-full">
                            <p class="text-sm font-semibold text-gray-700 truncate">${file.name}</p>
                            <p class="text-xs text-gray-500">${fileSizeMB} MB</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 shrink-0 ml-2">
                        <a href="${fileUrl}" target="_blank" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors" title="Lihat dokumen ini">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                        <button type="button" onclick="removeFile(${index})" class="text-red-400 hover:text-red-600 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Hapus dokumen ini">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                `;
                fileListContainer.appendChild(item);
            });
        } else {
            fileListContainer.classList.add('hidden');
            uploadText.textContent = 'Klik untuk upload atau drag & drop';
            uploadText.classList.remove('text-desa-gold');
        }
    }

    function removeFile(index) {
        dt.items.remove(index);
        fileInput.files = dt.files;
        renderFileList();
    }
</script>
@endpush
@endsection