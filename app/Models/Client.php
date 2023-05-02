<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    static function getAll()
    {
        $clients = DB::table('client')->get();

        return $clients;
    }

    static function getPaginated($number_page, $sort)
    {
        return DB::table('client')
            ->skip(($number_page - 1) * 10)
            ->orderBy($sort)
            ->take(10)->get();
    }

    static function store($name, $gender, $phone_number, $address)
    {
        if (DB::table('client')->where('phone_number', $phone_number)->exists()) {
            throw new \Exception("Пользователь с таким номером уже зарегистрирован");
        } else {
            $id = DB::table('client')->insertGetId([
                'name' => $name,
                'gender' => $gender,
                'phone_number' => $phone_number,
                'address' => $address
            ]);
        }

        return $id;
    }

    static function getIdClientByPhoneNumber($phone_number)
    {
        $id = DB::table('client')->where('phone_number', $phone_number)->value('id');

        return $id;
    }

    static function pageCount($row_on_page)
    {
        $count_page = DB::table('client')->count('phone_number');
        return ceil($count_page / $row_on_page);
    }

    static function deleteById($id)
    {
        if (DB::table('client')->where('id', $id)->exists()) {

            DB::table('client')->where('id', $id)->delete();

        } else {
            throw new \Exception;
        }

    }

    static function getClientById($id)
    {
        return DB::table('client')->where('id', $id)->first();
    }

    static function updateById($name, $gender, $phone_number, $address, $client_id)
    {
        DB::table('client')
            ->where('id', $client_id)
            ->update([
                'name' => $name,
                'gender' => $gender,
                'phone_number' => $phone_number,
                'address' => $address,
            ]);
    }
}
