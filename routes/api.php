<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/employees', [EmployeeController::class, 'api_employees']);
Route::get('/employee', [EmployeeController::class, 'getEmployee']);
