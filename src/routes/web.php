<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\VerificationController;
use Laravel\Fortify\Features;

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

Route::middleware(['verified'])->group(function(){
    Route::get('/', [AttendanceController::class, 'stamp']);
    Route::get('/user_list', [AttendanceController::class, 'user_list']);
    Route::get('/user_date', [AttendanceController::class, 'user_date']);
    Route::get('/work_start', 'App\Http\Controllers\AttendanceController@work_start')->name('timestamp/work_start');
    Route::get('/work_end', 'App\Http\Controllers\AttendanceController@work_end')->name('timestamp/work_end');
    Route::get('/break_start', 'App\Http\Controllers\AttendanceController@break_start')->name('timestamp/break_start');
    Route::get('/break_end', 'App\Http\Controllers\AttendanceController@break_end')->name('timestamp/break_end');
    Route::get('/attendance', [AttendanceController::class, 'date']);
    Route::get('/work-times', [AttendanceController::class, 'date']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');