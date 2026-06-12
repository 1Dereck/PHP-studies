<?php

namespace App\Providers;

use App\Events\SeriesCreated;
use App\Listeners\EmailUsersAboutSeriesCreated;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Código que já estava no seu projeto:
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            return route('series.index');
        });

        // 💡 ADICIONE ESTA LINHA AQUI:
        // Ela faz exatamente o mesmo papel do array $listen do professor
        Event::listen(
            SeriesCreated::class,
            EmailUsersAboutSeriesCreated::class
        );
    }
}
