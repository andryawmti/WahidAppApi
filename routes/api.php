<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>'auth:user-api'], function(){
    Route::get('/user/{id}', 'UserControllerApi@getUser');
    Route::post('/user/{id}', 'UserControllerApi@updateUser');
    Route::post('/user/{id}/password', 'UserControllerApi@updatePassword');
    Route::post('/user/{id}/upload-photo', 'UserControllerApi@uploadPhoto');
    Route::get('/user/{id}/get-photo-profile', 'UserControllerApi@getPhotoProfileUrl');
    Route::get('/menus', 'MenuAndroidController@index');
    Route::get('/menu/{id}', 'MenuAndroidController@getMenu');
    Route::post('/consultation', 'ConsultationControllerApi@store');
    Route::get('/consultation/{id}', 'ConsultationControllerApi@getConsultation');
    Route::get('/consultations/{userId}', 'ConsultationControllerApi@getUserConsultations');
    Route::get('/tips', 'TipsControllerApi@getTips');
});

Route::group(['middleware'=>'auth:admin-api'], function(){
    Route::get('/users', 'UserController@getUsers');
});

