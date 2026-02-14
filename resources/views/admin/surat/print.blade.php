<!DOCTYPE html>
<html>
<head>
    <title>Print Surat</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 40px;
        }

        .kop {
            text-align: center;
        }

        .kop img {
            width: 80px;
            position: absolute;
            left: 40px;
            top: 40px;
        }

        .line {
            border-bottom: 3px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 20px;
        }

        table {
            margin-top: 10px;
        }

        .ttd {
            width: 100%;
            margin-top: 60px;
        }

        .ttd-kanan {
            text-align: right;
        }

        .cap {
            margin-top: -80px;
            margin-left: 50px;
            opacity: 0.7;
        }

    </style>
</head>
<body onload="window.print()">

    <!-- ================== KOP SURAT ================== -->
    <div class="kop">
        {{-- Logo Desa --}}
        <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo Desa">

        <h2>PEMERINTAH DESA BANJARAN</h2>
        <h4>KECAMATAN XXXXX KABUPATEN XXXXX</h4>
        <p>Jl. Raya Desa No. 1, Banjaran</p>
        <p>Telp: 0812-XXXX-XXXX</p>
    </div>

    <div class="line"></div>

    <!-- ================== NOMOR & TANGGAL ================== -->
    <p><strong>Nomor :</strong> {{ $surat->nomor_surat }}</p>
    <p><strong>Tanggal :</strong> 
        {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}
    </p>
    <p><strong>Perihal :</strong> {{ $surat->jenis_surat }}</p>

    <br>

    <!-- ================== PENERIMA ================== -->
    <p>Yth.</p>
    <p><strong>{{ $surat->penduduk->nama }}</strong></p>
    <p>Di Tempat</p>

    <br>

    <!-- ================== ISI SURAT ================== -->
    <div class="content">
        <p>Dengan hormat,</p>

        <p>
            Berdasarkan permohonan yang bersangkutan, Pemerintah Desa Banjaran 
            dengan ini menerangkan bahwa:
        </p>

        <table>
            <tr>
                <td width="150">Nama</td>
                <td>: {{ $surat->penduduk->nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $surat->penduduk->nik }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $surat->penduduk->alamat }}</td>
            </tr>
        </table>

        <br>

        <p>
            Surat ini dibuat untuk keperluan:
            <strong>{{ $surat->keperluan }}</strong>.
        </p>

        <p>
            Demikian surat ini dibuat dengan sebenarnya agar dapat digunakan sebagaimana mestinya.
        </p>
    </div>

    <!-- ================== PENUTUP ================== -->
    <br><br>

    <table class="ttd">
        <tr>
            <td></td>
            <td class="ttd-kanan">
                Banjaran, {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}
                <br><br>
                <strong>{{ $surat->penandatangan }}</strong>
                <br>
                Kepala Desa Banjaran
            </td>
        </tr>
    </table>

    <!-- ================== CAP DESA ================== -->
    <div class="cap">
        <img src="{{ asset('images/cap-desa.png') }}" width="120">
    </div>

</body>
</html>
