<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddTeamTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $posts;
    public function __construct($posts)
    {
        $this->posts=$posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   $posts=$this->posts;
        return $this->subject("Nova atividade: ".$this->posts->assunto)->view('emails.addteamticket',compact(['posts']));
    }
}
