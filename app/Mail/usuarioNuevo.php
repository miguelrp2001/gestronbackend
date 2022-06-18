<?php

namespace App\Mail;

use App\Models\Centro;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class usuarioNuevo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Centro $centro, User $user, User $admin)
    {
        $this->centro = $centro;
        $this->user = $user;
        $this->admin = $admin;
        $this->subject = "[ALTAS] Se ha registrado nueva alta.";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usuario = $this->user;
        $centro = $this->centro;
        $admin = $this->admin;

        return $this->view('mail.nuevaAlta', compact(['usuario', 'centro', 'admin']));
    }
}