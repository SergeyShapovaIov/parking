<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\RecipientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->input();
});

Route::prefix('v1')->group(function () {
   Route::prefix('address')->group(function () {
        Route::get('/', [AddressController::class, 'getAll'])->name('Api.v1.address.getAll');
        Route::get('/{id}', [AddressController::class, 'getById'])->name('Api.v1.address.getById')->whereNumber('id');
        Route::post('/', [AddressController::class, 'store'])->name('Api.v1.address.store');
        Route::put('/{id}', [AddressController::class, 'updateById'])->name('Api.v1.address.updateById')->whereNumber('id');
        Route::delete('/{id}', [AddressController::class, 'deleteById'])->name('Api.v1.address.deleteById')->whereNumber('id');
   });
   Route::prefix('recipient')->group(function () {
       Route::get('/', [RecipientController::class, 'getAll'])->name('Api.v1.recipient.getAll');
       Route::get('/{id}', [RecipientController::class, 'getById'])->name('Api.v1.recipient.getById')->whereNumber('id');
       Route::post('/', [RecipientController::class, 'store'])->name('Api.v1.recipient.store');
       Route::put('/{id}', [RecipientController::class, 'updateById'])->name('Api.v1.recipient.updateById')->whereNumber('id');
       Route::delete('/{id}', [RecipientController::class, 'deleteById'])->name('Api.v1.recipient.deleteById')->whereNumber('id');
   });
});
