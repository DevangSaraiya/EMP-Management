<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Models\Department;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $departmentList = Department::all();
    return view('user', compact("departmentList"));
});

Route::resource('user', UserController::class);
Route::resource('department', DepartmentController::class);
