<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: 215.9mm 330.2mm;
            margin: 0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            width: 215.9mm;
        }

        .wrapper {
            margin: 14mm 20mm 20mm 25mm;
        }

        /* =============================================
           KOP SURAT
        ============================================= */
        .kop {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 6px;
            margin-bottom: 14px;
        }

        .kop table { width: 100%; border-collapse: collapse; }
        .kop td { vertical-align: middle; }
        .kop td.logo { width: 22mm; text-align: center; }
        .kop td.logo img { width: 18mm; height: auto; }
        .kop td.teks { text-align: center; padding: 0 4mm; }
        .kop td.spacer { width: 22mm; }

        .kop-instansi {
            font-size: 11pt;
            text-transform: uppercase;
            line-height: 1.4;
        }
        .kop-nama-desa {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            font-family: "Bookman Old Style", "Times New Roman", serif;
            letter-spacing: 1px;
            line-height: 1.3;
        }
        .kop-alamat { font-size: 9pt; line-height: 1.4; }

        /* =============================================
           JUDUL & NOMOR
        ============================================= */
        .judul {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 16px 0 4px;
        }
        .nomor { text-align: center; font-size: 12pt; margin-bottom: 14px; }

        /* =============================================
           PEMBUKA
        ============================================= */
        .pembuka {
            font-size: 12pt;
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 10px;
            white-space: pre-line;
        }

        /* =============================================
           ISI SURAT
        ============================================= */
        .isi { font-size: 12pt; margin: 0 0 10px 0; width: 100%; }
        .isi table { width: 100%; border-collapse: collapse; margin-left: 8mm; }
        .isi table td {
            font-size: 12pt;
            line-height: 1.7;
            vertical-align: top;
            padding: 0;
        }
        .isi table td.label     { width: 48mm; }
        .isi table td.titik-dua { width: 8mm; text-align: center; }

        /* =============================================
           PENUTUP
        ============================================= */
        .penutup {
            font-size: 12pt;
            line-height: 1.6;
            text-align: justify;
            margin: 8px 0 0;
            white-space: pre-line;
        }

        
        .ttd-wrapper {
            margin-top: 24px;
            width: 100%;
        }

        .ttd-wrapper table {
            width: 100%;
            border-collapse: collapse;
        }

        .ttd-wrapper td {
            text-align: center;
            vertical-align: top;
            font-size: 12pt;
            width: 50%;
            padding: 0 4mm;
        }

        
        .ttd-header {
            height: 38pt;
            vertical-align: top !important;
        }

        /* Baris 2: ruang kosong tanda tangan
           Fixed height 30mm — sama untuk kiri dan kanan */
        .ttd-ruang {
            height: 30mm;
            vertical-align: top !important;
            padding-top: 0 !important;
        }

        /* Baris 3: garis + nama
           Menggunakan border-top pada span agar garis sejajar */
        .ttd-nama-row {
            vertical-align: top !important;
            padding-top: 0 !important;
        }

        /* Span garis + nama di dalamnya */
        .ttd-garis-nama {
            display: inline-block;
            border-top: 1px solid #000;
            padding-top: 3px;
            min-width: 52mm;
            text-align: center;
        }

        .ttd-nama    { font-size: 12pt; font-weight: bold; }
        .ttd-nip     { font-size: 11pt; font-weight: normal; margin-top: 1px; }

        /* Jika 1 kolom saja */
        .ttd-wrapper.satu-kolom td.col-kosong { /* biarkan kosong */ }
    </style>
</head>
<body>
<div class="wrapper">

    {{-- KOP SURAT --}}
    <div class="kop">
        <table>
            <tr>
                <td class="logo">
                    <img src="{{ public_path('images/logo-jepara.png') }}" alt="Logo">
                </td>
                <td class="teks">
                    @foreach(explode("\n", $template->kop_surat) as $baris)
                        @php $baris = trim($baris); @endphp
                        @if($baris)
                            @if($loop->index == 0)
                                <div class="kop-instansi">{{ $baris }}</div>
                            @elseif($loop->index == 1)
                                <div class="kop-instansi">{{ $baris }}</div>
                            @elseif($loop->index == 2)
                                <div class="kop-nama-desa">{{ $baris }}</div>
                            @else
                                <div class="kop-alamat">{{ $baris }}</div>
                            @endif
                        @endif
                    @endforeach
                </td>
                <td class="spacer"></td>
            </tr>
        </table>
    </div>

    {{-- JUDUL --}}
    <div class="judul">{{ $template->judul_surat }}</div>

    {{-- NOMOR --}}
    <div class="nomor">Nomor : {{ $surat->nomor_surat }}</div>

    {{-- PEMBUKA --}}
    <div class="pembuka">{{ $template->pembuka }}</div>

    {{-- ISI SURAT --}}
    <div class="isi">{!! $isiSurat !!}</div>

    {{-- PENUTUP --}}
    @if($template->penutup)
        <div class="penutup">{{ $template->penutup }}</div>
    @endif

    {{-- =============================================
         TANDA TANGAN
         3 baris tabel dengan height fixed:
         Baris 1 — label kiri | kota+tgl + jabatan kanan
         Baris 2 — ruang kosong (fixed 30mm keduanya)
         Baris 3 — garis + nama bold center
    ============================================= --}}
    @php
        $bulanId = [
            1=>'Januari',   2=>'Februari', 3=>'Maret',    4=>'April',
            5=>'Mei',       6=>'Juni',     7=>'Juli',      8=>'Agustus',
            9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember',
        ];
        $tgl         = $surat->tanggal_surat;
        $tanggalIndo = $tgl->format('d') . ' ' . $bulanId[(int)$tgl->format('n')] . ' ' . $tgl->format('Y');
        $kotaTanggal = 'Banjaran, ' . $tanggalIndo;
    @endphp

    <div class="ttd-wrapper {{ $template->butuh_ttd_pemohon ? 'dua-kolom' : 'satu-kolom' }}">
        <table>

            {{-- BARIS 1: HEADER TTD --}}
            <tr>
                @if($template->butuh_ttd_pemohon)
                <td class="col-pemohon ttd-header">
                    {{ $template->label_ttd_pemohon }},
                </td>
                @else
                <td class="col-kosong ttd-header"></td>
                @endif

                <td class="col-kepala ttd-header">
                    {{-- Kota & tanggal --}}
                    <div>{{ $kotaTanggal }}</div>
                    {{-- Jabatan --}}
                    <div>{{ $template->penandatangan_jabatan }},</div>
                </td>
            </tr>

            {{-- BARIS 2: RUANG KOSONG TANDA TANGAN (fixed 30mm) --}}
            <tr>
                @if($template->butuh_ttd_pemohon)
                <td class="col-pemohon ttd-ruang"></td>
                @else
                <td class="col-kosong ttd-ruang"></td>
                @endif

                <td class="col-kepala ttd-ruang"></td>
            </tr>

            {{-- BARIS 3: GARIS + NAMA BOLD CENTER --}}
            <tr>
                @if($template->butuh_ttd_pemohon)
                <td class="col-pemohon ttd-nama-row">
                    <span class="ttd-garis-nama">
                        <div class="ttd-nama">
                            @if($template->tampil_nama_pemohon)
                                {{ $namaPemohon }}
                            @endif
                        </div>
                    </span>
                </td>
                @else
                <td class="col-kosong ttd-nama-row"></td>
                @endif

                <td class="col-kepala ttd-nama-row">
                    <span class="ttd-garis-nama">
                        <div class="ttd-nama">{{ $template->penandatangan_nama }}</div>
                        @if($template->penandatangan_nip)
                            <div class="ttd-nip">NIP. {{ $template->penandatangan_nip }}</div>
                        @endif
                    </span>
                </td>
            </tr>

        </table>
    </div>
    {{-- END TANDA TANGAN --}}

</div>
</body>
</html>