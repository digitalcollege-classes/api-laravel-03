<?php

namespace App\Listeners;

use App\Events\AnuncioExcluidoEvent;
use App\Models\User;
use App\Notification\AnuncioRemovidoNotification;
use Illuminate\Support\Facades\Mail;

class AnuncioEventListener
{
    public function handle(AnuncioExcluidoEvent $anuncio): void
    {
        $usuarioDonoDoAnuncio = new User(); //$anuncio->getCreateBy();
        $usuarioDonoDoAnuncio->name = 'Chiquim dono do Anuncio';
        $usuarioDonoDoAnuncio->email = 'chiquim@email.com';

        $email = new AnuncioRemovidoNotification();
        Mail::to($usuarioDonoDoAnuncio)->send($email);
    }
}
