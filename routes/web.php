<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Location;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('beranda');
    Route::get('/profile', 'HomeController@profil')->name('profil');
    Route::resource('profil', 'FUserController');
    Route::resource('absen', 'FAbsensiController');
    Route::post('absen/hadir', 'FAbsensiController@hadir')->name('absen-hadir');
    Route::resource('cuti', 'FCutiController');
    Route::resource('aktivitas', 'FAktivitasController');
    Route::resource('bensin', 'FBensinController');
    Route::resource('overtime', 'FLemburController');
    Route::resource('ceklis', 'FCeklisController');
    Route::resource('car', 'FMobilController');
});

Route::prefix('admin')
->middleware(['auth', 'is_admin'])
    ->group(function () {
    Route::get('dashboard', 'BackIndexController@index')->name('admin-dashboard');
    Route::resource('absensi', 'BackAbsenController');
    Route::post('absensi/cari', 'BackAbsenController@indexcari')->name('absensi.cari');
    Route::get('lembur', 'BackLemburController@index')->name('lembur.index');

    Route::resource('leave', 'BackCutiController');
    Route::resource('task', 'BackAktivitasController');
    Route::resource('lembur', 'BackLemburController');
    Route::resource('bbm', 'BackBensinController');
    Route::resource('user', 'BackUserController');
    Route::resource('cabang', 'BackCabangController');
    Route::resource('mobil', 'BackMobilController');
    Route::resource('unitkerja', 'BackUnitKerjaController');
    });

Route::get('admin/rekaplembur', 'BackExportController@lemburExport')->name('lembur.export');
Route::get('admin/rekapabsen', 'BackExportController@absenExport')->name('absen.export');
Route::get('admin/rekapbensin', 'BackExportController@bensinExport')->name('bensin.export');
Auth::routes();
