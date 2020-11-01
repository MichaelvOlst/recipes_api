<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\User\LogoutController;
use App\Http\Controllers\Api\User\RegisterController;

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [UserController::class, 'index']);
    Route::post('logout', [LogoutController::class, 'destroy']);
});

