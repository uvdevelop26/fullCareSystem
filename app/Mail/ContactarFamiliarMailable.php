<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactarFamiliarMailable extends Mailable
{
    use Queueable, SerializesModels;

   
 

    
    public function __construct(public String $mensaje)
    {
        //
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Fullcare Avisos',
        );
    }

    
    public function content()
    {
        return new Content(
            view: 'email.correo',
        );
    }

   
    public function attachments()
    {
        return [];
    }
}
