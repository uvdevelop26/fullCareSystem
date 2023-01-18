<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InformacionesMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Reporte Sobre Interno";

    public function __construct()
    {
        //
    }

    
    public function envelope()
    {
        return new Envelope(
            subject: 'Informaciones Mailable',
        );
    }

    
    public function content()
    {
      /*   return new Content(
            view: 'Email/SendEmail.vue',
        ); */
    }

   
    public function attachments()
    {
        return [];
    }
}
