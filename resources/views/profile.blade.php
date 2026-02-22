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
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">
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
                        <div class="relative w-36 h-36 mx-auto mb-4">
                            @if($kepala->foto)
                                <img src="{{ asset('storage/' . $kepala->foto) }}"
                                     alt="{{ $kepala->nama }}"
                                     class="w-full h-full rounded-2xl object-cover border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                            @else
                                <div class="w-full h-full rounded-2xl bg-gray-100 flex items-center justify-center border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                                    <svg class="w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-desa-dark group-hover:text-desa-gold transition-colors">
                            {{ $kepala->nama }}
                        </h3>
                        <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">{{ $kepala->jabatan }}</p>
                        @if($kepala->pendidikan)
                            <p class="text-xs text-gray-400 mt-1">{{ $kepala->pendidikan }}</p>
                        @endif
                        @if($kepala->no_hp)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $kepala->no_hp }}</p>
                        @endif
                        <span class="inline-flex items-center gap-1 mt-3 text-[10px] font-semibold uppercase tracking-wider px-3 py-1 rounded-full
                            {{ $kepala->status === 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $kepala->status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-400' }}"></span>
                            {{ $kepala->status }}
                        </span>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="flex items-center gap-4 mb-10">
                    <div class="flex-1 h-px bg-gray-100"></div>
                    <span class="text-xs text-gray-400 uppercase tracking-widest font-medium">Staf & Perangkat</span>
                    <div class="flex-1 h-px bg-gray-100"></div>
                </div>
                @endif

                {{-- Perangkat Lainnya --}}
                @php $perangkat = $struktur->where('urutan', '!=', 1)->sortBy('urutan'); @endphp

                @if($perangkat->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($perangkat as $item)
                    <div class="group text-center">
                        <div class="relative w-32 h-32 mx-auto mb-4">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     alt="{{ $item->nama }}"
                                     class="w-full h-full rounded-2xl object-cover border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                            @else
                                <div class="w-full h-full rounded-2xl bg-gray-100 flex items-center justify-center border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
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
                        <div class="relative w-36 h-36 mx-auto mb-4">
                            @if($ketuaBpd->foto)
                                <img src="{{ asset('storage/' . $ketuaBpd->foto) }}"
                                     alt="{{ $ketuaBpd->nama }}"
                                     class="w-full h-full rounded-2xl object-cover border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                            @else
                                <div class="w-full h-full rounded-2xl bg-gray-100 flex items-center justify-center border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                                    <svg class="w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-desa-dark group-hover:text-desa-gold transition-colors">
                            {{ $ketuaBpd->nama }}
                        </h3>
                        <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">{{ $ketuaBpd->jabatan }}</p>
                        @if($ketuaBpd->pendidikan)
                            <p class="text-xs text-gray-400 mt-1">{{ $ketuaBpd->pendidikan }}</p>
                        @endif
                        @if($ketuaBpd->no_hp)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $ketuaBpd->no_hp }}</p>
                        @endif
                        <span class="inline-flex items-center gap-1 mt-3 text-[10px] font-semibold uppercase tracking-wider px-3 py-1 rounded-full
                            {{ $ketuaBpd->status === 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $ketuaBpd->status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-400' }}"></span>
                            {{ $ketuaBpd->status }}
                        </span>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="flex items-center gap-4 mb-10">
                    <div class="flex-1 h-px bg-gray-100"></div>
                    <span class="text-xs text-gray-400 uppercase tracking-widest font-medium">Anggota BPD</span>
                    <div class="flex-1 h-px bg-gray-100"></div>
                </div>
                @endif

                {{-- Anggota BPD --}}
                @php $anggotaBpd = $bpd->where('urutan', '!=', 1)->sortBy('urutan'); @endphp

                @if($anggotaBpd->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($anggotaBpd as $item)
                    <div class="group text-center">
                        <div class="relative w-32 h-32 mx-auto mb-4">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     alt="{{ $item->nama }}"
                                     class="w-full h-full rounded-2xl object-cover border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                            @else
                                <div class="w-full h-full rounded-2xl bg-gray-100 flex items-center justify-center border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
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