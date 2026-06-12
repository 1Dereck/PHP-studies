<?php

namespace App\Listeners;

// Importa o Evento e dá um apelido para não dar conflito
use App\Events\SeriesCreated as SeriesCreatedEvent;
// Importa o E-mail e dá um apelido
use App\Mail\SeriesCreated as SeriesCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreatedEvent $event): void
    {
        $userList = User::all();

        foreach($userList as $index => $user){
            // Usando o apelido do E-mail aqui
            $email = new SeriesCreatedMail(
                $event->seriesName,
                $event->seriesId,
                $event->seasonQty,
                $event->episodesPerSeason
            );

            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
        }
    }
}
