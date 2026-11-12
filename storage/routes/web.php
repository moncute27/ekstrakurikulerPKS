<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman publik
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'beranda'])->name('beranda');
Route::get('/beranda', fn () => redirect()->route('beranda'));
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/organisasi', [PublicController::class, 'organisasi'])->name('organisasi');
Route::get('/berita', [PublicController::class, 'berita'])->name('berita.index');
Route::get('/berita/{berita}', [PublicController::class, 'beritaDetail'])->name('berita.show');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/prestasi', [PublicController::class, 'prestasi'])->name('prestasi');
Route::get('/anggota', [PublicController::class, 'anggota'])->name('anggota');
Route::get('/agenda', [PublicController::class, 'agenda'])->name('agenda');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Alias lama agar tautan "/user" tetap berfungsi.
Route::get('/user', fn () => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| Halaman admin (backend)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'));

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Nama parameter ditulis eksplisit karena Laravel tidak bisa menebak
    // bentuk tunggal dari kata bahasa Indonesia.
    Route::resource('pengurus', PengurusController::class)->except('show')->parameters(['pengurus' => 'pengurus']);
    Route::resource('berita', BeritaController::class)->except('show')->parameters(['berita' => 'berita']);
    Route::resource('galeri', GaleriController::class)->except('show')->parameters(['galeri' => 'galeri']);
    Route::resource('prestasi', PrestasiController::class)->except('show')->parameters(['prestasi' => 'prestasi']);
    Route::resource('anggota', AnggotaController::class)->except('show')->parameters(['anggota' => 'anggota']);
    Route::resource('agenda', AgendaController::class)->except('show')->parameters(['agenda' => 'agenda']);
    Route::resource('user', UserController::class)->except('show')->parameters(['user' => 'user']);
});
