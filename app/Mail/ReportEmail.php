<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $url ;
    public function __construct($url,$subject)
    {
      $this->url = $url;
        $this->subject =$subject;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $sender= 'notifications@hodi.io';
        $name = 'HODI';
        $subject = 'Report';

        return $this->view('mails.mail_message')
            ->from($sender, $name)
            ->subject($this->subject)
            ->attach($this->url);
    }
}
