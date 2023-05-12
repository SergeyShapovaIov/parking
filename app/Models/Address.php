<?php

namespace App\Models;

use App\Exceptions\AddressNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Address extends Model
{
    use HasFactory;

    static function getAll() : Collection|null
    {
        return DB::table('address')->get();
    }

    /**
     * @throws AddressNotFoundException
     */
    static function getById($id) : Model|Builder
    {
        $address =  DB::table('address')->where('id', '=', $id)->first();

        if($address == null) {
            throw new AddressNotFoundException(__('exceptions.entity_not_found', [
                'attribute'=> 'id',
                'value' => $id
            ]));
        }
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
