<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Informasi Desa
    |--------------------------------------------------------------------------
    | Isi data di bawah sesuai dengan informasi desa Anda.
    | Setelah diubah, jalankan: php artisan config:clear
    */

    // Nama lengkap desa
    'nama' => env('DESA_NAMA', 'Desa Contoh'),

    // Nomor WhatsApp admin (format: 62xxxxxxxxxx, tanpa +, tanpa spasi)
    'whatsapp' => env('DESA_WHATSAPP', ''),

    // Nomor telepon kantor desa (boleh kosong jika tidak ada)
    'telepon' => env('DESA_TELEPON', ''),

    // Email admin desa (boleh kosong jika tidak ada)
    'email' => env('DESA_EMAIL', ''),

    // Alamat kantor desa
    'alamat' => env('DESA_ALAMAT', ''),

    // Jam operasional (ditampilkan di halaman sukses)
    'jam_operasional' => env('DESA_JAM_OPERASIONAL', 'Senin – Jumat, 08.00 – 15.00 WIB'),

];