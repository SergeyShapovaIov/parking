<?php

namespace App\Console\Commands;

use App\Models\Review;
use Illuminate\Console\Command;

class RunQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run-query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all reviews left by users from Samara or Volgograd,
    whose reviews have been useful for more than 10 users,
    or who have left more than 10 reviews on products worth more than 3k,
    with an average rating of all user reviews on such products of more than 4';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $header = ["text", "mark_helpful_review", "product", "buyer", "city"];

        $reviews = Review::getWithParams();

        $file = fopen('query-result.csv', 'w');

        fputcsv($file, $header, ';');


        foreach ($reviews as $review) {

            fputcsv($file, (array)$review, ';');
        }

        fclose($file);

    }

    private function convertArrayInCSVInputData($array) : array
    {

    }
}
