<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\RWController;
use App\Http\Controllers\Admin\RTController;
use App\Http\Controllers\Admin\TemplateSuratController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\StrukturDesaController;
use App\Http\Controllers\Admin\BpdController;

// Admin Login
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Penduduk CRUD
    Route::resource('penduduk', PendudukController::class);
    
    // Surat CRUD
    Route::resource('surat', SuratController::class);
    Route::post('surat/{id}/update-status', [SuratController::class, 'updateStatus'])->name('surat.update-status');
    Route::get('surat/{id}/print', [SuratController::class, 'print'])->name('surat.print');

    Route::patch('surat/{id}/verifikasi', [SuratController::class, 'verifikasi'])->name('surat.verifikasi');

    Route::resource('template-surat', TemplateSuratController::class);
    Route::get('template-surat/{id}/preview', [TemplateSuratController::class, 'preview'])->name('template-surat.preview');
    
    // Berita CRUD
    Route::resource('berita', BeritaController::class);
    Route::post('berita/{id}/publish', [BeritaController::class, 'publish'])->name('berita.publish');
    
    // Galeri CRUD
  Route::post('galeri/bulk-delete', [AdminGaleriController::class, 'bulkDelete'])->name('galeri.bulk-delete');
Route::resource('galeri', AdminGaleriController::class);

    
    // RW CRUD
    Route::resource('rw', RWController::class)->except(['show']);
    
    // RT CRUD
    Route::resource('rt', RTController::class)->except(['show']);
    
    // Struktur Desa CRUD
    Route::resource('struktur', StrukturDesaController::class)->except(['show']);
    Route::post('struktur/reorder', [StrukturDesaController::class, 'reorder'])
        ->name('struktur.reorder');

Route::resource('bpd', BpdController::class)->except(['show']);
Route::post('bpd/reorder', [BpdController::class, 'reorder'])->name('bpd.reorder');
});

// Rute untuk Warga (Public)
Route::get('/ajukan-surat', [PengajuanSuratController::class, 'index'])->name('pengajuan.index');
Route::post('/ajukan-surat', [PengajuanSuratController::class, 'store'])->name('pengajuan.store');
Route::get('/ajukan-surat/sukses/{nomor}', [PengajuanSuratController::class, 'sukses'])->name('pengajuan.sukses');
Route::get('/cek-pengajuan', [PengajuanSuratController::class, 'cek'])->name('pengajuan.cek');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'profile'])->name('profile');
Route::get('/sejarah', [HistoryController::class, 'index'])->name('history');
Route::get('/data-desa', [DataController::class, 'index'])->name('data');
Route::get('/berita', [NewsController::class, 'index'])->name('news');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/berita/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/layanan', [ServiceController::class, 'index'])->name('services');
Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

