<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\WelcomeMail;
use Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $posts;
    public function __construct($posts)
    {
        $this->posts=$posts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   


        $email = new WelcomeMail($posts);
        Mail::to($posts['email'])->send($email);
    }
}
