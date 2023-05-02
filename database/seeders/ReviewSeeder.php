<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countBuyer = DB::table('buyer')->count('id');
        $countProduct = DB::table('product')->count('id');

        for ($i = 0; $i < 20; $i++) {

            DB::table('review')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'text' => Str::random(100),
                'mark_helpful_review' => rand(0, 100),
                'buyer_id' => rand(1, $countBuyer),
                'product_id' => rand(1, $countProduct),
            ]);

        }
    }
}
