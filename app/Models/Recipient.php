<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipient extends Model
{
    use HasFactory;
    static function getAll()
    {

    }

    static function getById()
    {
        //
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

    static function checkExistRecipientById($id): bool
    {
        return DB::table('recipient')->where('id', '=', $id)->exists();
    }
}
