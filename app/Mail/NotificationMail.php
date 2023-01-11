<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    Public $subject;
    public $Body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$Body)
    {
        //
        $this->Body = $Body;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(\env('Emailfrom'), \env('EmailName'))->subject($this->subject)->view('Mail.communication')->with(['body'=>$this->Body]);
    }
}
