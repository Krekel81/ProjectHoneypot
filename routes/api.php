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

Route::post('/image', [UserController::class, 'uploadImage']);
