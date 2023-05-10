<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{

    static function getAll()
    {
        return DB::table('page')->get();
    }

    static function getById($id)
    {
        return DB::table('page')->where('id', '=', $id)->first();
    }

    static function store()
    {

    }

    static function deleteById()
    {

    }

    static function updateById($params)
    {
        DB::table('page')
            ->where('id', $params['page_id'])
            ->update([
                'title' => $params['title'],
                'text' => $params['text'],
                'link' => $params['link']
            ]);
    }

}
