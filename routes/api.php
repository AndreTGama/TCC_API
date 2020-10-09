<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['error.handler']], function () {

    Route::get('send-email', 'Api\MailController@sendEmail');
    Route::prefix('login')->group(function () {
        Route::post('/', 'Api\LoginController@loginUser');
    });

    Route::prefix('user')->group(function () {
        Route::post('create-user', 'Api\UserController@createUser');
        Route::post('forgot-password', 'Api\LoginController@forgotPassword');
        Route::post('verify-code', 'Api\LoginController@verifyCode');
        Route::post('change-password', 'Api\LoginController@changePassword');
    });

    Route::group(['middleware' => ['auth.jwt']], function () {
        Route::get('/logout', 'Api\LoginController@logoutUser');
        Route::prefix('user')->group(function () {
            Route::post('update-user', 'Api\UserController@updateUser');
        });

        Route::prefix('dash')->group(function () {
            Route::get('/administrator', 'Api\DashController@dashAdministrator');
        });
    });

// });
