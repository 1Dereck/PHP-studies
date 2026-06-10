<?php

use App\Http\Controllers\Api\SeriesApiController;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/series', SeriesApiController::class)->names([
        'index'   => 'api.series.index',
        'store'   => 'api.series.store',
        'show'    => 'api.series.show',
        'update'  => 'api.series.update',
        'destroy' => 'api.series.destroy',
    ]);

    Route::get('/series/{serie}/seasons', function(Series $serie) {
        return $serie->seasons;
    });

    Route::get('/series/{serie}/episodes', function(Series $serie) {
        return $serie->episodes;
    });

    Route::patch('/episodes/{episode}/watched', function(Episode $episode, Request $request) {
        $episode->watched = $request->watched;
        $episode->save();

        return $episode;
    });
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);
    if (Auth::attempt($credentials) === false) {
        return response()->json(
            'Unautheticated',
            401
        );
    }
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token', ['is_admin']);

    return response()->json($token->plainTextToken);
});
