<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model {
    static function getWithParams()
    {
        return DB::table('review')
            ->join('buyer', 'buyer_id', 'buyer.id')
            ->where('city' ,  'Волгоград')
            ->orWhere('city', "Самара")
            ->where('mark_helpful_review', '>', 10)
            ->get();
    }
}
