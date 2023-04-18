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

        $pageCount = $pageCount == 0 ? 1 : $pageCount;

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

        $pageCount = $pageCount == 0 ? 1 : $pageCount;

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

    public function addClient(Request $request)
    {
        return view('add-client', [
            'cars' => Car::getWithoutOwner()
        ]);
    }

    public function addCar() 
    {
        return view('add-car', [
            'clients' => Client::getAll()]
        );
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
        
        $clients = Client::getAll();

        return view('parking-congestion' , [ 
        'cars' => Car::getPaginatedCarOnParking($page),
        'clients' => $clients,
        'pageCount' => $pageCount,
        'pageNumber' => $page
        ]);
    }

    public function clientUpdateById(Request $request, $client_id)
    {
        $validated = validator($request->route()->parameters(), [

            'client_id' => 'required|min:1'

        ])->validate();

        return view('client-update', [
        'client' => Client::getClientById($validated['client_id']),
        'cars'=> Car::getByIdClient($validated['client_id'])
        ]);
    }

    public function carUpdateById(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'car_id' => 'required|min:1'

        ])->validate();

        $client_id = Car::getOwnerByIdCar($validated['car_id']);

        return redirect('client-update/'.$client_id);
    }
}
