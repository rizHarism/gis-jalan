<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\RuasJalanController;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route for map page
Route::get('/', [MapController::class, 'index']);
Route::get('/get/polygon', [MapController::class, 'getPolygon']);
Route::get('/get/ruas/select', [MapController::class, 'getRuasId']);
Route::get('/get/{id}/polygon', [MapController::class, 'show']);
Route::get('/get/{kecamatan}/{kelurahan}/{kondisi}/{perkerasan}', [MapController::class, 'filterPolygon']);
Route::get('/get/{id}/ruas', [MapController::class, 'filterRuasId']);
Route::get('/get/{id}/pemeliharaan', [MapController::class, 'pemeliharaan']);
// Route::get('/get/pemeliharaan/ruas', [MapController::class, 'test']);

// route for select option list
Route::get('/get/kecamatan', [KecamatanController::class, 'getKecamatan']);
Route::get('/get/kelurahan/{id}', [KelurahanController::class, 'getKelurahan']);

// route for dashboard page
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/get/ruas/dashboard', [DashboardController::class, 'getChart']);
Route::get('/get/ruas/{kec}/{kel}/dashboard', [DashboardController::class, 'getFilterChart']);

// route for master / data kecamatan
Route::get('/data/kecamatan', [KecamatanController::class, 'index']);
Route::get('/data/kecamatan/datatables', [KecamatanController::class, 'datatables']);
Route::get('/data/kecamatan/{id}/show', [KecamatanController::class, 'show']);
Route::post('/data/kecamatan/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
Route::put('/data/kecamatan/{id}/update', [KecamatanController::class, 'update'])->name('kecamatan.update');
Route::delete('/data/kecamatan/{id}/destroy', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');

// route for master kelurahan
Route::get('/data/kelurahan', [KelurahanController::class, 'index']);
Route::get('/data/kelurahan/datatables', [KelurahanController::class, 'datatables']);
Route::get('/data/kelurahan/{id}/show', [KelurahanController::class, 'show']);
Route::post('/data/kelurahan/store', [KelurahanController::class, 'store'])->name('kelurahan.store');
Route::put('/data/kelurahan/{id}/update', [KelurahanController::class, 'update'])->name('kelurahan.update');
Route::delete('/data/kelurahan/{id}/destroy', [KelurahanController::class, 'destroy'])->name('kelurahan.destroy');

// route for data ruas jalan kelurahan
Route::get('/ruas/kelurahan', [RuasJalanController::class, 'index']);
Route::get('/ruas/kelurahan/datatables', [RuasJalanController::class, 'datatables']);
Route::get('/ruas/{kec}/{kel}/kelurahan/', [RuasJalanController::class, 'filterRuas']);
Route::get('/ruas/kelurahan/{id}/show', [RuasJalanController::class, 'show']);
Route::get('/ruas/kelurahan/create', [RuasJalanController::class, 'create'])->name('ruas.kelurahan.create');
Route::get('/ruas/kelurahan/{id}/edit', [RuasJalanController::class, 'edit'])->name('ruas.kelurahan.edit');

Route::get('/data/desa', function () {
    return view('desa.index');
});

Route::get('/data/penyediajasa', [PenyediaController::class, 'index']);
Route::get('/data/penyediajasa/datatables', [PenyediaController::class, 'datatables']);

Route::get('/data/pemeliharaan', [PemeliharaanController::class, 'index']);
Route::get('/data/pemeliharaan/datatables', [PemeliharaanController::class, 'datatables']);
Route::get('/data/pemeliharaan/tesJson', [PemeliharaanController::class, 'tesJson']);

Route::get('/data/user', function () {
    return view('user.index');
});

// Route::get('/master/kecamatan', function () {
//     return view('master.kecamatan.index');
// });

// Route::get('/master/kelurahan', function () {
//     return view('master.kelurahan.index');
// });
