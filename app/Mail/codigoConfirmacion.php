<?php

namespace App\Mail;

use App\Models\User;
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
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->subject = "Confirmación de correo electrónico";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $codigo = rand(100000, 999999);

        $usuario = User::findOrFail($this->user->id);
        $usuario->codigoConfirmacion = $codigo;
        $usuario->save();


        return $this->view('mail.confirmacion', compact(['codigo', 'usuario']));
    }
}