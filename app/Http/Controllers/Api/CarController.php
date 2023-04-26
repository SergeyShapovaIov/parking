<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InputNotValidException;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {

            $validated = $this->validateInputParams($request);

            if(array_key_exists('client_id', $validated)) {
                $this->checkExistUserBuId($validated['client_id']);
            }

            $id = Car::store($validated);

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

    public function getAll(): mixed
    {
        try {

            $cars = Car::getAll();

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()], 400);
        }

        return response($cars->toJson(), 200)->header('Content-Type', 'application/json');
    }

    public function getByFilter(Request $request): mixed
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

    public function deleteById(Request $request, $id): JsonResponse
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

    /**
     * @throws ValidationException
     */
    public function deleteByOwnerId(Request $request, $id): JsonResponse
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

    public function update(Request $request, $id): JsonResponse
    {

        try {

            $validated = $this->validateInputParams($request);

            if(array_key_exists('client_id', $validated)) {
                $this->checkExistUserBuId($validated['client_id']);
            }

            Car::updateById($validated, $id);

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
    private function validateInputParams(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'numeric',
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

    private function validateFilterParams($params): array
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

    /**
     * @throws \Exception
     */
    private function checkExistUserBuId($id): void
    {
        $status = Client::checkExistUserById($id);

        if(!$status) {
            throw new \Exception("Client with ID = " .$id." does not exist");
        }
    }

}
