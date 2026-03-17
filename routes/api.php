<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\OpenRouterController;

Route::apiResource('patients', PatientController::class);


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('home', function () {
    return view('home');
});

Route::post('/chatgpt', [OpenRouterController::class, 'chat']);


Route::get('/', function () {
    return response()->json(['message' => 'Hello world!']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});