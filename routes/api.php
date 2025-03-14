<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/update', [AuthController::class, 'update']); // Nueva ruta para actualizar perfil
    Route::apiResource('/userservice', UserServiceController::class);

    // Ruta para consultar el usuario autenticado
    Route::get('/user', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    });
});
