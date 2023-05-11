<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Address extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('address')->insert([
                'region' => Str::random(10),
                'populated_area' => Str::random(10),
                'street' =>  Str::random(10),
                'house_number' =>  rand(1,100).Str::random(2),
                'zip_code' => rand(1,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9),
                'recipient_id' => rand(1,20)
            ]);
        }
    }
}
