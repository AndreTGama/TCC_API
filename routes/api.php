<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['error.handler']], function () {

    Route::prefix('login')->group(function () {
        Route::post('/', 'Api\LoginController@loginUser');
    });

    Route::prefix('user')->group(function () {
        Route::post('create-user', 'Api\UserController@createUser');
        Route::post('forgot-password', 'Api\LoginController@forgotPassword');
    });

    Route::group(['middleware' => ['auth.jwt']], function () {
        Route::prefix('user')->group(function () {
            Route::post('update-user', 'Api\UserController@updateUser');
        });
    });

// });
