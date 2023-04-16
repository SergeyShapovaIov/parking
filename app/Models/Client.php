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

    static function store($name, $gender, $phone_number, $address) 
    {
        if(DB::table('client')->where('phone_number', $phone_number)->exists()) {
            throw new \Exception;
        } else {
            DB::table('client')->insert([
                'name' => $name,
                'gender' => $gender,
                'phone_number' => $phone_number,
                'address' => $address
            ]);
        }
    }

    static function getIdClientByPhoneNumber($phone_number) 
    {
        $id = DB::table('client')->where('phone_number', $phone_number)->value('id');

        return $id;
    }

}
