<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MapController;
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
Route::get('/get/{kecamatan}/{kelurahan}/{kondisi}', [MapController::class, 'filterPolygon']);

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

// route for master kelurahan
Route::get('/data/kelurahan', [KelurahanController::class, 'index']);
Route::get('/data/kelurahan/datatables', [KelurahanController::class, 'datatables']);
Route::get('/data/kelurahan/{id}/show', [KelurahanController::class, 'show']);


Route::get('/data/desa', function () {
    return view('desa.index');
});

Route::get('/data/penyediajasa', function () {
    return view('penyedia.index');
});

Route::get('/data/pemeliharaan', function () {
    return view('pemeliharaan.index');
});

Route::get('/data/user', function () {
    return view('user.index');
});

// Route::get('/master/kecamatan', function () {
//     return view('master.kecamatan.index');
// });

// Route::get('/master/kelurahan', function () {
//     return view('master.kelurahan.index');
// });
