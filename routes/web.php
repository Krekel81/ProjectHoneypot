<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return View::make('index');
});


Route::get('/hello', [ViewController::class, 'helloworld']);

Route::get('/getUser', [UserController::class, 'getUser']);
Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
Route::post('/createNewUser', [UserController::class, 'createNewUser']);