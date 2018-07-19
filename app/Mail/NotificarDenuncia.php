<?php

namespace App\Mail;

use App\Denuncias;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificarDenuncia extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $denuncia;
    public function __construct(Denuncias $denuncia)
    {
        //
        $this->denuncia = $denuncia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notificaciones.nuevadenuncia');
    }
}
