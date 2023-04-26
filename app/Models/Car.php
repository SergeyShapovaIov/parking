<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    static function getAll(): Collection
    {
        return DB::table('car')->get();
    }

    static function getCarWithOwner($number_page): Collection
    {
        return DB::table('car')
            ->leftjoin('client', 'client_id', 'client.id')
            ->select('car.id', 'brand', 'rf_license_number', 'model', 'client.name as owner_name')
            ->skip(($number_page - 1) * 10)
            ->take(10)->get();
    }

    static function getByFilter($params): Collection
    {
        return DB::table('car')
            ->where([
                ['brand', 'like', $params['brand']],
                ['model', 'like', $params['model']],
                ['color_bodywork', 'like', $params['color_bodywork']],
                ['status', 'like', $params['status']],
                ['rf_license_number', 'like', $params['rf_license_number']],
                ['client_id', 'like', $params['client_id']]
            ])->get();
    }

    static function pageCount($row_on_page): int
    {
        $count_page = DB::table('car')->count('id');
        return ceil($count_page / $row_on_page);
    }

    /**
     * @throws \Exception
     */
    static function store($params): int
    {

        $brand = $params['brand'];
        $model = $params['model'];
        $color_bodywork = $params['color_bodywork'];
        $rf_license_number = $params['rf_license_number'];
        $status = $params['status'];
        $client_id = $params['client_id'] ?? NULL;

        if (DB::table('car')->where('rf_license_number', $rf_license_number)->exists()) {
            throw new \Exception("A car with a license plate: " . $rf_license_number . " already exists");

        } else {

            $id = DB::table('car')->insertGetId([
                'brand' => $brand,
                'model' => $model,
                'color_bodywork' => $color_bodywork,
                'rf_license_number' => $rf_license_number,
                'status' => $status,
                'client_id' => $client_id
            ]);

        }

        return $id;
    }

    /**
     * @throws \Exception
     */
    static function deleteById($id): void
    {
        if (DB::table('car')->where('id', $id)->exists()) {

            DB::table('car')->where('id', $id)->delete();

        } else {
            throw new \Exception ("Car with ID = " . $id . " does not exist");
        }
    }

    /**
     * @throws \Exception
     */
    static function deleteByOwnerId($id): Collection
    {
        $idList = DB::table('car')->where('client_id', $id)->pluck('id');

        if (count($idList) != 0) {

            DB::table('car')->where('client_id', $id)->delete();

        } else {
            throw new \Exception ("A customer with an ID = " . $id . " no cars");
        }

        return $idList;
    }

    static function pageCountCarOnParking($row_on_page): int
    {
        $count_page = DB::table('car')->where('status', 1)->count('id');
        return ceil($count_page / $row_on_page);
    }

    static function getPaginatedCarOnParking($number_page): Collection
    {
        return DB::table('car')
            ->leftjoin('client', 'client_id', 'client.id')
            ->select('car.id', 'brand', 'rf_license_number', 'model', 'client.name as owner_name')
            ->where('status', "1")
            ->skip(($number_page - 1) * 10)
            ->take(10)->get();
    }

    static function getByIdClientNotParking($id): Collection
    {
        return DB::table('car')
            ->where('client_id', $id)
            ->where('status', "0")
            ->get();
    }

    static function updateStatusByCarId($id, $action): void
    {
        if ($action == 'add') {

            DB::table('car')
                ->where('id', $id)
                ->update(['status' => "1"]);

        } else {
            DB::table('car')
                ->where('id', $id)
                ->update(['status' => "0"]);
        }

    }

    static function getByIdClient($id): Collection
    {
        return DB::table('car')->where('client_id', $id)->get();
    }

    /**
     * @throws \Exception
     */
    static function updateById($params, $id): void
    {

        $brand = $params['brand'];
        $model = $params['model'];
        $color_bodywork = $params['color_bodywork'];
        $rf_license_number = $params['rf_license_number'];
        $status = isset($params['status']) ? 1 : 0;
        $car_id = $id;
        $client_id = $params['client_id'] ?? NULL;


        if (DB::table('car')->where('id', $car_id)->exists()) {

            if (!DB::table('car')->where('rf_license_number', $rf_license_number)->exists()) {

                DB::table('car')
                    ->where('id', $car_id)
                    ->update([
                        'brand' => $brand,
                        'model' => $model,
                        'color_bodywork' => $color_bodywork,
                        'rf_license_number' => $rf_license_number,
                        'status' => $status,
                        'client_id' => $client_id
                    ]);
            } else {
                throw new \Exception("A car with a license plate: " . $rf_license_number . " already exists");
            }
        } else {
            throw new \Exception("A cra with ID = " . $car_id . " does not exist");
        }

    }

    static function getOwnerByIdCar($car_id)
    {
        return DB::table('car')->where('id', $car_id)->value('client_id');
    }

    static function getWithoutOwner()
    {
        return DB::table('car')->where('client_id', NULL)->get();
    }

    static function updateOwnerByID($client_id, $car_id): void
    {
        DB::table('car')
            ->where('id', $car_id)
            ->update([
                'client_id' => $client_id
            ]);
    }

    static function getById($id): object|null
    {
        return DB::table('car')->where('id', $id)->first();
    }

}

