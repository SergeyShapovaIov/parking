<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
   Route::prefix('address')->group(function () {
        Route::get('/', [AddressController::class, 'getAll'])->name('api.v1.address.getAll');
        Route::get('/{id}', [AddressController::class, 'getById'])->name('api.v1.address.getById')->whereNumber('id');
        Route::post('/', [AddressController::class, 'store'])->name('api.v1.address.store');
        Route::put('/{id}', [AddressControler::class, 'updateById'])->name('api.v1.address.updateById')->whereNumber('id');
        Route::delete('/{id}', [AddressController::class, 'deleteById'])->name('api.v1.address.deleteById')->whereNumber('id');
   });
   Route::prefix('recipient')->group(function () {
       Route::get('/', [RecipientController::class, 'getAll'])->name('api.v1.recipient.getAll');
       Route::get('/{id}', [RecipientController::class, 'getById'])->name('api.v1.recipient.getById')->whereNumber('id');
       Route::post('/', [RecipientController::class, 'store'])->name('api.v1.recipient.store');
       Route::put('/{id}', [RecipientController::class, 'updateById'])->name('api.v1.recipient.updateById')->whereNumber('id');
       Route::delete('/{id}', [RecipientController::class, 'deleteById'])->name('api.v1.recipient.deleteById')->whereNumber('id');
   });
});
