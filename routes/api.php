<?php

use App\Http\Controllers\API\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', 'Auth\RegisterController@check')->name('api-register-check');
Route::get('provinces', [LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies', [LocationController::class, 'regencies'])->name('api-regencies');
// Route::get('regencies/{provinces_id}', [LocationController::class, 'regencies'])
        // ->name('api-regencies');
Route::get('districts', [LocationController::class, 'districts'])
        ->name('api-districts');
Route::get('villages', [LocationController::class, 'villages'])
        ->name('api-villages');