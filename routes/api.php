<?php

use App\Http\Controllers\ChallengeCheckingController;
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
Route::post('/user', [UserController::class, 'createNewUser']);
Route::delete('/user', [UserController::class, "deleteAllUsers"]);

Route::get('/challenge1', [ChallengeCheckingController::class, 'completedChallenge1']);
Route::get('/challenge2', [ChallengeCheckingController::class, 'completedChallenge2']);
Route::get('/challenge3', [ChallengeCheckingController::class, 'completedChallenge3']);
Route::get('/challenge4', [ChallengeCheckingController::class, 'completedChallenge4']);
Route::get('/challenge5', [ChallengeCheckingController::class, 'completedChallenge5']);

Route::get('/toggleDisableUser/{user}', [UserController::class, 'toggleDisableUser']);
Route::get('/toggleLogUser/{user}', [UserController::class, 'toggleLogUser']);