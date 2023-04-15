<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index() {
        return redirect('/car-list');
    }

    public function carList() {
        return view('car-list');
    }

    public function clientList() {
        return view('client-list');
    }

    public function addClient() {
        return view('add-client');
    }

    public function addCar() {
        return view('add-car');
    }

    public function parkingCongestion() {
        return view('parking-congestion');
    }

    public function clientUodateById() {
        return view('client-update');
    }

    public function carUpdateById() {
        return redirect('client-update');
    }
}
