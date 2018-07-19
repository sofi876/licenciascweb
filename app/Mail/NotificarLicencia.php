<?php

namespace App\Mail;

use App\LicenciaConstruccion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificarLicencia extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $licencia;
    public function __construct(LicenciaConstruccion $licencia)
    {
        //
        $this->licencia = $licencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notificaciones.nuevalicencia');
    }
}
