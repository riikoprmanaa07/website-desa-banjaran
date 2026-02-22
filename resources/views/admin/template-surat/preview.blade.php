<!DOCTYPE html>
<html>
<head>
    <title>Preview: {{ $template->nama_template }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; margin: 40px; line-height: 1.8; }
        .kop-surat { text-align: center; border-bottom: 3px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .judul { text-align: center; font-weight: bold; margin: 20px 0; text-decoration: underline; }
        .nomor { text-align: center; margin-bottom: 30px; }
        .isi { text-align: justify; white-space: pre-line; }
        .ttd { margin-top: 40px; text-align: right; }
        .warning { background: #fff3cd; border: 2px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 5px; }
        @media print { .warning, .no-print { display: none; } }
    </style>
</head>
<body>
    

    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #f59e0b; color: white; border: none; border-radius: 5px; cursor: pointer;">
            🖨️ Print Preview
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #6b7280; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
            ✕ Tutup
        </button>
    </div>

    <div class="kop-surat">
        {!! nl2br(e($template->kop_surat)) !!}
    </div>

    <div class="judul">{{ $template->judul_surat }}</div>
    <div class="nomor">Nomor: 001/SK/DS/II/2024</div>

    <div class="isi">
{{ $template->pembuka }}

{{ $preview }}

@if($template->penutup)
{{ $template->penutup }}
@endif
    </div>

    <div class="ttd">
        <p>Banjaran, 16 Februari 2024<br>
        {{ $template->penandatangan_jabatan }}</p>
        <p style="margin-top: 80px;">
            <strong>{{ $template->penandatangan_nama }}</strong><br>
            @if($template->penandatangan_nip)
            NIP. {{ $template->penandatangan_nip }}
            @endif
        </p>
    </div>
</body>
</html>