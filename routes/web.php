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

Route::group(['middleware' => ['auth', 'role:Monitor|Administrador']], function() {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/attendance', 'AttendanceController@index')->name('attendance.index');
    Route::get('/attendance/create', 'AttendanceController@create')->name('attendance.create');
    Route::post('/attendance', 'AttendanceController@store')->name('attendance.store');
    Route::get('/attendance/{attendance}/edit', 'AttendanceController@edit')->name('attendance.edit');
    Route::put('/attendance/{attendance}', 'AttendanceController@update')->name('attendance.update');
    Route::delete('/attendance/{attendance}', 'AttendanceController@destroy')->name('attendance.destroy');
});

Route::group(['middleware' => ['auth', 'role:Administrador']], function() {
    Route::get('/report/attendance', 'AttendanceController@report')->name('report.attendance');
    Route::post('/report/attendance/export', 'AttendanceController@export')->name('report.attendance.export');


    Route::get('/company', 'CompanyController@index')->name('company.index');
    Route::get('/company/create', 'CompanyController@create')->name('company.create');
    Route::post('/company', 'CompanyController@store')->name('company.store');
    Route::delete('/company/{company}', 'CompanyController@destroy')->name('company.destroy');
});
