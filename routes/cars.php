<?php


use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::controller(CarController::class)->prefix('car')->group( function () {
    Route::get('getAll','getAll')->name('car.getAll');
    Route::post('create', 'store')->name('car.store');
    Route::get('{car}', 'show')->name('car.show')->whereNumber('car');
    Route::get('{car}/edit', 'edit')->name('car.edit')->whereNumber('car');
    Route::post('update',  'update')->name('car.update')->whereNumber('car');
    Route::delete('{car}',  'delete')->name('car.delete')->whereNumber('car');
    Route::get('by-id-client/{id}','getByIdClient')->name('car.byIdClient')->whereNumber('id');
    Route::post('update-status/add', 'upStatusByCarId')->name('car.update-status.add');
    Route::post('update-status/delete',  'downStatusByCarId')->name('car.update-status.delete');
    Route::post('updateOwner','updateOwner')->name('car.update-owner');
});

