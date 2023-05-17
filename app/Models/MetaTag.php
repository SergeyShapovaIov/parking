<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MetaTag extends Model
{
    use HasFactory;

    static function getAll()
    {
        return DB::table('meta_tag')->get();
    }

    static function getById($id)
    {
        return DB::table('meta_tag')->where('id', '=', $id)->get();
    }

    static function getByLinkPage($link)
    {
        return DB::table('meta_tag')->where('link', '=', $link)->get();
    }

    static function getByPageId($page_id)
    {
        return DB::table('meta_tag')->where('page_id', '=', $page_id)->get();
    }
    static function store($params)
    {
        return DB::table('meta_tag')->insertGetId([
           'name' => $params['name'],
           'content' => $params['content'],
           'page_id' => $params['page_id']
        ]);
    }

    static function updateById($params, $id)
    {
        DB::table('meta_tag')->where('id', '=', $id)->update([
            'name' => $params['name'],
            'content' => $params['content'],
            'page_id' => $params['page_id']
        ]);
    }

    static function deleteById($id)
    {
        DB::table('meta_tag')->where('id', '=', $id)->delete();
    }
}
