<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {

            DB::table('car')->insert([
                'brand' => Str::random(10),
                'model' => Str::random(10),
                'color_bodywork' =>  Str::random(10),
                'rf_license_number' => Str::random(1) . rand(0,9) . rand(0, 9) . rand(0, 9) . Str::random(1) . Str::random(1) . rand(0, 9) . rand(0,9) . rand(0, 9),
                'status' => $status = rand(0, 1) == 1 ? "1" : "0",
                'client_id' => rand(1,10)
                
            ]);
        }
    }
}
