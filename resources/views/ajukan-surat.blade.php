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
            Ajukan surat keterangan secara online. Cukup masukkan NIK dan data Anda akan otomatis terisi dari sistem.
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

            <form action="{{ route('pengajuan.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                {{-- NIK --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        NIK (Nomor Induk Kependudukan)
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                            </svg>
                        </div>
                        <input type="text" name="nik" maxlength="16"
                            value="{{ old('nik') }}"
                            placeholder="Masukkan 16 digit NIK sesuai KTP"
                            class="w-full pl-12 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition
                                {{ $errors->has('nik') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-gray-300' }}"
                            required>
                    </div>
                    @error('nik')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <span>⚠</span> {{ $message }}
                        </p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">
                        Data Anda akan otomatis diambil dari sistem berdasarkan NIK.
                    </p>
                </div>

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
                        placeholder="Contoh:  Melamar pekerjaan di PT. ABC"
                        class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition resize-none
                            {{ $errors->has('keperluan') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50 hover:border-gray-300' }}"
                        required>{{ old('keperluan') }}</textarea>
                    @error('keperluan')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <span>⚠</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <p class="text-sm font-semibold text-blue-800 mb-2">📋 Informasi Penting</p>
                    <ul class="text-xs text-blue-700 space-y-1">
                        <li>• Pastikan NIK yang Anda masukkan sesuai dengan KTP</li>
                        <li>• Pengajuan akan diverifikasi oleh admin desa</li>
                        <li>• Surat dapat diambil di kantor desa setelah status <strong>Selesai</strong></li>
                        <li>• Proses verifikasi membutuhkan waktu 1-3 hari kerja</li>
                    </ul>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="w-full bg-desa-gold hover:bg-yellow-500 text-desa-dark font-bold py-4 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-md hover:shadow-lg hover:-translate-y-0.5 transform">
                    
                    Kirim Pengajuan
                </button>

            </form>
        </div>

        

    </div>
</section>

@endsection