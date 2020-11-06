<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\User\LogoutController;
use App\Http\Controllers\Api\User\RegisterController;
use App\Http\Controllers\Api\Recipes\RecipesController;
use App\Http\Controllers\Api\Recipes\RecipesLikesController;
use App\Http\Controllers\Api\Recipes\RecipesImagesController;

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user/me', [UserController::class, 'index']);
    Route::post('logout', [LogoutController::class, 'destroy']);

    Route::get('recipes', [RecipesController::class, 'index']);
    Route::post('recipes', [RecipesController::class, 'store']);
    Route::get('recipes/{recipe}', [RecipesController::class, 'show']);
    Route::put('recipes/{recipe}', [RecipesController::class, 'update']);
    Route::delete('recipes/{recipe}', [RecipesController::class, 'destroy']);

    Route::put('recipes/{recipe}/like', [RecipesLikesController::class, 'update']);
    Route::delete('recipes/{recipe}/unlike', [RecipesLikesController::class, 'destroy']);

    Route::name('recipe.image.show')->get('recipes/{recipe}/image', [RecipesImagesController::class, 'show']);
});
