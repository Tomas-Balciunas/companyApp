<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppNotif extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function build()
    {
        return $this->from('distifyapp@distify.com')->subject('Company App')->markdown('mail.mail')->with('data', $this->text);
    }
}
