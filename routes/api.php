<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

//users
Route::get('/user', [UserController::class, 'getUsers']);
Route::post('/user', [UserController::class, 'createNewUser']);
Route::delete('/user', [UserController::class, "deleteAllUsers"]);

Route::get('/challenge1', [UserController::class, 'completedChallenge1']);
Route::get('/challenge2', [UserController::class, 'completedChallenge2']);
Route::get('/challenge3', [UserController::class, 'completedChallenge3']);
Route::get('/challenge4', [UserController::class, 'completedChallenge4']);
Route::get('/challenge5', [UserController::class, 'completedChallenge5']);

Route::get('/toggleDisableUser/{user}', [UserController::class, 'toggleDisableUser']);

Route::post('/image', [UserController::class, 'uploadImage']);
