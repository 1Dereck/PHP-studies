<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::get('/series', [SeriesController::class, 'index'])->name('series.index');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store')->name('login.store');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/register', 'create')->name('users.create'); // <--- Ela está aqui!
    Route::post('/register', 'store')->name('users.store');
});

// Rotas protegidas
Route::middleware(Autenticador::class)->group(function () {
    Route::get('/', fn() => redirect('/series'));

    Route::controller(SeriesController::class)->group(function () {
        Route::get('/series/criar', 'create')->name('series.create');
        Route::post('/series/salvar', 'store')->name('series.store');
        Route::delete('/series/destroy/{serie}', 'destroy')->name('series.destroy');
        Route::get('/series/{serie}/editar', 'edit')->name('series.edit');
        Route::patch('/series/{serie}/atualizar', 'update')->name('series.update');
    });

    Route::get('/series/{series}/seasons', [SeasonController::class, 'index'])->name('seasons.index');

    Route::controller(EpisodesController::class)->group(function () {
        Route::get('/seasons/{season}/episodes', 'index')->name('episodes.index');
        Route::post('/seasons/{season}/episodes', 'update')->name('episodes.update');
    });

    // Rotas do Breeze (perfil)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
