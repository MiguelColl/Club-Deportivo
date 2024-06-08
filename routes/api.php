<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/auth/login', 'App\Http\Controllers\Api\v1\AuthController@login');

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('/users', 'App\Http\Controllers\Api\v1\UserController');
            
        Route::apiResource('/sports', 'App\Http\Controllers\Api\v1\SportController');
    
        Route::apiResource('/fields', 'App\Http\Controllers\Api\v1\FieldController');

        Route::apiResource('/members', 'App\Http\Controllers\Api\v1\MemberController');

        Route::apiResource('/bookings', 'App\Http\Controllers\Api\v1\BookingController');
    });
});
