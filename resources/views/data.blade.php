@extends('layout.app')

@section('title', 'Data Desa - Desa Banjaran')

@section('content')
<!-- Page Header -->
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

<!-- Data Desa Content -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Quick Stats -->
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

        <!-- Row 1: Jenis Kelamin (Donut) + Usia (Bar) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <!-- Diagram Jenis Kelamin -->
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

            <!-- Diagram Usia -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">👶 Kelompok Usia</h2>
                <p class="text-xs text-gray-400 mb-4">Distribusi penduduk berdasarkan kelompok usia</p>
                <div class="h-48">
                    <canvas id="chartUsia"></canvas>
                </div>
            </div>
        </div>

        <!-- Row 2: Pendidikan + Pekerjaan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <!-- Diagram Pendidikan -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">🎓 Tingkat Pendidikan</h2>
                <p class="text-xs text-gray-400 mb-4">Jumlah penduduk berdasarkan jenjang pendidikan</p>
                <div class="h-52">
                    <canvas id="chartPendidikan"></canvas>
                </div>
            </div>

            <!-- Diagram Pekerjaan -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-extrabold text-desa-dark mb-1">💼 Mata Pencaharian</h2>
                <p class="text-xs text-gray-400 mb-4">Distribusi pekerjaan utama penduduk</p>
                <div class="h-52">
                    <canvas id="chartPekerjaan"></canvas>
                </div>
            </div>
        </div>

        <!-- Row 3: Agama + Perkawinan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <!-- Diagram Agama -->
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

            <!-- Diagram Perkawinan -->
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

        <!-- Row 4: Fasilitas Umum -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
            <h2 class="text-lg font-extrabold text-desa-dark mb-1">🏢 Fasilitas Umum</h2>
            <p class="text-xs text-gray-400 mb-4">Jumlah fasilitas berdasarkan kategori</p>
            <div class="h-52">
                <canvas id="chartFasilitas"></canvas>
            </div>
        </div>

        <!-- Row 5: Potensi Desa -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
            <h2 class="text-lg font-extrabold text-desa-dark mb-1">🌾 Potensi Desa</h2>
            <p class="text-xs text-gray-400 mb-5">Pertanian, Perkebunan, dan Peternakan</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm font-bold text-green-600 mb-3">🌾 Pertanian <span class="text-gray-400 font-normal">(luas ha)</span></h3>
                    <div class="h-40"><canvas id="chartPertanian"></canvas></div>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-yellow-600 mb-3">🌴 Perkebunan <span class="text-gray-400 font-normal">(luas ha)</span></h3>
                    <div class="h-40"><canvas id="chartPerkebunan"></canvas></div>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-red-600 mb-3">🐄 Peternakan <span class="text-gray-400 font-normal">(populasi)</span></h3>
                    <div class="h-40"><canvas id="chartPeternakan"></canvas></div>
                </div>
            </div>
        </div>

        <!-- Note -->
        <div class="bg-gradient-to-r from-desa-gold/10 to-yellow-50 border-l-4 border-desa-gold rounded-r-lg p-5">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-desa-gold mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold text-gray-800 mb-1 text-sm">Catatan Penting</p>
                    <p class="text-gray-600 text-xs leading-relaxed">Data yang ditampilkan adalah data tahun 2026. Untuk informasi lebih detail atau data terkini, silakan hubungi kantor desa atau kunjungi langsung.</p>
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

    // ── 7. Fasilitas – Horizontal Bar ─────────────────────────
    @php
        $fasilitasLabels = [];
        $fasilitasData   = [];
        $fasilitasBg     = [];
        $colorMap = [
            'pendidikan'  => '#3b82f6',
            'kesehatan'   => '#22c55e',
            'peribadatan' => '#a855f7',
            'ekonomi'     => '#f97316',
        ];
        foreach ($fasilitas as $kategori => $items) {
            foreach ($items as $item) {
                $fasilitasLabels[] = $item['nama'];
                $fasilitasData[]   = $item['jumlah'];
                $fasilitasBg[]     = $colorMap[$kategori] ?? '#d4af37';
            }
        }
    @endphp
    new Chart(document.getElementById('chartFasilitas'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($fasilitasLabels) !!},
            datasets: [{
                data: {!! json_encode($fasilitasData) !!},
                backgroundColor: {!! json_encode($fasilitasBg) !!},
                borderRadius: 5,
                barThickness: 16
            }]
        },
        options: {
            indexAxis: 'y', responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} unit` } } },
            scales: {
                x: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 }, stepSize: 1 } },
                y: { grid: { display: false }, ticks: { font: { size: 9 } } }
            }
        }
    });

    // ── 8. Pertanian ──────────────────────────────────────────
    new Chart(document.getElementById('chartPertanian'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($potensi['pertanian'], 'komoditas')) !!},
            datasets: [{
                data: {!! json_encode(array_map(fn($i) => (float) filter_var($i['luas'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION), $potensi['pertanian'])) !!},
                backgroundColor: '#4ade80',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} ha` } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 9 } } },
                y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 } } }
            }
        }
    });

    // ── 9. Perkebunan ─────────────────────────────────────────
    new Chart(document.getElementById('chartPerkebunan'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($potensi['perkebunan'], 'komoditas')) !!},
            datasets: [{
                data: {!! json_encode(array_map(fn($i) => (float) filter_var($i['luas'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION), $potensi['perkebunan'])) !!},
                backgroundColor: '#facc15',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} ha` } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 9 } } },
                y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 } } }
            }
        }
    });

    // ── 10. Peternakan ────────────────────────────────────────
    new Chart(document.getElementById('chartPeternakan'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($potensi['peternakan'], 'jenis')) !!},
            datasets: [{
                data: {!! json_encode(array_map(fn($i) => (int) filter_var($i['populasi'], FILTER_SANITIZE_NUMBER_INT), $potensi['peternakan'])) !!},
                backgroundColor: '#f87171',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} ekor` } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 9 } } },
                y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 9 } } }
            }
        }
    });

});
</script>
@endpush