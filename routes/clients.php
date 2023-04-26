<?php


use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::controller(ClientController::class)->prefix('client')->group(function() {

    Route::get('getAll', 'getAll')->name('client.getAll');
    Route::post('create', 'store')->name('client.store');
    Route::get('{client}', 'show')->name('client.show')->whereNumber('client');
    Route::get('{client}/edit', 'edit')->name('client.edit')->whereNumber('client');
    Route::post('update', 'update')->name('client.update')->whereNumber('client');
    Route::delete('{client}',  'delete')->name('client.delete')->whereNumber('client');

});
