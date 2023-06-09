<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [ViewController::class, 'index'])->name('index');
Route::get('/car-list', [ViewController::class, 'carList'])->name('car-list');
Route::get('/client-list', [ViewController::class, 'clientList'])->name('client-list');
Route::get('/add-client', [ViewController::class, 'addClient'])->name('add-client');
Route::get('/add-car', [ViewController::class, 'addCar'])->name('add-car');
Route::get('/parking-congestion', [ViewController::class, 'parkingCongestion'])->name('parking-congestion');
Route::get('/client-update/{client_id}', [ViewController::class, 'clientUpdateById'])->name('client-update')->whereNumber('client_id');
Route::get('/car-update/{car_id}', [ViewController::class, 'carUpdateById'])->name('car-update')->whereNumber('car_id');
Route::get('/car-update-without_owner/', [ViewController::class, 'carUpdateWithoutOwner'])->name('car-update-without-owner');

Route::prefix('client')->group(function() {
    Route::get('getAll', [ClientController::class, 'getAll'])->name('client.getAll');
    Route::post('create', [ClientController::class, 'store'])->name('client.store');
    Route::get('{client}', [ClientController::class, 'show'])->name('client.show')->whereNumber('client');
    Route::get('{client}/edit', [ClientController::class, 'edit'])->name('client.edit')->whereNumber('client');
    Route::post('update', [ClientController::class, 'update'])->name('client.update')->whereNumber('client');
    Route::delete('{client}', [ClientController::class, 'delete'])->name('client.delete')->whereNumber('client');
});

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

