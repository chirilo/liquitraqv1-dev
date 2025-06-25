<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\LiquijobController;
use App\Http\Controllers\LiquiassetController;
use App\Http\Controllers\AlljobsController;
use App\Http\Controllers\OcrController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;




Route::get('/', function () {
    $user = Auth::user();
    //dd($user);
    // if( $user === null ){
    //     print_r('hre');
    // }
    if ( $user === null ){
        return Inertia::render('Auth/Login', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
        //return Inertia::render('Liquijobs/Index', []);
    }
    else{
        //dd('here');
        return redirect('/liquijobs');
        //return Inertia::render('Liquijobs/Index');
        // code...
        // return Inertia::render('Auth/Login', [
        //     'canLogin' => Route::has('login'),
        //     'canRegister' => Route::has('register'),
        //     'laravelVersion' => Application::VERSION,
        //     'phpVersion' => PHP_VERSION,
        // ]);
    }
    
});

Route::get('/ocr', function () {
    $user = Auth::user();
    //dd($user);
    // if( $user === null ){
    //     print_r('hre');
    // }
    if ( $user === null ){
        return Inertia::render('Auth/Login', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
        //return Inertia::render('Liquijobs/Index', []);
    }
    else{
        //dd('here');
        return redirect('/liquijobs');
    }
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');
    Route::resource('liquijobs', LiquijobController::class);
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
    Route::post('liquiassets/{id}/update', 'LiquiassetController@update');
});


// search
Route::get('/search', [AlljobsController::class, 'index'])->name('search.index');


// ocr image to text
Route::post('/ocrmake', [OcrController::class, 'make'])->name('ocr.make');
Route::post('/ocrmodel', [OcrController::class, 'model'])->name('ocr.model');
Route::post('/ocrserial', [OcrController::class, 'serial'])->name('ocr.serial');
Route::post('/ocrfull', [OcrController::class, 'full'])->name('ocr.full');