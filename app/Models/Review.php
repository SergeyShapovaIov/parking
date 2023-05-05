<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    static function getWithParams()
    {
//        return DB::table('review')
//            ->join('buyer', 'buyer_id', 'buyer.id')
//            ->where('city' ,  'Волгоград')
//            ->orWhere('city', "Самара")
//            ->where('mark_helpful_review', '>', 10)
//            ->get();

        return DB::table('review')
            ->select("mark_helpful_review", "product.title AS product", "buyer.last_name as buyer", "city", "buyer_id")
            ->join('buyer', 'buyer_id', 'buyer.id')
            ->join('product', "product_id", 'product.id')
            ->where(function (Builder $query) {
                $query->where('city', '=', 'Волгоград')
                    ->orWhere('city', '=', 'Самара');
            })
            ->whereIn('buyer_id', function (Builder $query) {
                $query->select('buyer_id')
                    ->from(function (Builder $query) {
                        $query->selectRaw('SUM(mark_helpful_review) AS all_mark_reviews, buyer_id')
                            ->from('review')
                            ->groupBy('buyer_id');
                    })
                    ->where('all_mark_reviews', '>', 10);
            })
            ->orWhereIn('buyer_id', function (Builder $query) {
                
            })
//            ->groupBy('buyer')
//            ->havingRaw('SUM(mark_helpful_review) > 10')
            ->get();

//        return DB::table('review')
//            ->selectRaw('SUM(mark_helpful_review) AS all_mark_reviews, buyer_id')
//            ->groupBy("buyer_id")
//            ->where('mark_helpful_review', '>', 10)
//            ->pluck('buyer_id');

//        return DB::table('review')
//            ->selectRaw('SUM(mark_helpful_review) as all_mark_reviews, buyer_id')
//            ->groupBy('buyer_id')
//            ->get();


    }
}
