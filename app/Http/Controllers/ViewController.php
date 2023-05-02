<?php

namespace App\Http\Controllers;

use App\Exceptions\ColumnNoExistsCarSortException;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Car;
use function GuzzleHttp\Promise\all;

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
            'page' => 'nullable|integer|min:1|max:255',
            'sort' => 'nullable|max:20'
        ]);

        $sort = $validated['sort'] ?? 'brand';
        $page = $validated['page'] ?? 1;

        $validSortParams = ['brand', 'model', 'color_bodywork', 'rf_license_number', 'status'];


        $statusSearch = array_search($sort, $validSortParams);
        if(!$statusSearch && $statusSearch !== 0) {
            return redirect()->route('car-list', ['page' => 1, 'sort' => 'brand']);
        }

        if ($page > $pageCount) {
            return redirect()->route('car-list', ['page' => $pageCount]);
        }

        return view('car-list', [
            'cars' => Car::getCarWithOwner($page, $sort),
            'pageCount' => $pageCount,
            'pageNumber' => $page,
            'sort' => $sort
        ]);
    }

    public function clientList(Request $request)
    {
        $pageCount = Client::pageCount(10);

        $pageCount = $pageCount == 0 ? 1 : $pageCount;

        $validated = $request->validate([
            'sort' => 'nullable|max:20',
            'page' => 'nullable|integer|min:1|max:255'
        ]);

        $sort = $validated['sort'] ?? 'name';
        $page = $validated['page'] ?? 1;

        $validSortParams = ['name', 'gender', 'phone_number', 'address'];
        $statusSearch = array_search($sort, $validSortParams);

        if(!$statusSearch && $statusSearch !== 0) {
            return redirect()->route('client-list', ['page' => $pageCount, 'sort' => 'name']);
        }

        if ($page > $pageCount) {
            return redirect()->route('client-list', ['page' => $pageCount]);
        }

        return view('client-list', [
            'clients' => Client::getPaginated($page, $sort),
            'pageCount' => $pageCount,
            'pageNumber' => $page,
            'sort' => $sort
        ]);
    }

    public function addClient(Request $request)
    {
        return view('add-client');
    }

    public function addCar(Request $request)
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

        if ($page > $pageCount) {
            return redirect()->route('parking-congestion', ['page' => $pageCount]);
        }

        $clients = Client::getAll();

        return view('parking-congestion', [
            'cars' => Car::getPaginatedCarOnParking($page),
            'clients' => $clients,
            'pageCount' => $pageCount,
            'pageNumber' => $page
        ]);
    }

    public function clientUpdateById(Request $request, $client_id)
    {
        $validated = validator($request->route()->parameters(), [

            'client_id' => 'required'

        ])->validate();

        if ($validated['client_id'] != 0) {
            $client = Client::getClientById($validated['client_id']);
            $clients = 0;
        } else {
            $clients = Client::getAll();
            $client = 0;
        }


        return view('client-update', [
            'client' => $client,
            'clients' => $clients,
            'cars' => Car::getByIdClient($validated['client_id'])
        ]);
    }

    public function carUpdateById(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'car_id' => 'required|min:1'

        ])->validate();

        $client_id = Car::getOwnerByIdCar($validated['car_id']);

        $client_id = $client_id == null ? 0 : $client_id;

        if ($client_id == 0) {
            return redirect()->route('car-update-without-owner', ['car_id' => $validated['car_id']]);
        }

        return redirect('client-update/' . $client_id);
    }

    public function carUpdateWithoutOwner(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|min:1'
        ]);
//        dd(Car::getById($validated['car_id']));
        return view('car-update', [
            'car' => Car::getById($validated['car_id']),
            'clients' => Client::getAll(),
        ]);
    }
}
