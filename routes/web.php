<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [MessageController::class, 'index']);
Route::post('/create', [MessageController::class, 'create']);
Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/create_employee', [EmployeeController::class, 'create']);
Route::post('/store', [EmployeeController::class, 'store']);



