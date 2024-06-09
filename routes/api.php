<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/auth/login', 'App\Http\Controllers\Api\v1\AuthController@login');
    Route::post('/users', 'App\Http\Controllers\Api\v1\UserController@store');
    
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('/users', 'App\Http\Controllers\Api\v1\UserController')
            ->except(['store']);
            
        Route::apiResource('/sports', 'App\Http\Controllers\Api\v1\SportController');

        Route::get('/fields/search', 'App\Http\Controllers\Api\v1\FieldController@search');
    
        Route::apiResource('/fields', 'App\Http\Controllers\Api\v1\FieldController');

        Route::apiResource('/members', 'App\Http\Controllers\Api\v1\MemberController');

        Route::get('/bookings/info', 'App\Http\Controllers\Api\v1\BookingController@infoOfDay');

        Route::apiResource('/bookings', 'App\Http\Controllers\Api\v1\BookingController');
    });
});
