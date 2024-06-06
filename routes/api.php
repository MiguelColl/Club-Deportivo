<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::middleware('auth:api')
        ->apiResource('/users', 'App\Http\Controllers\Api\v1\UserController');
        
    Route::post('/auth/login', 'App\Http\Controllers\Api\v1\AuthController@login');
});
