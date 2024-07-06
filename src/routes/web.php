<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

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

Route::get('/', [AttendanceController::class, 'stamp']);
Route::get('/work_start', 'App\Http\Controllers\AttendanceController@work_start')->name('timestamp/work_start');
Route::get('/work_end', 'App\Http\Controllers\AttendanceController@work_end')->name('timestamp/work_end');
Route::get('/break_start', 'App\Http\Controllers\AttendanceController@break_start')->name('timestamp/break_start');
Route::get('/break_end', 'App\Http\Controllers\AttendanceController@break_end')->name('timestamp/break_end');
Route::get('/attendance', [AttendanceController::class, 'date']);