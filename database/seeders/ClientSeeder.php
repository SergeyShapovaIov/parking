<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 10; $i++) {
            
            DB::table('client')->insert([
                'name' => Str::random(10),
                'gender' => $gender = rand(0, 1) == 1 ? "Мужчина" : "Женщина",
                'phone_number' => '89' . rand(0, 9) . rand(0,9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9),
                'address' => Str::random(20)
            ]);
            
        }
    }
}
