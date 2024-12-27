<?php

use Illuminate\Support\Facades\Route;
use App\Models\Passenger;
use App\Http\Controllers\PassengerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $passengers = Passenger::all();
    return view('dashboard', compact('passengers'));
})->name('dashboard');

Route::resource('passengers', PassengerController::class);