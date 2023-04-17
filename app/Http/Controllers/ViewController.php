<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ViewController extends Controller
{
    public function index() 
    {
        return redirect('/car-list');
    }

    public function carList()
    {

        return view('car-list');
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

    public function parkingCongestion() 
    {
        return view('parking-congestion');
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
