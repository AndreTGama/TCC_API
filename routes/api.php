<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['error.handler']], function () {

    Route::prefix('login')->group(function () {
        Route::post('/', 'Api\LoginController@loginUser');
    });

    Route::prefix('user')->group(function () {
        Route::post('create-user', 'Api\UserController@createUser');
    });

    Route::group(['middleware' => ['auth.jwt']], function () {
        Route::get('/teste', function () {
            return 'teste ';
        });
    });

});
