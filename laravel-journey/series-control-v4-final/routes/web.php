<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeriesController;
use App\Http\Middleware\Autenticador;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::get('/', fn() => redirect('/series'));
Route::get('/series', [SeriesController::class, 'index'])
    ->name('series.index');

// Rotas protegidas
Route::middleware(Autenticador::class)->group(function () {


    Route::controller(SeriesController::class)->group(function () {

        Route::get('/series/criar', 'create')
            ->name('series.create');

        Route::post('/series/salvar', 'store')
            ->name('series.store');

        Route::get('/series/{serie}/editar', 'edit')
            ->name('series.edit');

        Route::patch('/series/{serie}/atualizar', 'update')
            ->name('series.update');

        Route::delete('/series/{serie}', 'destroy')
            ->name('series.destroy');
    });

    Route::get('/series/{serie}/seasons', [SeasonController::class, 'index'])
        ->name('seasons.index');

    Route::controller(EpisodesController::class)->group(function () {

        Route::get('/seasons/{season}/episodes', 'index')
            ->name('episodes.index');

        Route::post('/seasons/{season}/episodes', 'update')
            ->name('episodes.update');
    });

    // Breeze Profile
    Route::controller(ProfileController::class)->group(function () {

        Route::get('/profile', 'edit')
            ->name('profile.edit');

        Route::patch('/profile', 'update')
            ->name('profile.update');

        Route::delete('/profile', 'destroy')
            ->name('profile.destroy');
    });
});

// Apenas ambiente local
if (app()->environment('local')) {

    Route::get('/email', function () {

        return new SeriesCreated(
            'Série de teste',
            3,
            5,
            10
        );
    });
}

require __DIR__ . '/auth.php';
