<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MockTimeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mock-time/{mockTime}/register', [MockTimeController::class, 'registerUser']);
    Route::get('/mock-time', [MockTimeController::class, 'index']);
}); 