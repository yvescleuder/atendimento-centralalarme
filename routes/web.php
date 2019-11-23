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

Route::get('/', 'DashboardController@index')->name('home');


Route::get('/attendance', 'AttendanceController@index')->name('attendance.index');
Route::get('/attendance/create', 'AttendanceController@create')->name('attendance.create');
Route::post('/attendance', 'AttendanceController@store')->name('attendance.store');
// faltando a linha para exibir 1 attendance
Route::get('/attendance/{attendance}/edit', 'AttendanceController@edit')->name('attendance.edit');
Route::put('/attendance/{attendance}', 'AttendanceController@update')->name('attendance.update');
