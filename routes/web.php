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
    return view('index');
});

Route::get('/index.html', [ViewController::class, 'showIndex']);
Route::get('/register.html', [ViewController::class, 'showRegister']);

Route::get('/landing.html', [ViewController::class, 'showLanding']);
Route::get('/challenge1.html', [ViewController::class, 'showChallenge1']);
Route::get('/challenge2.html', [ViewController::class, 'showChallenge2']);
Route::get('/challenge3.html', [ViewController::class, 'showChallenge3']);
Route::get('/challenge4.html', [ViewController::class, 'showChallenge4']);
Route::get('/challenge5.html', [ViewController::class, 'showChallenge5']);

Route::get('/hello', [ViewController::class, 'helloworld']);

Route::get('/getUser', [UserController::class, 'getUser']);
Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
Route::post('/createNewUser', [UserController::class, 'createNewUser']);