<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Address extends Model
{
    use HasFactory;

    static function getAll() : Collection|null
    {
        return DB::table('address')->get();
    }

    static function getById($id) : array|null
    {
        
        if()
        return DB::table('address')->where('id', '=', $id)->first();
    }

    static function store()
    {
        //
    }

    static function updateById()
    {
        //
    }

    static function deleteById()
    {
        //
    }
}
