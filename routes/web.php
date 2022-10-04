<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminManajemenRoleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
// Login
Route::get('/', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'loginAdmin'])->name('login-admin');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [App\Http\Controllers\LoginController::class, 'forgotPassword'])->name('forgotPassword-admin');
Route::post('/forgot-password', [App\Http\Controllers\LoginController::class, 'forgotPasswordEmail'])->name('forgotPasswordEmail-admin');
Route::get('/reset-password', [App\Http\Controllers\LoginController::class, 'reset'])->name('resetPass-admin');
Route::post('/reset-password', [App\Http\Controllers\LoginController::class, 'resetPassword'])->name('resetPassword-admin');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('places', 'PlaceController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/admins', 'UsersController');
    Route::resource('/anggotas', 'AnggotaController');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//Maps
Route::get('/placemap', 'PlaceMapController@index')->name('frontpage');
Route::get('/place/data', 'DataController@places')->name('place.data'); // DATA TABLE CONTROLLER
Route::put('/places/update/{id}', 'PlaceController@update'); // DATA TABLE CONTROLLER

//
Route::post('/place/datatable', 'DataController@kegiatan_datatable')->name('kegiatan.datatable'); // DATA TABLE CONTROLLER
// Route::resource('/roles', 'PlaceController');

// SAMPLE MAP DISPLAY
//Route::get('/sample', 'PlaceController@sampleMap')->name('sample');

//roles
// Route::get('/roles', 'RoleController@index');
// Route::get('/roles-tambah', 'RoleController@create');

Route::POST('/roles-update', 'RoleController@grole_update');
//users atau data Admin

Route::POST('/admins-update', 'UsersController@update_admins');

Route::POST('/anggotas-update', 'AnggotaController@anggota_update');

//cetak laporan
Route::resource('/laporan', 'LaporanController');
Route::get('/cetak/{tglawal}/{tglakhir}','App\Http\Controllers\LaporanController@cetak')->name('cetak');
Route::get('/print/{anggota_id}','App\Http\Controllers\LaporanController@cetak')->name('print');
//print
Route::get('/printkeg', 'PlaceController@printKegiatan');

//import
Route::get('/anggotas-import', 'AnggotaController@show_import')->name('show_import');
Route::POST('/import-anggotas', 'AnggotaController@import')->name('anggotaImport');

//places perbaruan

Route::get('/keg/edit/{id}','PlaceController@keg_edit');
Route::get('/keg/detail/{id}','PlaceController@keg_show');
Route::get('/keg/hapus/{id}','PlaceController@keg_delete');
//
Route::get('/keg/conf/{id}','PlaceController@conf_place');
Route::POST('/places/conf', 'PlaceController@confir'); // DATA TABLE CONTROLLER


