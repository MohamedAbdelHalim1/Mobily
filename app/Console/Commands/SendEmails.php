<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hmDevice:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to send email via command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = array('name'=>"Wezza");
        Mail::send('email.mail', $data, function($message) {
           $message->to('mariamsalaheldin16@gmail.com')->subject
              ('test job');
           $message->from('mohamedabdelhalim2804@gmail.com');
        });
    }
}
