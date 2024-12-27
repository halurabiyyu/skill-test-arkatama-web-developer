<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassengerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('passengers', PassengerController::class);