<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class codigoConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subject = "Confirmación de cuenta.";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $codigo = rand(100000, 999999);
        $usuario = Auth::user()->name;
        return $this->view('mail.confirmacion', compact(['codigo', 'usuario']));
    }
}