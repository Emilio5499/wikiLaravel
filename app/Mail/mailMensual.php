<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class mailMensual extends Mailable
{
    public $evento;

    public function __construct($evento)
    {
        $this->evento = $evento;
    }

    public function build()
    {
        return $this->subject(' ¡Empieza el evento!')
            ->view('emails.evento_mensual')
            ->with(['evento' => $this->evento]);
    }
}

