<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::post('create-user', 'Api\UserController@createUser');
});
