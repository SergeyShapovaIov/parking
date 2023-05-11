<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Recipient extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('recipient')->insert([
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'consent_mailing' => rand(0,1),
            ]);
        }
    }
}
