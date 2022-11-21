<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserDemoController;
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

Route::get('/', [ViewController::class, 'showIndex']);
//Route::get('/login', [LoginController::class, 'authenticate']);
Route::get('/', [UserController::class, 'allUsersCheckingIndex']);

Route::get('/register', [ViewController::class, 'showRegister']);
Route::get('/register', [UserController::class, 'allUsersCheckingRegister']);

Route::get('/landing', [ViewController::class, 'showLanding']);
Route::get('/landing', [UserController::class, 'getUserCheckingLanding']);
Route::post('/landing', [ImageController::class, 'uploadImage']);

//Route::get('/admin', [ViewController::class, 'showAdmin']);
Route::get('/admin', [UserController::class, 'GetUserCheckingAdmin']);

Route::get('/challenge1', [ViewController::class, 'showChallenge1']);
Route::get('/challenge2', [ViewController::class, 'showChallenge2']);
Route::get('/challenge3', [ViewController::class, 'showChallenge3']);
Route::get('/challenge4', [ViewController::class, 'showChallenge4']);
Route::get('/challenge5', [ViewController::class, 'showChallenge5']);

Route::get('/hello', [ViewController::class, 'helloworld']);
Route::get('/test/test.php', [ViewController::class, 'showTest']);
Route::get('/test/test2.php', [ViewController::class, 'showTest2']);
Route::get('/test/test3.php', [ViewController::class, 'showTest3']);
Route::get('/test/test4.php', [ViewController::class,'showTest4']);
Route::get('/test/config.php', [ViewController::class,'showTestConfig']);


//Meneer Casier
/*
Route::get('/users', [UserDemoController::class, 'all']);
Route::get('/users/{id}', [UserDemoController::class, 'get']);
Route::get('/password', [UserDemoController::class, 'encrypt']);
*/
