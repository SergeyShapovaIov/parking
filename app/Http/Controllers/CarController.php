<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function store(Request $request) 
    {

        $validated = $request->validate([
            'client_id' => 'required|min:0',
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
                $status = isset($validated['status']) ? 1 : 0, 
                $validated['client_id'], 
            );
        } catch (Exception) {

        }

        return redirect('/add-car');
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

        return Car::getByIdClient($validated['id']);
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
}
