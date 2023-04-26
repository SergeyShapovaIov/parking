<?php


use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::controller( ViewController::class)-> group( function () {
    Route::get('/',  'index')->name('index');
    Route::get('/car-list',  'carList')->name('car-list');
    Route::get('/client-list', 'clientList')->name('client-list');
    Route::get('/add-client', 'addClient')->name('add-client');
    Route::get('/add-car', 'addCar')->name('add-car');
    Route::get('/parking-congestion', 'parkingCongestion')->name('parking-congestion');
    Route::get('/client-update/{client_id}', 'clientUpdateById')->name('client-update')->whereNumber('client_id');
    Route::get('/car-update/{car_id}',  'carUpdateById')->name('car-update')->whereNumber('car_id');
    Route::get('/car-update-without_owner/',  'carUpdateWithoutOwner')->name('car-update-without-owner');
});

