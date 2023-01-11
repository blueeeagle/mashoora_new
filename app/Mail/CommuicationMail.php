<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Communication;
use App\Models\CommunicationSend;


class CommuicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $Communication;
    public function __construct(Communication $Communication)
    {
        $this->Communication = $Communication;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            new Address(\env('Emailfrom'), \env('EmailName')),
            $this->subject
        );
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function content()
    {
        return new Content('Mail.communication',['body'=>$this->Communication->body]);
    }

    public function build()
    {
        return $this->from(\env('Emailfrom'), \env('EmailName'))->subject($this->Communication->subject)->view('Mail.communication')->with(['body'=>$this->Communication->body]);
    }
}
