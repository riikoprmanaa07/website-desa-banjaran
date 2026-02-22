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

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="aktif" value="1" {{ $template->aktif ? 'checked' : '' }} class="rounded border-gray-300">
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
                                    <code class="block bg-purple-100 text-purple-800 px-2 py-0.5 rounded text-xs font-mono">{{ $placeholder }}</code>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
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
</script>
@endpush
@endsection