<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    static function getWithParams()
    {
        return DB::table('review')
            ->select("text", "mark_helpful_review", "product.title AS product", "buyer.last_name as buyer", "city")
            ->join('buyer', 'buyer_id', 'buyer.id')
            ->join('product', "product_id", 'product.id')
            ->where(function (Builder $query) {
                $query->where('city', '=', 'Волгоград')
                    ->orWhere('city', '=', 'Самара');
            })
            ->where(function (Builder $query) {

                // users whose feedback was useful to more than 10 users
                $query->whereIn('buyer_id', function (Builder $query) {
                    $query->select('buyer_id')
                        ->from(function (Builder $query) {
                            $query->selectRaw('SUM(mark_helpful_review) AS all_mark_reviews, buyer_id')
                                ->from('review')
                                ->groupBy('buyer_id');
                        })
                        ->where('all_mark_reviews', '>', 10);
                })

                    ->orWhereIn('buyer_id', function (Builder $query) {

                        // users who have left more than 10 reviews on products worth more than 3 thousand rubles,
                        // with an average rating of all user reviews on such products more than 4
                        $query->select('buyer_id')
                            ->from(function (Builder $query) {
                                $query->selectRaw('buyer_id, COUNT(id) as count_review')
                                    ->from(function (Builder $query) {
                                        $query->selectRaw('buyer_id, review.id')
                                            ->from('review')
                                            ->join('product', 'product_id', 'product.id')
                                            ->where('price', '>', 3000)
                                            ->whereIn('buyer_id', function (Builder $query) {

                                                // users who have an average rating of more than 3,000 products more than 4
                                                $query->select('buyer_id')
                                                    ->from(function (Builder $query) {
                                                        $query->selectRaw('AVG(points) as avg_points, buyer_id')
                                                            ->from('rating')
                                                            ->join('product', 'product_id', 'product.id')
                                                            ->where('price', '>', 3000)
                                                            ->groupBy('buyer_id');
                                                    })
                                                    ->where('avg_points', '>', 4);
                                            });
                                    })
                                    ->groupBy('buyer_id');
                            })
                            ->where('count_review', '>', 1);
                    });
            })
            ->get();
    }
}
