<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;
Route::apiResource('patients', PatientController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::post('/chatgpt', [OpenRouterController::class, 'chat']);
Route::view('/chat','chat');