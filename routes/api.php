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

    Route::prefix('selects')->group(function (){
        Route::get('/type-services', 'Api\TablesController@listTypeServices');
        Route::get('/days-weeks', 'Api\TablesController@listDaysWeeks');
        Route::get('/list-company', 'Api\TablesController@listCompanys');
        Route::get('/list-clients', 'Api\TablesController@listClients');
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
            Route::post('/hours-administrator', 'Api\CreateDaysUserController@createDaysToWork');
            Route::get('/list/hours-administrator', 'Api\ViewDaysHasUsersController@viewHoursCompany');
        });

        Route::prefix('services')->group(function () {
            Route::post('/company/list-services', 'Api\ViewServicesController@listServicesCompany');
            Route::post('/company/delete-service', 'Api\UpdateServicesController@deleteServices');
            Route::post('/client/list-services', 'Api\ViewServicesController@listServicesClient');
            Route::get('/view-services', 'Api\ViewServicesController@viewServiceById');
            Route::post('/create-services', 'Api\CreateServicesController@createServices');
            Route::post('/update-services', 'Api\UpdateServicesController@updateServices');
        });

        Route::prefix('communicated')->group(function () {
            Route::post('/create-newcomunicated', 'Api\CreateCommunicatedController@createdComunicated');
            Route::get('/view-comunicated', 'Api\ViewCommunicatedController@viewComunicated');
            Route::get('/list-comunicated', 'Api\ViewCommunicatedController@listComunicatedReceived');
        });

        Route::prefix('calendar')->group(function () {
            Route::post('/create', 'Api\CreateCalendarController@createCalendar');
            Route::get('/company/list-calendar', 'Api\ViewCalendarController@listCalendarCompany');
            Route::get('/client/list-calendar', 'Api\ViewCalendarController@listCalendarClient');

        });
    });
 //});
