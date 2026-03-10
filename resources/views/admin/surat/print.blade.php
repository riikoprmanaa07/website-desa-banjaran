<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* DomPDF: @page untuk ukuran kertas, margin diatur via body/wrapper */
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

        /* Wrapper utama — margin kertas diatur di sini agar DomPDF patuh */
        .wrapper {
            margin: 20mm 18mm 20mm 18mm;
            width: auto;
        }

        /* ---- KOP SURAT ---- */
        .kop {
            border-bottom: 3px solid black;
            padding-bottom: 8px;
            margin-bottom: 16px;
            width: 100%;
        }

        .kop table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop td.logo {
            width: 20mm;
            text-align: center;
            vertical-align: middle;
        }

        .kop td.logo img {
            width: 17mm;
            height: auto;
        }

        .kop td.teks {
            text-align: center;
            vertical-align: middle;
        }

        .kop td.spacer {
            width: 20mm;
        }

        .kop-teks {
            font-size: 10pt;
            text-transform: uppercase;
            line-height: 1.5;
        }

        /* ---- JUDUL SURAT ---- */
        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 18px 0 4px 0;
        }

        /* ---- NOMOR SURAT ---- */
        .nomor {
            text-align: center;
            font-size: 12pt;
            margin-bottom: 16px;
        }

        /* ---- PEMBUKA ---- */
        .pembuka {
            font-size: 12pt;
            line-height: 1.5;
            text-align: justify;
            margin-bottom: 12px;
        }

        /* ---- ISI SURAT ---- */
        .isi {
            font-size: 12pt;
            margin-bottom: 12px;
            width: 100%;
        }

        .isi table {
            width: 100%;
            border-collapse: collapse;
        }

        .isi table td {
            font-size: 12pt;
            line-height: 1.7;
            vertical-align: top;
            padding: 0;
        }

        .isi table td.label     { width: 50mm; }
        .isi table td.titik-dua { width: 8mm; text-align: left; }
        .isi table td.nilai     { width: auto; }

        /* ---- PENUTUP ---- */
        .penutup {
            font-size: 12pt;
            line-height: 1.5;
            text-align: justify;
            margin-bottom: 16px;
        }

        /* ---- TANDA TANGAN ---- */
        .ttd {
            margin-top: 36px;
            float: right;
            text-align: center;
            width: 65mm;
        }

        .ttd p { font-size: 12pt; margin: 2px 0; }

        .ttd .ruang-ttd { height: 22mm; }

        .ttd .nama-penandatangan {
            font-size: 12pt;
            font-weight: bold;
            border-top: 1px solid black;
            padding-top: 3px;
            display: inline-block;
            min-width: 55mm;
        }

        .ttd .nip { font-size: 10pt; margin-top: 2px; }

        .clear { clear: both; }
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
                    <div class="kop-teks">
                        {!! nl2br(e($template->kop_surat)) !!}
                    </div>
                </td>
                <td class="spacer"></td>
            </tr>
        </table>
    </div>

    {{-- JUDUL SURAT --}}
    <div class="judul">{{ $template->judul_surat }}</div>

    {{-- NOMOR SURAT --}}
    <div class="nomor">Nomor : {{ $surat->nomor_surat }}</div>

    {{-- PEMBUKA --}}
    <div class="pembuka">{{ $template->pembuka }}</div>

    {{-- ISI SURAT --}}
    <div class="isi">
        {!! $isiSurat !!}
    </div>

    {{-- PENUTUP --}}
    @if($template->penutup)
        <div class="penutup">{{ $template->penutup }}</div>
    @endif

    {{-- TANDA TANGAN --}}
    @php
        $bulanId = [
            1=>'Januari', 2=>'Februari', 3=>'Maret',    4=>'April',
            5=>'Mei',     6=>'Juni',     7=>'Juli',      8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November', 12=>'Desember',
        ];
        $tgl         = $surat->tanggal_surat;
        $tanggalIndo = $tgl->format('d') . ' ' . $bulanId[(int)$tgl->format('n')] . ' ' . $tgl->format('Y');
    @endphp

    <div class="ttd">
        <p>Banjaran, {{ $tanggalIndo }}</p>
        <p>{{ $template->penandatangan_jabatan }},</p>
        <div class="ruang-ttd"></div>
        <div>
            <span class="nama-penandatangan">{{ $template->penandatangan_nama }}</span>
        </div>
        @if($template->penandatangan_nip)
            <div class="nip">NIP. {{ $template->penandatangan_nip }}</div>
        @endif
    </div>
    <div class="clear"></div>

</div>{{-- end .wrapper --}}
</body>
</html>