<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    // return response()->json(['error' => 'user logedd out or unautorized'], 401);
    return response()->json([
        'code' => '401',
        'message' => 'No autenticado. Por favor, inicia sesión.',
        'errors' => [
            'auth' => [
                'El token de autenticación no es válido o no fue proporcionado.'
            ]
        ]
    ], 401);
})->name('login');
