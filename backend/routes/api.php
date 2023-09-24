<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Correct namespace and controller method
Route::post('/uploadAttendance', 'App\Http\Controllers\AttendanceController@uploadAttendance');
Route::get('/viewAttendance', 'App\Http\Controllers\AttendanceController@viewAttendance');
Route::get('/Challenge2', 'App\Http\Controllers\AttendanceController@Challenge2');
Route::get('/Challenge4', 'App\Http\Controllers\AttendanceController@Challenge4');

