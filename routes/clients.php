<?php


use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->group(function() {
    Route::get('getAll', [ClientController::class, 'getAll'])->name('client.getAll');
    Route::post('create', [ClientController::class, 'store'])->name('client.store');
    Route::get('{client}', [ClientController::class, 'show'])->name('client.show')->whereNumber('client');
    Route::get('{client}/edit', [ClientController::class, 'edit'])->name('client.edit')->whereNumber('client');
    Route::post('update', [ClientController::class, 'update'])->name('client.update')->whereNumber('client');
    Route::delete('{client}', [ClientController::class, 'delete'])->name('client.delete')->whereNumber('client');
});
