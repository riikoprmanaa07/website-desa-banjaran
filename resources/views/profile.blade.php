@extends('layout.app')

@section('title', 'Struktur Desa - Desa Banjaran')

@section('content')

{{-- Hero --}}
<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-desa-gold/5 rounded-full -ml-12 -mb-12 blur-2xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
       
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Struktur Desa Banjaran</h1>
        <p class="text-gray-400 text-base max-w-xl mx-auto">
            Susunan perangkat pemerintahan dan lembaga Desa Banjaran, Kec. Bangsri, Kab. Jepara.
        </p>
    </div>
</section>

{{-- Content --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-20">
{{-- perangkat desa --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-10">
            <div class="text-center mb-12">
                <span class="inline-block text-desa-gold text-xs font-bold uppercase tracking-widest mb-2">Pemerintah Desa</span>
                <h2 class="text-2xl font-extrabold text-desa-dark">Perangkat Desa</h2>
                <div class="w-12 h-1 bg-desa-gold mx-auto mt-3 rounded-full"></div>
            </div>

            @if($struktur->count() > 0)

                {{-- Kepala Desa --}}
                @php $kepala = $struktur->where('urutan', 1)->first(); @endphp

                @if($kepala)
                <div class="flex justify-center mb-12">
                    <div class="group text-center">
                        <div class="w-36 mx-auto mb-4">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300 bg-gray-100">
                                @if($kepala->foto)
                                    <img src="{{ asset('storage/' . $kepala->foto) }}"
                                         alt="{{ $kepala->nama }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-desa-dark group-hover:text-desa-gold transition-colors">
                            {{ $kepala->nama }}
                        </h3>
                        <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">{{ $kepala->jabatan }}</p>
                        @if($kepala->pendidikan)
                            <p class="text-xs text-gray-400 mt-1">{{ $kepala->pendidikan }}</p>
                        @endif
                        <span class="inline-flex items-center gap-1 mt-3 text-[10px] font-semibold uppercase tracking-wider px-3 py-1 rounded-full
                            {{ $kepala->status === 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $kepala->status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-400' }}"></span>
                            {{ $kepala->status }}
                        </span>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="flex flex-col items-center mb-8 relative">
                    <div class="w-px h-8 bg-desa-gold/50"></div>
                    
                    <div class="w-full max-w-3xl h-px bg-desa-gold/50 relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-desa-gold"></div>
                    </div>
                    
                    <div class="w-px h-8 bg-desa-gold/50"></div>
                    
                    <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-xs text-desa-gold uppercase tracking-widest font-bold">
                        Staf & Perangkat
                    </span>
                </div>
                @endif

                {{-- Perangkat Lainnya --}}
    @php $perangkat = $struktur->where('urutan', '!=', 1)->sortBy('urutan'); @endphp

            @if($perangkat->count() > 0)
                <div class="flex flex-wrap justify-center gap-8">
                    @foreach($perangkat as $item)
                    <div class="w-full sm:w-[calc(50%-2rem)] lg:w-[calc(25%-2rem)] max-w-[200px] group text-center">
                        <div class="w-32 mx-auto mb-4">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300 bg-gray-100">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                         alt="{{ $item->nama }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-desa-dark group-hover:text-desa-gold transition-colors">
                            {{ $item->nama }}
                        </h3>
                        <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">{{ $item->jabatan }}</p>
                        @if($item->pendidikan)
                            <p class="text-xs text-gray-400 mt-1">{{ $item->pendidikan }}</p>
                        @endif
                        <span class="inline-flex items-center gap-1 mt-2 text-[10px] font-semibold uppercase tracking-wider px-2.5 py-0.5 rounded-full
                            {{ $item->status === 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $item->status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-400' }}"></span>
                            {{ $item->status }}
                        </span>
                    </div>
                    @endforeach
                </div>
            @endif

            @else
                <p class="text-center text-gray-400 text-sm py-8">Data perangkat desa belum tersedia.</p>
            @endif
        </div>

        {{-- ══════════════════════════════════
             BAGIAN 2: BPD
        ══════════════════════════════════ --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-10">
            <div class="text-center mb-12">
                <span class="inline-block text-desa-gold text-xs font-bold uppercase tracking-widest mb-2">Lembaga Desa</span>
                <h2 class="text-2xl font-extrabold text-desa-dark">Badan Permusyawaratan Desa</h2>
                <div class="w-12 h-1 bg-desa-gold mx-auto mt-3 rounded-full"></div>
                <p class="text-sm text-gray-400 mt-3 max-w-lg mx-auto">
                    Lembaga yang melaksanakan fungsi pemerintahan sebagai mitra kerja Pemerintah Desa Banjaran.
                </p>
            </div>

            @if($bpd->count() > 0)

                {{-- Ketua BPD (urutan = 1) --}}
                @php $ketuaBpd = $bpd->where('urutan', 1)->first(); @endphp

                @if($ketuaBpd)
                <div class="flex justify-center mb-12">
                    <div class="group text-center">
                        <div class="w-36 mx-auto mb-4">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300 bg-gray-100">
                                @if($ketuaBpd->foto)
                                    <img src="{{ asset('storage/' . $ketuaBpd->foto) }}"
                                         alt="{{ $ketuaBpd->nama }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-desa-dark group-hover:text-desa-gold transition-colors">
                            {{ $ketuaBpd->nama }}
                        </h3>
                        <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">{{ $ketuaBpd->jabatan }}</p>
                        @if($ketuaBpd->pendidikan)
                            <p class="text-xs text-gray-400 mt-1">{{ $ketuaBpd->pendidikan }}</p>
                        @endif
                        <span class="inline-flex items-center gap-1 mt-3 text-[10px] font-semibold uppercase tracking-wider px-3 py-1 rounded-full
                            {{ $ketuaBpd->status === 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $ketuaBpd->status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-400' }}"></span>
                            {{ $ketuaBpd->status }}
                        </span>
                    </div>
                </div>

                {{-- Divider --}}
                {{-- Garis Penghubung Hierarki --}}
                <div class="flex flex-col items-center mb-8 relative">
                    <div class="w-px h-8 bg-desa-gold/50"></div>
                    
                    <div class="w-full max-w-3xl h-px bg-desa-gold/50 relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-desa-gold"></div>
                    </div>
                    
                    <div class="w-px h-8 bg-desa-gold/50"></div>
                    
                    <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-xs text-desa-gold uppercase tracking-widest font-bold">
                        Anggota BPD
                    </span>
                </div>
                @endif

                {{-- Anggota BPD --}}
                @php $anggotaBpd = $bpd->where('urutan', '!=', 1)->sortBy('urutan'); @endphp

                @if($anggotaBpd->count() > 0)
                <div class="flex flex-wrap justify-center gap-8">
                    @foreach($anggotaBpd as $item)
                    <div class="w-full sm:w-[calc(50%-2rem)] lg:w-[calc(25%-2rem)] max-w-[200px] group text-center">
                        <div class="w-32 mx-auto mb-4">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300 bg-gray-100">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                         alt="{{ $item->nama }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-desa-dark group-hover:text-desa-gold transition-colors">
                            {{ $item->nama }}
                        </h3>
                        <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">{{ $item->jabatan }}</p>
                        @if($item->pendidikan)
                            <p class="text-xs text-gray-400 mt-1">{{ $item->pendidikan }}</p>
                        @endif
                        <span class="inline-flex items-center gap-1 mt-2 text-[10px] font-semibold uppercase tracking-wider px-2.5 py-0.5 rounded-full
                            {{ $item->status === 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $item->status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-400' }}"></span>
                            {{ $item->status }}
                        </span>
                    </div>
                    @endforeach
                </div>
                @endif

            @else
                <p class="text-center text-gray-400 text-sm py-8">Data BPD belum tersedia.</p>
            @endif
        </div>
    </div>

</section>

@endsection