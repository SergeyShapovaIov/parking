<?php

namespace App\Console\Commands;

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
    public function handle()
    {
        
    }
}
