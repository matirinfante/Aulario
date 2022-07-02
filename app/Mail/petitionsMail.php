<?php

namespace App\Mail;

use App\Models\Petition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class petitionsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $petition;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($petition)
    {
        $this->petition = $petition;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Nueva petición de materia pendiente');
        return $this->markdown('mail.newPetition');
    }
}
