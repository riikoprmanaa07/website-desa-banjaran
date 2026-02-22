<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body  { font-family: "Times New Roman", serif; font-size: 12pt; margin: 50px; }
        .kop  { text-align: center; border-bottom: 3px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .kop h2 { margin: 0; font-size: 15pt; text-transform: uppercase; letter-spacing: 1px; }
        .kop h3 { margin: 4px 0 0; font-size: 12pt; }
        .kop p  { margin: 2px 0; font-size: 10pt; }
        .judul  { text-align: center; margin: 24px 0 4px; font-size: 14pt; font-weight: bold;
                  text-decoration: underline; text-transform: uppercase; }
        .nomor  { text-align: center; margin-bottom: 20px; font-size: 11pt; }
        .pembuka { margin-bottom: 16px; line-height: 1.8; text-align: justify; }
        .isi    { white-space: pre-line; line-height: 2; margin-bottom: 16px; }
        .penutup { line-height: 1.8; text-align: justify; margin-bottom: 20px; }
        .ttd    { margin-top: 50px; float: right; text-align: center; width: 260px; }
        .ttd .garis { margin-top: 80px; border-top: 1px solid black; padding-top: 4px; }
        .ttd p  { margin: 2px 0; }
        .clear  { clear: both; }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop">
        {!! nl2br(e($template->kop_surat)) !!}
    </div>

    {{-- JUDUL --}}
    <div class="judul">{{ $template->judul_surat }}</div>
    <div class="nomor">Nomor: {{ $surat->nomor_surat }}</div>

    {{-- PEMBUKA --}}
    <div class="pembuka">{{ $template->pembuka }}</div>

    {{-- ISI SURAT (placeholder sudah di-replace) --}}
    <div class="isi">{{ $isiSurat }}</div>

    {{-- PENUTUP --}}
    @if($template->penutup)
        <div class="penutup">{{ $template->penutup }}</div>
    @endif

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <p>Banjaran, {{ $surat->tanggal_surat->format('d F Y') }}</p>
        <p>{{ $template->penandatangan_jabatan }},</p>
        <div class="garis">
            <strong>{{ $template->penandatangan_nama }}</strong>
            @if($template->penandatangan_nip)
                <p style="font-size:10pt;">NIP. {{ $template->penandatangan_nip }}</p>
            @endif
        </div>
    </div>
    <div class="clear"></div>

</body>
</html>