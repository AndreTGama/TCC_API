<?php

use Illuminate\Support\Facades\Route;

    // Route::group(['middleware' => ['error.handler']], function () {
    Route::get('send-email', 'Api\MailController@sendEmail');
    Route::prefix('login')->group(function () {
        Route::post('/', 'Api\LoginController@loginUser');
    });

    Route::prefix('user')->group(function () {
        Route::post('/create-user', 'Api\CreateUserController@createUser');
        Route::post('/forgot-password', 'Api\LoginController@forgotPassword');
        Route::post('/verify-code', 'Api\LoginController@verifyCode');
        Route::post('/change-password', 'Api\LoginController@changePassword');
    });

    Route::group(['middleware' => ['auth.jwt']], function () {

        Route::get('/logout', 'Api\LoginController@logoutUser');

        Route::prefix('user')->group(function () {
            Route::post('update-user', 'Api\UpdateUserController@updateUser');
        });

        Route::prefix('dash')->group(function () {
            Route::get('/administrator', 'Api\DashController@dashSupervisor');
        });

        Route::prefix('list')->group(function () {
            Route::get('/supervisor', 'Api\ViewUserController@listSupervisorInSystem');
            Route::get('/administrator', 'Api\ViewUserController@listAdmInSystem');
            Route::get('/client', 'Api\ViewUserController@listClientInSystem');
        });

        Route::prefix('view')->group(function () {
            Route::post('/info-user', 'Api\ViewUserController@viewOnlyUser');
        });

        Route::prefix('hours')->group(function () {
            Route::post('/hours-administrator', 'Api\CreateController@createDaysToWork');
            Route::get('/list/hours-administrator', 'Api\ViewController@viewHoursCompany');
        });

        Route::prefix('services')->group(function () {
            Route::post('/create-services', 'Api\CreateServicesController@createServices');
            Route::post('/update-services', 'Api\UpdateServicesController@updateServices');
        });

        Route::prefix('communicated')->group(function () {
            Route::post('/create-newcomunicated', 'Api\CreateCommunicatedController@createdComunicated');
            Route::get('/view-comunicated', 'Api\ViewCommunicatedController@viewComunicated');
            Route::get('/list-comunicated', 'Api\ViewCommunicatedController@listComunicatedReceived');
            Route::post('/response-comunicated', 'Api\CreateCommunicatedController@responseComunicated');
        });
    });
 //});
