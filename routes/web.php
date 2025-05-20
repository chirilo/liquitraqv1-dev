<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\LiquijobController;
use App\Http\Controllers\LiquiassetController;
use App\Http\Controllers\AlljobsController;




Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



// Liquijobs
Route::middleware('auth')->group(function () {
    Route::resource('liquijobs', LiquijobController::class);
    Route::get('liquijobs/{id}/edit', 'LiquijobController@edit'); 
    Route::post('liquijobs/{id}/update', 'LiquijobController@update');
});

// Liquijobs
Route::middleware('auth')->group(function () {
    Route::resource('liquiassets', LiquiassetController::class);
    Route::post('/liquiassets/create', 'LiquiassetController@store');
    //Route::get('/liquiassets/allassets', 'LiquiassetController@show');
});


// search
Route::get('/search', [AlljobsController::class, 'index'])->name('search.index');