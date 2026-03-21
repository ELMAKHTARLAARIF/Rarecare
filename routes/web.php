<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;


Route::get('/', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('register');
});