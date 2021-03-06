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
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'role:Monitor|Administrador']], function() {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/attendance', 'AttendanceController@index')->name('attendance.index');
    Route::get('/attendance/create', 'AttendanceController@create')->name('attendance.create');
    Route::post('/attendance', 'AttendanceController@store')->name('attendance.store');
    Route::get('/attendance/{attendance}/edit', 'AttendanceController@edit')->name('attendance.edit');
    Route::put('/attendance/{attendance}', 'AttendanceController@update')->name('attendance.update');
});

Route::group(['middleware' => ['auth', 'role:Administrador']], function() {
    Route::delete('/attendance/{attendance}', 'AttendanceController@destroy')->name('attendance.destroy');

    Route::get('/report/attendance', 'AttendanceController@report')->name('report.attendance');
    Route::post('/report/attendance/export', 'AttendanceController@export')->name('report.attendance.export');

    Route::get('/company', 'CompanyController@index')->name('company.index');
    Route::get('/company/create', 'CompanyController@create')->name('company.create');
    Route::post('/company', 'CompanyController@store')->name('company.store');
    Route::get('/company/{company}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('/company/{company}', 'CompanyController@update')->name('company.update');
    Route::delete('/company/{company}', 'CompanyController@destroy')->name('company.destroy');

    Route::get('/audit', 'AuditController@index')->name('audit.index');

    Route::get('/user', 'UserController@index')->name('user.index');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user', 'UserController@store')->name('user.store');
    Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::put('/user/{user}', 'UserController@update')->name('user.update');
    Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');
});
