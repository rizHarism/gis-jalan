<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\RuasJalanController;
use App\Http\Controllers\Admin\RoleController;
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

Auth::routes([
    'register' => false,
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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

Route::middleware(['auth'])->group(function () {

    // route for dashboard page
    Route::get('/dashboard', [DashboardController::class, 'index'])->can('Dashboard.Index');
    Route::get('/chart/ruas/dashboard', [DashboardController::class, 'getChart'])->can('Dashboard.Index');
    Route::get('/chart/ruas/{kec}/{kel}/dashboard', [DashboardController::class, 'getFilterChart'])->can('Dashboard.Index');

    // route for master / data kecamatan
    Route::get('/data/kecamatan', [KecamatanController::class, 'index'])->can('Data Wilayah.Kecamatan');
    Route::get('/data/kecamatan/datatables', [KecamatanController::class, 'datatables'])->can('Data Wilayah.Kecamatan');
    Route::get('/data/kecamatan/{id}/show', [KecamatanController::class, 'show'])->can('Data Wilayah.kecamatan');
    Route::post('/data/kecamatan/store', [KecamatanController::class, 'store'])->name('kecamatan.store')->can('Data Wilayah.kecamatan');
    Route::put('/data/kecamatan/{id}/update', [KecamatanController::class, 'update'])->name('kecamatan.update')->can('Data Wilayah.kecamatan');
    Route::delete('/data/kecamatan/{id}/destroy', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy')->can('Data Wilayah.kecamatan');

    // route for master kelurahan
    Route::get('/data/kelurahan', [KelurahanController::class, 'index'])->can('Data Wilayah.Kelurahan');
    Route::get('/data/kelurahan/datatables', [KelurahanController::class, 'datatables'])->can('Data Wilayah.Kelurahan');
    Route::get('/data/{kec}/filter', [KelurahanController::class, 'filterkelurahan'])->can('Data Wilayah.Kelurahan');
    Route::get('/data/kelurahan/{id}/show', [KelurahanController::class, 'show'])->can('Data Wilayah.Kelurahan');
    Route::post('/data/kelurahan/store', [KelurahanController::class, 'store'])->name('kelurahan.store')->can('Data Wilayah.Kelurahan');
    Route::put('/data/kelurahan/{id}/update', [KelurahanController::class, 'update'])->name('kelurahan.update')->can('Data Wilayah.Kelurahan');
    Route::delete('/data/kelurahan/{id}/destroy', [KelurahanController::class, 'destroy'])->name('kelurahan.destroy')->can('Data Wilayah.Kelurahan');

    // route for data ruas jalan kelurahan
    Route::get('/ruas/kelurahan', [RuasJalanController::class, 'index'])->name('ruas.kelurahan.index')->can('Ruas Jalan.Kelurahan');
    Route::get('/ruas/kelurahan/datatables', [RuasJalanController::class, 'datatables'])->name('ruas.kelurahan.datatables')->can('Ruas Jalan.Kelurahan');
    Route::get('/ruas/{kec}/{kel}/{kon}/{ker}/filter', [RuasJalanController::class, 'filterRuas'])->name('ruas.kelurahan.filterRuas')->can('Ruas Jalan.Kelurahan');
    Route::get('/ruas/kelurahan/{id}/show', [RuasJalanController::class, 'show'])->name('ruas.kelurahan.show')->can('Ruas Jalan.Kelurahan');
    Route::get('/ruas/kelurahan/create', [RuasJalanController::class, 'create'])->name('ruas.kelurahan.create')->can('Ruas Jalan.Kelurahan');
    Route::post('/ruas/kelurahan/store', [RuasJalanController::class, 'store'])->name('ruas.kelurahan.store')->can('Ruas Jalan.Kelurahan');
    Route::get('/ruas/kelurahan/{id}/edit', [RuasJalanController::class, 'edit'])->name('ruas.kelurahan.edit')->can('Ruas Jalan.Kelurahan');
    Route::put('/ruas/kelurahan/{id}/update', [RuasJalanController::class, 'update'])->name('ruas.kelurahan.update')->can('Ruas Jalan.Kelurahan');
    Route::delete('/ruas/kelurahan/{id}/destroy', [RuasJalanController::class, 'destroy'])->name('ruas.kelurahan.destroy')->can('Ruas Jalan.Kelurahan');

    Route::get('/data/desa', function () {
        return view('desa.index');
    });

    // route for penyedia jasa
    Route::get('/data/penyediajasa', [PenyediaController::class, 'index'])->can('Data Pemeliharaan.Penyedia Jasa');
    Route::get('/get/penyediajasa', [PenyediaController::class, 'getPenyedia'])->can('Data Pemeliharaan.Penyedia Jasa');
    Route::get('/data/penyediajasa/datatables', [PenyediaController::class, 'datatables'])->can('Data Pemeliharaan.Penyedia Jasa');
    Route::get('/data/penyediajasa/{id}/show', [PenyediaController::class, 'show'])->can('Data Pemeliharaan.Penyedia Jasa');
    Route::post('/data/penyediajasa/store', [PenyediaController::class, 'store'])->can('Data Pemeliharaan.Penyedia Jasa');
    Route::put('/data/penyediajasa/{id}/update', [PenyediaController::class, 'update'])->can('Data Pemeliharaan.Penyedia Jasa');
    Route::delete('/data/penyediajasa/{id}/destroy', [PenyediaController::class, 'destroy'])->can('Data Pemeliharaan.Penyedia Jasa');


    // route pemeliharaan
    Route::get('/data/pemeliharaan', [PemeliharaanController::class, 'index'])->can('Data Pemeliharaan.Riwayat Pemeliharaan');
    Route::get('/data/pemeliharaan/datatables', [PemeliharaanController::class, 'datatables'])->can('Data Pemeliharaan.Riwayat Pemeliharaan');
    Route::get('/data/pemeliharaan/{id}/filter', [PemeliharaanController::class, 'filterPemeliharaan'])->can('Data Pemeliharaan.Riwayat Pemeliharaan');
    Route::get('/data/pemeliharaan/{id}/show', [PemeliharaanController::class, 'show'])->can('Data Pemeliharaan.Riwayat Pemeliharaan');
    Route::post('/data/pemeliharaan/store', [PemeliharaanController::class, 'store'])->can('Data Pemeliharaan.Riwayat Pemeliharaan');
    Route::post('/data/pemeliharaan/{id}/update', [PemeliharaanController::class, 'update'])->can('Data Pemeliharaan.Riwayat Pemeliharaan');
    Route::delete('/data/pemeliharaan/{id}/destroy', [PemeliharaanController::class, 'destroy'])->can('Data Pemeliharaan.Riwayat Pemeliharaan');
    // Route::get('/data/pemeliharaan/tesJson', [PemeliharaanController::class, 'tesJson']);

    // route data user
    Route::get('/admin/user', [UserController::class, 'index'])->name('administrator.user.index')->can('Administrator.Data User');
    Route::get('/admin/user/datatables', [UserController::class, 'datatables'])->name('administrator.user.datatables')->can('Administrator.Data User');
    Route::get('/admin/user/{id}/show', [UserController::class, 'show'])->name('administrator.user.show')->can('Administrator.Data User');
    Route::get('/admin/get/role', [UserController::class, 'getRole'])->name('administrator.get.role')->can('Administrator.Data User');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('administrator.user.store')->can('Administrator.Data User');
    Route::put('/admin/user/{id}/update', [UserController::class, 'update'])->name('administrator.user.update')->can('Administrator.Data User');
    Route::delete('/admin/user/{id}/delete', [UserController::class, 'destroy'])->name('administrator.user.delete')->can('Administrator.Data User');

    // route role user
    Route::get('/admin/role', [RoleController::class, 'index'])->name('administrator.role.index')->can('Administrator.Hak Akses');
    Route::get('/admin/role/datatables', [RoleController::class, 'datatables'])->name('administrator.role.datatables')->can('Administrator.Hak Akses');
    Route::get('/admin/role/create', [RoleController::class, 'create'])->name('administrator.role.create')->can('Administrator.Hak Akses');
    Route::get('/admin/role/{id}/edit', [RoleController::class, 'edit'])->name('administrator.role.show')->can('Administrator.Hak Akses');
    Route::post('/admin/role/store', [RoleController::class, 'store'])->name('administrator.role.store')->can('Administrator.Hak Akses');
    Route::put('/admin/role/{id}/update', [RoleController::class, 'update'])->name('administrator.role.update')->can('Administrator.Hak Akses');
    Route::delete('/admin/role/{id}/delete', [RoleController::class, 'destroy'])->name('administrator.role.delete')->can('Administrator.Hak Akses');

    // route role user
    // Route::get('/setting', [SettingController::class, 'index'])->name('administrator.setting.index')->can('Administrator.Setting');
    // Route::get('/setting/update', [SettingController::class, 'update'])->name('administrator.setting.update')->can('Administrator.Setting');
});
