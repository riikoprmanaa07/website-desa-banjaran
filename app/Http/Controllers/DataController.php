<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataController extends Controller
{
    public function index()
    {
        // ── DEMOGRAFI ──────────────────────────────────────────────
        $totalPenduduk   = DB::table('penduduk')->count();
        $lakiLaki        = DB::table('penduduk')->where('jenis_kelamin', 'L')->count();
        $perempuan       = DB::table('penduduk')->where('jenis_kelamin', 'P')->count();
        $kepalaKeluarga  = DB::table('penduduk')->where('status_dalam_keluarga', 'Kepala Keluarga')->count();

        $demografi = [
            'total_penduduk'  => $totalPenduduk,
            'laki_laki'       => $lakiLaki,
            'perempuan'       => $perempuan,
            'kepala_keluarga' => $kepalaKeluarga,
            'kepadatan'       => $totalPenduduk > 0
                ? number_format($totalPenduduk / max($kepalaKeluarga, 1), 2) . ' jiwa/KK'
                : '0 jiwa/KK',
        ];

        // ── KELOMPOK USIA ──────────────────────────────────────────
        // Kelompok: 0-14, 15-24, 25-54, 55-64, 65+
        $usiaGroups = [
            ['range' => '0-14',  'min' => 0,  'max' => 14],
            ['range' => '15-24', 'min' => 15, 'max' => 24],
            ['range' => '25-54', 'min' => 25, 'max' => 54],
            ['range' => '55-64', 'min' => 55, 'max' => 64],
            ['range' => '65+',   'min' => 65, 'max' => 999],
        ];

        $usia = [];
        foreach ($usiaGroups as $group) {
            $minDate = Carbon::now()->subYears($group['max'] + 1)->addDay()->format('Y-m-d');
            $maxDate = Carbon::now()->subYears($group['min'])->format('Y-m-d');

            $laki = DB::table('penduduk')
                ->where('jenis_kelamin', 'L')
                ->whereBetween('tanggal_lahir', [$minDate, $maxDate])
                ->count();

            $pr = DB::table('penduduk')
                ->where('jenis_kelamin', 'P')
                ->whereBetween('tanggal_lahir', [$minDate, $maxDate])
                ->count();

            $usia[] = [
                'range'     => $group['range'],
                'laki'      => $laki,
                'perempuan' => $pr,
            ];
        }

        // ── PENDIDIKAN ────────────────────────────────────────────
        $pendidikanRaw = DB::table('penduduk')
            ->select('pendidikan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('pendidikan')
            ->orderByDesc('jumlah')
            ->get();

        $pendidikan = $pendidikanRaw->map(fn($row) => [
            'tingkat' => $row->pendidikan,
            'jumlah'  => (int) $row->jumlah,
        ])->toArray();

        // ── PEKERJAAN ─────────────────────────────────────────────
        $pekerjaanRaw = DB::table('penduduk')
            ->select('pekerjaan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('pekerjaan')
            ->orderByDesc('jumlah')
            ->limit(10) // tampilkan 10 pekerjaan terbesar
            ->get();

        $pekerjaan = $pekerjaanRaw->map(fn($row) => [
            'jenis'  => $row->pekerjaan,
            'jumlah' => (int) $row->jumlah,
        ])->toArray();

        // ── AGAMA ─────────────────────────────────────────────────
        $agamaRaw = DB::table('penduduk')
            ->select('agama', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('agama')
            ->orderByDesc('jumlah')
            ->get();

        $agama = $agamaRaw->map(fn($row) => [
            'nama'       => $row->agama,
            'jumlah'     => (int) $row->jumlah,
            'persentase' => $totalPenduduk > 0
                ? round(($row->jumlah / $totalPenduduk) * 100, 1)
                : 0,
        ])->toArray();

        // ── STATUS PERKAWINAN ─────────────────────────────────────
        $perkawinanRaw = DB::table('penduduk')
            ->select('status_perkawinan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status_perkawinan')
            ->orderByDesc('jumlah')
            ->get();

        $perkawinan = $perkawinanRaw->map(fn($row) => [
            'status'     => $row->status_perkawinan,
            'jumlah'     => (int) $row->jumlah,
            'persentase' => $totalPenduduk > 0
                ? round(($row->jumlah / $totalPenduduk) * 100, 1)
                : 0,
        ])->toArray();

        // ── STATUS DALAM KELUARGA (BARU) ──────────────────────────
        $statusKeluargaRaw = DB::table('penduduk')
            ->select('status_dalam_keluarga as status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status_dalam_keluarga')
            ->orderByDesc('jumlah')
            ->get();

        $statusKeluarga = $statusKeluargaRaw->map(fn($row) => [
            'status'     => $row->status ?: 'Tidak Diketahui',
            'jumlah'     => (int) $row->jumlah,
            'persentase' => $totalPenduduk > 0
                ? round(($row->jumlah / $totalPenduduk) * 100, 1)
                : 0,
        ])->toArray();

        // ── KEWARGANEGARAAN (BARU) ────────────────────────────────
        $kewarganegaraanRaw = DB::table('penduduk')
            ->select('kewarganegaraan as status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('kewarganegaraan')
            ->orderByDesc('jumlah')
            ->get();

        $kewarganegaraan = $kewarganegaraanRaw->map(fn($row) => [
            'status'     => $row->status,
            'jumlah'     => (int) $row->jumlah,
            'persentase' => $totalPenduduk > 0
                ? round(($row->jumlah / $totalPenduduk) * 100, 1)
                : 0,
        ])->toArray();

        // ── DATA RT & RW ───────────────────────────────────────────
        $rwList = DB::table('rw')
            ->orderBy('nomor_rw')
            ->get();

        $rtList = DB::table('rt')
            ->join('rw', 'rt.rw_id', '=', 'rw.id')
            ->select(
                'rt.*',
                'rw.nomor_rw'
            )
            ->orderBy('rw.nomor_rw')
            ->orderBy('rt.nomor_rt')
            ->get();

        // Hitung jumlah penduduk per RT dari tabel penduduk
        $pendudukPerRt = DB::table('penduduk')
            ->select('rt', 'rw', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('rt', 'rw')
            ->get()
            ->keyBy(fn($row) => $row->rw . '-' . $row->rt);

        // Hitung KK per RT
        $kkPerRt = DB::table('penduduk')
            ->where('status_dalam_keluarga', 'Kepala Keluarga')
            ->select('rt', 'rw', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('rt', 'rw')
            ->get()
            ->keyBy(fn($row) => $row->rw . '-' . $row->rt);

        // Gabungkan data RT dengan data penduduk aktual
        $rtData = $rtList->map(function ($rt) use ($pendudukPerRt, $kkPerRt) {
            $key            = $rt->nomor_rw . '-' . $rt->nomor_rt;
            $jumlahPenduduk = $pendudukPerRt[$key]->jumlah ?? $rt->jumlah_penduduk;
            $jumlahKk       = $kkPerRt[$key]->jumlah    ?? $rt->jumlah_kk;

            return [
                'id'              => $rt->id,
                'nomor_rt'        => $rt->nomor_rt,
                'nomor_rw'        => $rt->nomor_rw,
                'nama_ketua'      => $rt->nama_ketua,
                'no_hp'           => $rt->no_hp,
                'alamat'          => $rt->alamat,
                'jumlah_penduduk' => $jumlahPenduduk,
                'jumlah_kk'       => $jumlahKk,
            ];
        })->toArray();

        $rwData = $rwList->map(function ($rw) use ($rtData) {
            // Hitung total penduduk & KK per RW dari data RT
            $rtDiRw = array_filter($rtData, fn($rt) => $rt['nomor_rw'] === $rw->nomor_rw);

            return [
                'id'              => $rw->id,
                'nomor_rw'        => $rw->nomor_rw,
                'nama_ketua'      => $rw->nama_ketua,
                'no_hp'           => $rw->no_hp,
                'alamat'          => $rw->alamat,
                'jumlah_penduduk' => array_sum(array_column($rtDiRw, 'jumlah_penduduk')) ?: $rw->jumlah_penduduk,
                'jumlah_kk'       => array_sum(array_column($rtDiRw, 'jumlah_kk'))       ?: $rw->jumlah_kk,
                'jumlah_rt'       => count($rtDiRw),
            ];
        })->toArray();

        return view('data', compact(
            'demografi',
            'usia',
            'pendidikan',
            'pekerjaan',
            'agama',
            'perkawinan',
            'statusKeluarga', // TAMBAHAN VARIABEL BARU
            'kewarganegaraan', // TAMBAHAN VARIABEL BARU
            'rwData',
            'rtData'
        ));
    }
}