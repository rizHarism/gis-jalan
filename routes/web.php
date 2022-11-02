<?php

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

Route::get('/', function () {
    return view('map.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/data/kelurahan', function () {
    return view('kelurahan.index');
});

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
