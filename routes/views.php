<?php


use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::group( ['middleware' => 'auth'], function () {
//    Route::get('/',  'index')->name('index');
    Route::get('/car-list',  [ViewController::class, 'carList'])->name('car-list');
    Route::get('/client-list', [ViewController::class, 'clientList'])->name('client-list');
    Route::get('/add-client', [ViewController::class, 'addClient'])->name('add-client');
    Route::get('/add-car', [ViewController::class, 'addCar'])->name('add-car');
    Route::get('/parking-congestion', [ViewController::class, 'parkingCongestion'])->name('parking-congestion');
    Route::get('/client-update/{client_id}', [ViewController::class, 'clientUpdateById'])->name('client-update')->whereNumber('client_id');
    Route::get('/car-update/{car_id}',  [ViewController::class, 'carUpdateById'])->name('car-update')->whereNumber('car_id');
    Route::get('/car-update-without_owner/',  [ViewController::class, 'carUpdateWithoutOwner'])->name('car-update-without-owner');
})->middleware(['web', 'verified']);
