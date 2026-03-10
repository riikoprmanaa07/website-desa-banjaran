@extends('layout.app')

@section('title', 'Data Desa - Desa Banjaran')

@section('content')
<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-desa-gold/5 rounded-full -ml-12 -mb-12 blur-2xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
       
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Data Desa Banjaran</h1>
        <p class="text-gray-400 text-base max-w-xl mx-auto">
            Informasi lengkap data kependudukan
        </p>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-desa-gold hover:shadow-lg transition hover:-translate-y-1">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Total Penduduk</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">{{ number_format($demografi['total_penduduk']) }}</h3>
                <p class="text-xs text-gray-400 mt-1">jiwa</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-blue-500 hover:shadow-lg transition hover:-translate-y-1">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Laki-laki</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">{{ number_format($demografi['laki_laki']) }}</h3>
                <p class="text-xs text-gray-400 mt-1">jiwa</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-pink-500 hover:shadow-lg transition hover:-translate-y-1">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Perempuan</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">{{ number_format($demografi['perempuan']) }}</h3>
                <p class="text-xs text-gray-400 mt-1">jiwa</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-green-500 hover:shadow-lg transition hover:-translate-y-1">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Kepala Keluarga</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">{{ number_format($demografi['kepala_keluarga']) }}</h3>
                <p class="text-xs text-gray-400 mt-1">KK</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">👥 Komposisi Jenis Kelamin</h2>
                <p class="text-xs text-gray-400 mb-4">Perbandingan penduduk laki-laki dan perempuan</p>
                <div class="flex items-center justify-center gap-8">
                    <div class="relative w-44 h-44 flex-shrink-0">
                        <canvas id="chartGender"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-xl font-extrabold text-desa-dark">{{ number_format($demografi['total_penduduk']) }}</span>
                            <span class="text-xs text-gray-400">Total</span>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-blue-500 flex-shrink-0"></span>
                            <span class="text-gray-600">Laki-laki</span>
                            <span class="ml-2 font-bold text-gray-800">{{ number_format($demografi['laki_laki']) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-pink-400 flex-shrink-0"></span>
                            <span class="text-gray-600">Perempuan</span>
                            <span class="ml-2 font-bold text-gray-800">{{ number_format($demografi['perempuan']) }}</span>
                        </div>
                        <div class="pt-2 border-t border-gray-100 text-xs text-gray-400">
                            Kepadatan: {{ $demografi['kepadatan'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">👶 Kelompok Usia</h2>
                <p class="text-xs text-gray-400 mb-4">Distribusi penduduk berdasarkan kelompok usia</p>
                <div class="h-48">
                    <canvas id="chartUsia"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">🎓 Tingkat Pendidikan</h2>
                <p class="text-xs text-gray-400 mb-4">Jumlah penduduk berdasarkan jenjang pendidikan</p>
                <div class="h-52">
                    <canvas id="chartPendidikan"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">💼 Mata Pencaharian</h2>
                <p class="text-xs text-gray-400 mb-4">Distribusi pekerjaan utama penduduk</p>
                <div class="h-52">
                    <canvas id="chartPekerjaan"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">🕌 Data Agama</h2>
                <p class="text-xs text-gray-400 mb-4">Komposisi agama yang dianut penduduk</p>
                <div class="flex items-center gap-6">
                    <div class="w-40 h-40 flex-shrink-0">
                        <canvas id="chartAgama"></canvas>
                    </div>
                    <div class="space-y-2 text-xs flex-1">
                        @php $agamaColors = ['#d4af37','#3b82f6','#22c55e','#a855f7','#f97316','#ec4899']; @endphp
                        @foreach($agama as $i => $item)
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $agamaColors[$i % count($agamaColors)] }}"></span>
                            <span class="text-gray-600 flex-1">{{ $item['nama'] }}</span>
                            <span class="font-bold text-gray-700">{{ $item['persentase'] }}%</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">💑 Status Perkawinan</h2>
                <p class="text-xs text-gray-400 mb-4">Komposisi status perkawinan penduduk</p>
                <div class="flex items-center gap-6">
                    <div class="w-40 h-40 flex-shrink-0">
                        <canvas id="chartPerkawinan"></canvas>
                    </div>
                    <div class="space-y-2 text-xs flex-1">
                        @php $kawinColors = ['#8b5cf6','#6366f1','#a78bfa','#c4b5fd']; @endphp
                        @foreach($perkawinan as $i => $item)
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $kawinColors[$i % count($kawinColors)] }}"></span>
                            <span class="text-gray-600 flex-1">{{ $item['status'] }}</span>
                            <span class="font-bold text-gray-700">{{ $item['persentase'] }}%</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">👨‍👩‍👧‍👦 Status Dalam Keluarga</h2>
                <p class="text-xs text-gray-400 mb-4">Komposisi penduduk berdasarkan status dalam keluarga</p>
                <div class="flex items-center gap-6">
                    <div class="w-40 h-40 flex-shrink-0">
                        <canvas id="chartStatusKeluarga"></canvas>
                    </div>
                    <div class="space-y-2 text-xs flex-1">
                        @php $statusColors = ['#f43f5e', '#8b5cf6', '#10b981', '#f59e0b', '#64748b']; @endphp
                        @if(isset($statusKeluarga))
                            @foreach($statusKeluarga as $i => $item)
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $statusColors[$i % count($statusColors)] }}"></span>
                                <span class="text-gray-600 flex-1">{{ $item['status'] }}</span>
                                <span class="font-bold text-gray-700">{{ $item['persentase'] }}%</span>
                            </div>
                            @endforeach
                        @else
                            <p class="text-gray-400 italic">Data belum tersedia</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">🌍 Kewarganegaraan</h2>
                <p class="text-xs text-gray-400 mb-4">Distribusi kewarganegaraan penduduk</p>
                <div class="flex items-center gap-6">
                    <div class="w-40 h-40 flex-shrink-0">
                        <canvas id="chartKewarganegaraan"></canvas>
                    </div>
                    <div class="space-y-2 text-xs flex-1">
                        @php $wnColors = ['#0ea5e9', '#ef4444']; @endphp
                        @if(isset($kewarganegaraan))
                            @foreach($kewarganegaraan as $i => $item)
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $wnColors[$i % count($wnColors)] }}"></span>
                                <span class="text-gray-600 flex-1">{{ $item['status'] }}</span>
                                <span class="font-bold text-gray-700">{{ $item['persentase'] }}%</span>
                            </div>
                            @endforeach
                        @else
                            <p class="text-gray-400 italic">Data belum tersedia</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6 mt-2">
            <h2 class="text-2xl font-extrabold text-desa-dark">🏘️ Data Wilayah RT & RW</h2>
            <p class="text-sm text-gray-400 mt-1">Distribusi penduduk berdasarkan wilayah Rukun Warga dan Rukun Tetangga</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-desa-gold">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Total RW</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">{{ count($rwData) }}</h3>
                <p class="text-xs text-gray-400 mt-1">rukun warga</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-blue-500">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Total RT</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">{{ count($rtData) }}</h3>
                <p class="text-xs text-gray-400 mt-1">rukun tetangga</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-green-500">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Rata-rata RT/RW</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">
                    {{ count($rwData) > 0 ? round(count($rtData) / count($rwData), 1) : 0 }}
                </h3>
                <p class="text-xs text-gray-400 mt-1">RT per RW</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-5 border-t-4 border-purple-500">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Rata-rata Penduduk/RT</p>
                <h3 class="text-3xl font-extrabold text-desa-dark mt-1">
                    {{ count($rtData) > 0 ? round(array_sum(array_column($rtData, 'jumlah_penduduk')) / count($rtData)) : 0 }}
                </h3>
                <p class="text-xs text-gray-400 mt-1">jiwa per RT</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">📊 Jumlah RT per RW</h2>
                <p class="text-xs text-gray-400 mb-4">Banyaknya RT yang berada di tiap RW</p>
                <div class="h-52">
                    <canvas id="chartRwRT"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">👥 Jumlah Penduduk per RW</h2>
                <p class="text-xs text-gray-400 mb-4">Distribusi penduduk di setiap RW</p>
                <div class="h-52">
                    <canvas id="chartRwPenduduk"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
            <h2 class="text-lg font-extrabold text-desa-dark mb-1">🏠 Detail RT per RW</h2>
            <p class="text-xs text-gray-400 mb-5">Klik RW untuk melihat daftar RT di dalamnya</p>

            <div class="space-y-3">
                @foreach($rwData as $rw)
                @php
                    $rtDiRw = array_values(array_filter($rtData, fn($rt) => $rt['nomor_rw'] === $rw['nomor_rw']));
                    $totalPendRw = array_sum(array_column($rtDiRw, 'jumlah_penduduk'));
                    $totalKkRw   = array_sum(array_column($rtDiRw, 'jumlah_kk'));
                @endphp
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <button
                        onclick="toggleAccordion('rw-{{ $rw['nomor_rw'] }}')"
                        class="w-full flex items-center justify-between px-5 py-4 bg-gray-50 hover:bg-amber-50 transition text-left"
                    >
                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 font-extrabold text-sm flex items-center justify-center flex-shrink-0">
                                {{ $rw['nomor_rw'] }}
                            </span>
                            <div>
                                <p class="font-bold text-desa-dark text-sm">RW {{ $rw['nomor_rw'] }}</p>
                                <p class="text-xs text-gray-500">Ketua: {{ $rw['nama_ketua'] }}{{ $rw['no_hp'] ? ' · '.$rw['no_hp'] : '' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-right">
                            <div class="hidden sm:flex flex-col items-end gap-1">
                                <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                    {{ count($rtDiRw) }} RT
                                </span>
                                <span class="text-xs text-gray-500">
                                    <span class="font-bold text-gray-700">{{ number_format($totalPendRw) }}</span> jiwa ·
                                    <span class="font-bold text-gray-700">{{ number_format($totalKkRw) }}</span> KK
                                </span>
                            </div>
                            <svg id="icon-rw-{{ $rw['nomor_rw'] }}" class="w-5 h-5 text-gray-400 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </button>

                    <div id="rw-{{ $rw['nomor_rw'] }}" class="hidden">
                        @if(count($rtDiRw) > 0)
                        <div class="px-5 pt-4 pb-2 border-b border-gray-100">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Distribusi Penduduk per RT — RW {{ $rw['nomor_rw'] }}</p>
                            <div class="h-36">
                                <canvas id="chartRt-{{ $rw['nomor_rw'] }}"></canvas>
                            </div>
                        </div>
                        @endif

                        <div class="overflow-x-auto px-5 pb-5 pt-4">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                                        <th class="px-4 py-2.5 text-left rounded-tl-lg">RT</th>
                                        <th class="px-4 py-2.5 text-left">Ketua RT</th>
                                        <th class="px-4 py-2.5 text-left">No. HP</th>
                                        <th class="px-4 py-2.5 text-center">Jumlah KK</th>
                                        <th class="px-4 py-2.5 text-center rounded-tr-lg">Jumlah Penduduk</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($rtDiRw as $rt)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-bold text-amber-600">RT {{ $rt['nomor_rt'] }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $rt['nama_ketua'] }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $rt['no_hp'] ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                {{ number_format($rt['jumlah_kk']) }} KK
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                {{ number_format($rt['jumlah_penduduk']) }} jiwa
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-gray-400 text-sm">Belum ada data RT.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="bg-amber-50 font-bold text-sm border-t-2 border-amber-100">
                                        <td colspan="3" class="px-4 py-2.5 text-gray-700">Total RW {{ $rw['nomor_rw'] }}</td>
                                        <td class="px-4 py-2.5 text-center text-desa-dark">{{ number_format($totalKkRw) }} KK</td>
                                        <td class="px-4 py-2.5 text-center text-desa-dark">{{ number_format($totalPendRw) }} jiwa</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-gradient-to-r from-desa-gold/10 to-yellow-50 border-l-4 border-desa-gold rounded-r-lg p-5">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-desa-gold mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold text-gray-800 mb-1 text-sm">Catatan Penting</p>
                    <p class="text-gray-600 text-xs leading-relaxed">Data yang ditampilkan adalah data tahun {{ date('Y') }}. Untuk informasi lebih detail atau data terkini, silakan hubungi kantor desa atau kunjungi langsung.</p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    Chart.defaults.font.family = "'Inter', sans-serif";

    // ── 1. Jenis Kelamin – Donut ──────────────────────────────
    new Chart(document.getElementById('chartGender'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $demografi['laki_laki'] }}, {{ $demografi['perempuan'] }}],
                backgroundColor: ['#3b82f6', '#f472b6'],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: (c) => ` ${c.label}: ${c.formattedValue} jiwa` } }
            }
        }
    });

    // ── 2. Usia – Grouped Bar ──────────────────────────────────
    new Chart(document.getElementById('chartUsia'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($usia, 'range')) !!},
            datasets: [
                { label: 'Laki-laki', data: {!! json_encode(array_column($usia, 'laki')) !!}, backgroundColor: '#3b82f6', borderRadius: 3 },
                { label: 'Perempuan', data: {!! json_encode(array_column($usia, 'perempuan')) !!}, backgroundColor: '#f472b6', borderRadius: 3 }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: true, position: 'top', labels: { boxWidth: 10, font: { size: 10 } } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 9 } } },
                y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 } } }
            }
        }
    });

    // ── 3. Pendidikan – Horizontal Bar ────────────────────────
    new Chart(document.getElementById('chartPendidikan'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($pendidikan, 'tingkat')) !!},
            datasets: [{
                data: {!! json_encode(array_column($pendidikan, 'jumlah')) !!},
                backgroundColor: '#3b82f6',
                borderRadius: 4,
                barThickness: 13
            }]
        },
        options: {
            indexAxis: 'y', responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} orang` } } },
            scales: {
                x: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 } } },
                y: { grid: { display: false }, ticks: { font: { size: 9 } } }
            }
        }
    });

    // ── 4. Pekerjaan – Horizontal Bar ─────────────────────────
    new Chart(document.getElementById('chartPekerjaan'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($pekerjaan, 'jenis')) !!},
            datasets: [{
                data: {!! json_encode(array_column($pekerjaan, 'jumlah')) !!},
                backgroundColor: '#22c55e',
                borderRadius: 4,
                barThickness: 13
            }]
        },
        options: {
            indexAxis: 'y', responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} orang` } } },
            scales: {
                x: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 } } },
                y: { grid: { display: false }, ticks: { font: { size: 9 } } }
            }
        }
    });

    // ── 5. Agama – Donut ──────────────────────────────────────
    new Chart(document.getElementById('chartAgama'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($agama, 'nama')) !!},
            datasets: [{
                data: {!! json_encode(array_column($agama, 'jumlah')) !!},
                backgroundColor: ['#d4af37','#3b82f6','#22c55e','#a855f7','#f97316','#ec4899'],
                borderWidth: 0,
                hoverOffset: 5
            }]
        },
        options: {
            cutout: '65%',
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.label}: ${c.formattedValue} jiwa` } } }
        }
    });

    // ── 6. Perkawinan – Donut ─────────────────────────────────
    new Chart(document.getElementById('chartPerkawinan'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($perkawinan, 'status')) !!},
            datasets: [{
                data: {!! json_encode(array_column($perkawinan, 'jumlah')) !!},
                backgroundColor: ['#8b5cf6','#6366f1','#a78bfa','#c4b5fd'],
                borderWidth: 0,
                hoverOffset: 5
            }]
        },
        options: {
            cutout: '65%',
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.label}: ${c.formattedValue} jiwa` } } }
        }
    });

    // ── 6A. Status Dalam Keluarga – Donut (BARU) ──────────────
    @if(isset($statusKeluarga))
    new Chart(document.getElementById('chartStatusKeluarga'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($statusKeluarga, 'status')) !!},
            datasets: [{
                data: {!! json_encode(array_column($statusKeluarga, 'jumlah')) !!},
                backgroundColor: ['#f43f5e', '#8b5cf6', '#10b981', '#f59e0b', '#64748b'],
                borderWidth: 0,
                hoverOffset: 5
            }]
        },
        options: {
            cutout: '65%',
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.label}: ${c.formattedValue} jiwa` } } }
        }
    });
    @endif

    // ── 6B. Kewarganegaraan – Donut (BARU) ────────────────────
    @if(isset($kewarganegaraan))
    new Chart(document.getElementById('chartKewarganegaraan'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($kewarganegaraan, 'status')) !!},
            datasets: [{
                data: {!! json_encode(array_column($kewarganegaraan, 'jumlah')) !!},
                backgroundColor: ['#0ea5e9', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 5
            }]
        },
        options: {
            cutout: '65%',
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.label}: ${c.formattedValue} jiwa` } } }
        }
    });
    @endif

    // ── 7. Chart Jumlah RT per RW ─────────────────────────────
    @php
        $rwLabels      = array_map(fn($r) => 'RW '.$r['nomor_rw'], $rwData);
        $rwJumlahRt    = array_map(fn($r) => $r['jumlah_rt'], $rwData);
        $rwJumlahPend  = array_map(fn($r) => $r['jumlah_penduduk'], $rwData);
    @endphp
    new Chart(document.getElementById('chartRwRT'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($rwLabels) !!},
            datasets: [{
                label: 'Jumlah RT',
                data: {!! json_encode($rwJumlahRt) !!},
                backgroundColor: '#d4af37',
                borderRadius: 6,
                barThickness: 28
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} RT` } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 10 }, stepSize: 1 } }
            }
        }
    });

    // ── 8. Chart Jumlah Penduduk per RW ──────────────────────
    new Chart(document.getElementById('chartRwPenduduk'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($rwLabels) !!},
            datasets: [{
                label: 'Jumlah Penduduk',
                data: {!! json_encode($rwJumlahPend) !!},
                backgroundColor: '#3b82f6',
                borderRadius: 6,
                barThickness: 28
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} jiwa` } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 10 } } }
            }
        }
    });

    // ── 9. Mini Chart penduduk per RT (dibuat saat accordion dibuka) ──
    @php
        $rtChartData = [];
        foreach($rwData as $rw) {
            $rtDiRw = array_values(array_filter($rtData, fn($rt) => $rt['nomor_rw'] === $rw['nomor_rw']));
            $rtChartData[$rw['nomor_rw']] = [
                'labels'    => array_map(fn($r) => 'RT '.$r['nomor_rt'], $rtDiRw),
                'penduduk'  => array_column($rtDiRw, 'jumlah_penduduk'),
                'kk'        => array_column($rtDiRw, 'jumlah_kk'),
            ];
        }
    @endphp
    const rtChartData = {!! json_encode($rtChartData) !!};
    const rtChartInstances = {};

    function buildRtChart(nomor_rw) {
        const canvasId = 'chartRt-' + nomor_rw;
        const canvas   = document.getElementById(canvasId);
        if (!canvas || rtChartInstances[nomor_rw]) return;

        const data = rtChartData[nomor_rw];
        if (!data || data.labels.length === 0) return;

        rtChartInstances[nomor_rw] = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Penduduk',
                        data: data.penduduk,
                        backgroundColor: '#3b82f6',
                        borderRadius: 4,
                        barThickness: 18
                    },
                    {
                        label: 'KK',
                        data: data.kk,
                        backgroundColor: '#22c55e',
                        borderRadius: 4,
                        barThickness: 18
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top', labels: { boxWidth: 10, font: { size: 9 } } },
                    tooltip: { callbacks: { label: (c) => ` ${c.dataset.label}: ${c.formattedValue}` } }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 9 } } },
                    y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 }, stepSize: 1 } }
                }
            }
        });
    }

});

// ── Accordion toggle ──────────────────────────────────────────
function toggleAccordion(id) {
    const body = document.getElementById(id);
    const nomor_rw = id.replace('rw-', '');
    const icon = document.getElementById('icon-' + id);
    const isHidden = body.classList.contains('hidden');

    body.classList.toggle('hidden');
    if (icon) icon.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';

    if (isHidden) {
        setTimeout(() => buildRtChart(nomor_rw), 50);
    }
}
</script>
@endpush