<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {
    Route::get('places', 'PlaceController@index')->name('places.index');
    Route::get('placesconf', 'PlaceController@mapconf')->name('places.mapconf');
});

/**
 * route "/login"
 * @method "POST"
 */
Route::post('login', [UserController::class, 'login']);

Route::get('notif/{anggota_id}', [UserController::class, 'get_notif_token']);
Route::post('notif/create', [UserController::class, 'set_notif_token']);
Route::post('notif/update', [UserController::class, 'update_notif_token']);

/**
 * Anggota GetAll
 */
Route::get('anggota', [AnggotaController::class, 'get_all_anggota']);
Route::post('anggota/upload', [AnggotaController::class, 'upload_foto']);
Route::put('anggota/update/{id}', [AnggotaController::class, 'update_foto']);

/**
 * Place GetAll
 */
Route::get('tempat', [TempatController::class, 'get_all_places']);

/**
 * Place PostConfirmKegiatan
 */
Route::put('tempat/update/{id}', [TempatController::class, 'update_confirm_kegiatan']);

Route::post('tempat/upload', [TempatController::class, 'upload_image']);
