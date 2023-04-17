<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Car;

class ViewController extends Controller
{
    public function index() 
    {
        return redirect('/car-list');
    }

    public function carList(Request $request)
    {
        $pageCount = Car::pageCount(10);

        $validated = $request->validate([
            'page' => 'nullable|integer|min:1|max:255'
        ]);

        $page = $validated['page'] ?? 1;

        if($page > $pageCount) {
            return redirect()->route('car-list',  ['page' => $pageCount]);
        } 

        return view('car-list' ,[
            'cars' => Car::getCarWithOwner($page),
            'pageCount' => $pageCount,
            'pageNumber' => $page
        ]);
    }

    public function clientList(Request $request)
    {
        $pageCount = Client::pageCount(10);

        $validated = $request->validate([
            'page' => 'nullable|integer|min:1|max:255'
        ]);
        
        $page = $validated['page'] ?? 1;

        if($page > $pageCount) {
            return redirect()->route('client-list',  ['page' => $pageCount]);
        } 

        return view('client-list', [
            'clients' => Client::getPaginated($page),
            'pageCount' => $pageCount,
            'pageNumber' => $page
        ]); 
    }

    public function addClient() 
    {
        return view('add-client');
    }

    public function addCar() 
    {
        return view('add-car', ['clients' => Client::getAll()]);
    }

    public function parkingCongestion(Request $request) 
    {
        $pageCount = Car::pageCountCarOnParking(10);

        $pageCount = $pageCount == 0 ? 1 : $pageCount;

        $validated = $request->validate([
            'page' => 'nullable|integer|min:1|max:255'
        ]);
        
        $page = $validated['page'] ?? 1;

        if($page > $pageCount) {
            return redirect()->route('parking-congestion',  ['page' => $pageCount]);
        } 
        
        return view('parking-congestion' , [ 
        'cars' => Car::getPaginatedCarOnParking($page),
        'clients' => Client::getAll(),
        'pageCount' => $pageCount,
        'pageNumber' => $page
        ]);
    }

    public function clientUodateById() 
    {
        return view('client-update');
    }

    public function carUpdateById() 
    {
        return redirect('client-update');
    }
}
