<?php

namespace App\Observers;

use App\Events\AnuncioExcluidoEvent;
use App\Models\Anuncio;

class AnuncioObserver
{
    // approach 2 - sem precisar disparar manualmente
    public function deleted(Anuncio $anuncio): void
    {
        event(new AnuncioExcluidoEvent($anuncio));
    }
}
