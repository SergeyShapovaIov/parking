<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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


    }

    public function getAll()
    {
        $cars = Car::getAll();
        return response($cars->toJson(), 200)->header('Content-Type', 'application/json');


    }

    public function getByFilter(Request $request)
    {
        $request->all();
        // доделать
    }

    public function deleteById(Request $request, $id)
    {
        $validated = validator($request->route()->parameters(), [

            'id' => 'required'

        ])->validate();

        try {

            Car::deleteById($id);

        } catch (\Exception $exception) {
            return response()->json([
                'mesage' => $exception->getMessage()], 400);
        }

        return response()->json([
            'message' => "Автомобиль с ID = " . $id . " успешно удален"], 200);
        $id;

    }

    public function deleteByOwnerId()
    {

    }

    public function update(Request $request, $id)
    {
        
        try {

            $validated = $this->validateInputParams($request);

            Car::updateById(
                $validated['brand'],
                $validated['model'],
                $validated['color_bodywork'],
                $validated['rf_license_number'],
                $status = isset($validated['status']) ? "1" : "0",
                $id,
                $client_id =$validated['client_id']
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()], 400);
        }

        return response()->json([
            'message' => "Обновление прошло успешно",
            'update_car' => Car::getById($id)], 200);

    }

    private function validateInputParams(Request $request)
    {
        try {

            $validated = $request->validate([
                'client_id' => 'required',
                'brand' => 'required|max:255',
                'model' => 'required|max:255',
                'color_bodywork' => 'required|max:255',
                'status' => 'nullable',
                'rf_license_number' => 'required|max:9'
            ]);
        } catch (\Exception $exception) {
            throw new Exception("Некорректные входные данные");
        }
        return $validated;
    }

}