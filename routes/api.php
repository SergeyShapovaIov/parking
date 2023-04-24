<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\CarController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cars')->group( function () {
    Route::get('/', [CarController::class, 'getAll'])->name('api.car.get-all');
    Route::get('/byFilter', [CarController::class, 'getByFilter'])->name('api.car.get-filter');
    Route::post('/', [CarController::class, 'store'])->name('api.car.store');
    Route::delete('/{id}', [CarController::class, 'deleteById'])->name('api.car.delete-by-id')->whereNumber('id');
    Route::delete('/owner/{id}', [CarController::class, 'deleteByOwnerId'])->name('api.car.delete-by-owner-id');
    Route::put('/{id}', [CarController::class, 'update'])->name('api.car.update');
});
