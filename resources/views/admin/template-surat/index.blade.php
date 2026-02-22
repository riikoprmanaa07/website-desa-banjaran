@extends('layout.admin')

@section('title', 'Template Surat')
@section('page-title', 'Kelola Template Surat')
@section('page-subtitle', 'Manajemen template surat dengan sistem Find & Replace')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Template Surat</h3>
            <p class="text-sm text-gray-500">Total: {{ $templates->total() }} template</p>
        </div>
        <a href="{{ route('admin.template-surat.create') }}" class="bg-desa-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Template
        </a>
    </div>

    <!-- Info -->
    <div class="px-6 py-3 bg-blue-50 border-b border-blue-200">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="text-sm text-blue-800">
                <p class="font-medium">Template surat menggunakan sistem Find & Replace</p>
                <p class="mt-1">Gunakan <code class="bg-blue-100 px-2 py-0.5 rounded">[PLACEHOLDER]</code> untuk data yang akan otomatis diganti saat membuat surat.</p>
            </div>
        </div>
    </div>

    <!-- Templates List -->
    <div class="p-6">
        @if($templates->count() > 0)
        <div class="grid grid-cols-1 gap-4">
            @foreach($templates as $template)
            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-lg transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h4 class="text-lg font-bold text-gray-800">{{ $template->nama_template }}</h4>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $template->aktif ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $template->aktif ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                        
                        <div class="space-y-1 text-sm text-gray-600 mb-3">
                            <p><span class="font-medium">Jenis Surat:</span> {{ $template->jenis_surat }}</p>
                            <p><span class="font-medium">Judul:</span> {{ $template->judul_surat }}</p>
                            <p><span class="font-medium">Penandatangan:</span> {{ $template->penandatangan_nama }} ({{ $template->penandatangan_jabatan }})</p>
                        </div>

                        <div class="text-xs text-gray-500">
                            Dibuat: {{ $template->created_at->format('d F Y') }} • 
                            Update terakhir: {{ $template->updated_at->format('d F Y H:i') }}
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 ml-4">
                        <!-- Preview -->
                        <a href="{{ route('admin.template-surat.preview', $template->id) }}" target="_blank"
                            class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition" title="Preview">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.template-surat.edit', $template->id) }}"
                            class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.template-surat.destroy', $template->id) }}" method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus template {{ $template->nama_template }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($templates->hasPages())
        <div class="mt-6">
            {{ $templates->links() }}
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-lg font-medium text-gray-600">Belum ada template surat</p>
            <p class="text-sm text-gray-500 mt-1">Klik tombol "Tambah Template" untuk membuat template baru</p>
        </div>
        @endif
    </div>
</div>
@endsection