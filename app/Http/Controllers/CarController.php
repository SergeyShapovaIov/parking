<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'client_id' => 'nullable',
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'color_bodywork' => 'required|max:255',
            'status' => 'nullable',
            'rf_license_number' => 'required|max:9'
        ]);

        try {
            Car::store(
                $validated['brand'],
                $validated['model'],
                $validated['color_bodywork'],
                $validated['rf_license_number'],
                $status = isset($validated['status']) ? "1" : "0",
                $client = isset($validated['client_id']) ? $validated['client_id'] : NULL,
            );
        } catch (\Exception $exception) {
            return redirect('add-car')->with('message', $exception->getMessage());
        }

        return redirect('');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|min:0',
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'color_bodywork' => 'required|max:255',
            'status' => 'nullable',
            'rf_license_number' => 'required|max:9'
        ]);

        try {
            Car::updateById(
                $validated['brand'],
                $validated['model'],
                $validated['color_bodywork'],
                $validated['rf_license_number'],
                $status = isset($validated['status']) ? "1" : "0",
                $validated['car_id'],
            );
        } catch (\Exception) {

        }

        $owner = Car::getOwnerByIdCar($validated['car_id']);

        if($owner == null) {
            return redirect('/car-update/'.$validated['car_id']);
        }
        return redirect('/client-update/'.Car::getOwnerByIdCar($validated['car_id']));
    }

    public function delete(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'car' => 'required'

        ])->validate();

        Car::deleteById($validated['car']);

        return redirect('car-list');
    }

    public function getByIdClient(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'id' => 'required'

        ])->validate();

        return Car::getByIdClientNotParking($validated['id']);
    }


    public function downStatusByCarId(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|min:0|numeric'
        ]);
        Car::updateStatusByCarId($validated['car_id'], 'delete');

        return redirect('parking-congestion');

    }


    public function upStatusByCarId(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|min:0|numeric'
        ]);

        Car::updateStatusByCarId($validated['car_id'], 'add');

        return redirect('parking-congestion');
    }

    public function updateOwner(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|min:0|numeric',
            'client_id'=> 'required'
        ]);

        Car::updateOwnerByID($validated['client_id'], $validated['car_id']);

        return redirect('client-update/'.$validated['client_id']);
    }
}
