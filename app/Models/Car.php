<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    static function getCarWithOwner ($number_page, $sort)
    {

        return DB::table('car')
            ->leftjoin('client', 'client_id', 'client.id')
            ->select('car.id', 'brand','rf_license_number','model', 'client.name as owner_name')
            ->skip(($number_page-1) * 10)
            ->orderBy($sort)
            ->take(10)->get();
    }

    static function pageCount($row_on_page)
    {
        $count_page = DB::table('car')->count('id');
        return ceil($count_page/$row_on_page);
    }

    static function store($brand, $model, $color_bodywork, $rf_license_number, $status, $client_id)
    {
        if(DB::table('car')->where('rf_license_number', $rf_license_number)->exists()) {
            throw new \Exception("Машина с таким номером уже существует");
        } else {
            DB::table('car')->insert([
                'brand' => $brand,
                'model' => $model,
                'color_bodywork' => $color_bodywork,
                'rf_license_number' => $rf_license_number,
                'status' => $status,
                'client_id' => $client_id
            ]);
        }
    }

    static function deleteById($id)
    {
        if(DB::table('car')->where('id', $id)->exists()) {

            DB::table('car')->where('id', $id)->delete();

        } else {
            throw new \Exception;
        }
    }

    static function pageCountCarOnParking($row_on_page)
    {
        $count_page = DB::table('car')->where('status', 1)->count('id');
        return ceil($count_page/$row_on_page);
    }

    static function getPaginatedCarOnParking($number_page)
    {
        return DB::table('car')
        ->leftjoin('client', 'client_id', 'client.id')
        ->select('car.id', 'brand','rf_license_number','model', 'client.name as owner_name')
        ->where('status', "1")
        ->skip(($number_page-1) * 10)
        ->take(10)->get();
    }

    static function getByIdClientNotParking($id)
    {
        return DB::table('car')
            ->where('client_id', $id)
            ->where('status', "0")
            ->get();
    }

    static function updateStatusByCarId($id, $action)
    {
        if($action == 'add') {

            DB::table('car')
            ->where('id', $id)
            ->update(['status' => "1"]);

        } else {
            DB::table('car')
            ->where('id', $id)
            ->update(['status' => "0"]);
        }

    }

    static function getByIdClient($id)
    {
        return DB::table('car')->where('client_id', $id)->get();
    }

    static function updateById($brand, $model, $color_bodywork, $rf_license_number, $status, $car_id)
    {

        DB::table('car')
            ->where('id', $car_id)
            ->update([
                'brand' => $brand,
                'model' => $model,
                'color_bodywork'=> $color_bodywork,
                'rf_license_number' => $rf_license_number,
                'status' => $status
            ]);
    }

    static function getOwnerByIdCar($car_id)
    {
        return DB::table('car')->where('id', $car_id)->value('client_id');
    }

    static function getWithoutOwner()
    {
        return DB::table('car')->where('client_id', NULL)->get();
    }

    static function updateOwnerByID($client_id, $car_id)
    {
        DB::table('car')
            ->where('id', $car_id)
            ->update([
            'client_id' => $client_id
        ]);
    }

    static function getById($id)
    {
        return DB::table('car')->where('id', $id)->first();
    }

}

