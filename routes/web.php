<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [RumahSakitController::class, 'showRumahSakit'])->name('showRumahSakit')->middleware('auth');
Route::get('/rumah-sakit/create', [RumahSakitController::class, 'create'])->name('createRumahSakit');
Route::post('/rumah-sakit/store', [RumahSakitController::class, 'store'])->name('storeRumahSakit');
Route::get('/rumah-sakit/{id}', [RumahSakitController::class, 'show'])->name('detailRumahSakit');
Route::delete('/rumah-sakit/{id}', [RumahSakitController::class, 'destroy'])->name('destroyRumahSakit');
Route::get('/rumah-sakit/{id}/edit', [RumahSakitController::class, 'edit'])->name('editRumahSakit');
Route::put('/rumah-sakit/{id}', [RumahSakitController::class, 'update'])->name('updateRumahSakit');

Route::get('/pasien', [PasienController::class, 'index'])->name('showPasien')->middleware('auth');
Route::get('/pasien/create', [PasienController::class, 'create'])->name('createPasien');
Route::post('/pasien/store', [PasienController::class, 'store'])->name('storePasien');
Route::get('/pasien/{id}', [PasienController::class, 'show'])->name('detailPasien');
Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('destroyPasien');
Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('editPasien');
Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('updatePasien');
Route::get('/pasien-filter', [PasienController::class, 'filterByRumahSakit'])->name('filterPasien');