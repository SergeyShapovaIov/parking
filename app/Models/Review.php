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

//        return DB::table('review')
//            ->select( "mark_helpful_review", "product.title AS product", "buyer.last_name as buyer","city")
//            ->join('buyer', 'buyer_id', 'buyer.id')
//            ->join('product', "product_id", 'product.id')
//            ->where('city', '=', 'Самара')
//            ->orWhere('city', "Волгоград")
////            ->groupBy('buyer')
////            ->havingRaw('SUM(mark_helpful_review) > 10')
//            ->get()
//            ;

//        return DB::table('review')
//            ->selectRaw('SUM(mark_helpful_review) AS all_mark_reviews, buyer_id')
//            ->groupBy("buyer_id")
//            ->where('mark_helpful_review', '>', 10)
//            ->pluck('buyer_id');

//        return DB::table('review')
//            ->selectRaw('SUM(mark_helpful_review) as all_mark_reviews, buyer_id')
//            ->groupBy('buyer_id')
//            ->get();

//
//        return DB::raw("")


        $sql = "select *
from `review`
         inner join `buyer` on `buyer_id` = `buyer`.`id`
         inner join `product` on `product_id` = `product`.`id`
where (`city` = 'Волгоград' or `city` = 'Самара')
    and (`buyer_id` in (select `buyer_id`
                        from ((select SUM(mark_helpful_review) AS all_mark_reviews, buyer_id
                               from `review`
                               group by `buyer_id`)) AS `table_2`
                        where `all_mark_reviews` > 10))



   or (`buyer_id` in (select `buyer_id`
                      from (SELECT (`buyer_id`), COUNT(*) as `count_review`
                            FROM (SELECT `buyer_id`, review.id
                                  FROM review
                                           INNER JOIN `product` ON `product_id` = `product`.`id`
                                  WHERE price > 3000
                                    and product_id in
                                        (SELECT product_id
                                         FROM (SELECT AVG(`points`) as 'avg_rating'
                                               FROM rating
                                                        INNER JOIN product on rating.product_id = product.id
                                               WHERE price > 3000
                                               group by `buyer_id`) as `table_4`
                                         where 'avg_rating' > 4)) as `table_3`
                            GROUP BY `buyer_id`) as `table_5`
                      where `count_review` > 10));";

    }
}
