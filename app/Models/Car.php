<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    static function getCarWithOwner ($number_page) 
    {
        return DB::table('car')
            ->join('client', 'client_id', 'client.id')
            ->select('car.id', 'brand','rf_license_number','model', 'client.name as owner_name')
            ->skip(($number_page-1) * 10)
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
            throw new \Exception;
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
        ->join('client', 'client_id', 'client.id')
        ->select('car.id', 'brand','rf_license_number','model', 'client.name as owner_name')
        ->where('status', 1)
        ->skip(($number_page-1) * 10)
        ->take(10)->get();
    }
}

