<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/logout', [UserController::class, 'logout'])->name('logout.api');
    Route::get('/user', [UserController::class, 'userdata'])->name('user.api');
    Route::post('/todo', [TodoController::class, 'index'])->name('add-todo.api');
});

Route::post('/register', [AuthController::class, 'register'])->name('register.api');
Route::post('/login', [AuthController::class, 'login'])->name('login.api');
