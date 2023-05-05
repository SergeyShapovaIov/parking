<?php

namespace App\Console\Commands;

use App\Mail\CarStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An email is sent to the manager, a hidden copy to the developer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::to('user@example.com')
            ->bcc('developer@example.com')
            ->send(new CarStatus());
    }
}
