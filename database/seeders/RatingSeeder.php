<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countBuyer = DB::table('buyer')->count('id');
        $countProduct = DB::table('product')->count('id');
        $countReview = DB::table('review')->count('id');


        for ($i = 0; $i < 20; $i++) {

            $reviewIdColumnValues = [ null, rand(1, $countReview)];

            DB::table('rating')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'buyer_id' => rand(1, $countBuyer),
                'product_id' => rand(1, $countProduct),
                'points' => rand(1, 500)/100,
                'review_id' => $reviewIdColumnValues[rand(0,1)]
            ]);
        }
    }
}
