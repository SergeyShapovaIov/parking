<?php


use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::prefix('car')->group(function() {
    Route::get('getAll', [CarController::class, 'getAll'])->name('car.getAll');
    Route::post('create', [CarController::class, 'store'])->name('car.store');
    Route::get('{car}', [CarController::class, 'show'])->name('car.show')->whereNumber('car');
    Route::get('{car}/edit', [CarController::class, 'edit'])->name('car.edit')->whereNumber('car');
    Route::post('update', [CarController::class, 'update'])->name('car.update')->whereNumber('car');
    Route::delete('{car}', [CarController::class, 'delete'])->name('car.delete')->whereNumber('car');
    Route::get('by-id-client/{id}', [CarController::class, 'getByIdClient'])->name('car.byIdClient')->whereNumber('id');
    Route::post('update-status/add', [CarController::class, 'upStatusByCarId'])->name('car.update-status.add');
    Route::post('update-status/delete', [CarController::class, 'downStatusByCarId'])->name('car.update-status.delete');
    Route::post('updateOwner', [CarController::class, 'updateOwner'])->name('car.update-owner');
});
