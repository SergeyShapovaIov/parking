<?php

namespace App\Http\Controllers\Api;


use App\Exceptions\InputNotValidException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Mockery\Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;


class CarController extends Controller
{
    public function store(Request $request)
    {
        try {

            $validated = $this->validateInputParams($request);
            $id = Car::store(
                $validated['brand'],
                $validated['model'],
                $validated['color_bodywork'],
                $validated['rf_license_number'],
                $validated['status'],
                $client = isset($validated['client_id']) ? $validated['client_id'] : NULL,
            );

        } catch (InputNotValidException $exception) {

            $errors = json_decode($exception->getMessage());
            return response()->json([
                'message' => "Create error",
                'errors' => $errors], 400);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => "Create error",
                'errors' => $exception->getMessage()], 400);
        }

        return response()->json([
            'message' => "Creation was successful",
            'update_car' => Car::getById($id)], 200);
    }

    public function getAll()
    {
        try {

            $cars = Car::getAll();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()], 400);
        }

        return response($cars->toJson(), 200)->header('Content-Type', 'application/json');
    }

    public function getByFilter(Request $request)
    {
        try {
            $filterParams = $this->validateFilterParams($request);
            $cars = Car::getByFilter($filterParams);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()], 400);
        }

        return response($cars->toJson(), 200)->header('Content-Type', 'application/json');
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
                'status' => "Deletion error",
                'message' => $exception->getMessage()], 400);
        }

        return response()->json([
            'message' => "Car with ID = " . $id . " successfully deleted"], 200);

    }

    public function deleteByOwnerId(Request $request, $id)
    {

        $validated = validator($request->route()->parameters(), [

            'id' => 'required'

        ])->validate();

        try {
            $idList[] = Car::deleteByOwnerId($id);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => "Deletion error",
                'message' => $exception->getMessage()], 400);
        }

        return response()->json([
            'message' => "Cars with ID = " . implode(", ", $idList) . " successfully deleted"], 200);
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
                $client_id = $validated['client_id']
            );
        } catch (InputNotValidException $exception) {

            $errors = json_decode($exception->getMessage());
            return response()->json([
                'message' => "Update error",
                'errors' => $errors], 400);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => "Create error",
                'errors' => $exception->getMessage()], 400);
        }

        return response()->json([
            'message' => "The update was successful",
            'update_car' => Car::getById($id)], 200);

    }

    /**
     * @throws InputNotValidException
     */
    private function validateInputParams(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|numeric',
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'color_bodywork' => 'required|max:255',
            'status' => 'required|max:1|min:0|numeric',
            'rf_license_number' => 'required|max:9'
        ]);

        if ($validator->fails()) {
            throw new InputNotValidException($validator->errors());
        }


        return $validator->valid();
    }

    private function validateFilterParams($params)
    {
        $validated = ['brand', 'model', 'color_bodywork', 'status', 'rf_license_number', 'client_id'];

        $validated['brand'] = $params['brand'] ?? '%';
        $validated['model'] = $params['model'] ?? '%';
        $validated['color_bodywork'] = $params['color_bodywork'] ?? '%';
        $validated['status'] = $params['status'] ?? '%';
        $validated['rf_license_number'] = $params['rf_license_number'] ?? '%';
        $validated['client_id'] = $params['client_id'] ?? '%';

        return $validated;
    }

}
