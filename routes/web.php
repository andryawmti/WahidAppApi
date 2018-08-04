<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'Auth\AdminLoginController@showLoginForm');

Route::get('/test', function(){
    return view('test');
});

Route::prefix('user')->group(function (){
    Route::post('/signup', 'UserAndroidController@signUp');
    Route::post('/reset-password', 'UserAndroidController@resetPassword');
    Route::get('/login', 'Auth\UserLoginController@showLoginForm')->name('user.login');
    Route::post('/login', 'Auth\UserLoginController@userLogin')->name('user.login.submit');
    Route::post('/logout', 'Auth\UserLoginController@userLogout')->name('user.logout');
});

/*Route::prefix('dashboard')->group(function(){*/
/*    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('logout');*/
    Route::resource('user', 'UserController');
    Route::put('/user/{user}/password', 'UserController@updatePassword')->name('user.update_password');
    Route::resource('admin', 'AdminController');
    Route::put('/admin/{admin}/password', 'AdminController@updatePassword')->name('admin.update_password');
    Route::get('/profile-settings', 'DashboardController@profileSettings')->name('profile');
    Route::put('/profile-settings/{id}', 'DashboardController@updateProfile')->name('profile.edit');
    Route::put('/profile-settings/{id}/password', 'DashboardController@updatePassword')->name('profile.change_password');
    Route::resource('menu', 'MenuController');
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('consultation', 'ConsultationController');

/*});*/
