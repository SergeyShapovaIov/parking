<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstNames = [
            "Александр", "Дмитрий", "Максим", "Сергей", "Андрей",
            "Алексей", "Артём", "Илья", "Кирил", "Михаил", "Никита",
            "Матвей", "Роман", "Егор", "Арсений", "Иван", "Денис",
            "Евгений", "Даниил", "Тимофей"
        ];

        $lastNames = [
            "Иванов", "Смирнов", "Кузнецов", "Попов", "Васильев",
            "Петров", "Соколов", "Михайлов", "Новиков", "Федоров",
            "Морозов", "Волков", "Алексеев", "Лебедев", "Семенов",
            "Егоров", "Павлов", "Козлов", "Степанов", "Николаев"
        ];

        $cities = [
            "Москва", "Санкт-Петербург", "Новосибирск", "Екатеринбург",
            "Казань", "Нижний Новгород", "Челябинск", "Красноярск",
            "Самара", "Волгоград"
        ];

        for ($i = 0; $i < 20; $i++) {
            DB::table('buyer')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'first_name' => $firstNames[rand(0, count($firstNames)-1)],
                'last_name' => $lastNames[rand(0, count($lastNames)-1)],
                'city' => $cities[rand(0, count($cities)-1)]
            ]);
        }
    }
}
