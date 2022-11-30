<?php

use App\Http\Controllers\ChallengeCheckingController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserDemoController;
use Illuminate\Support\Facades\Auth;
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

//Route::get('/login', [LoginController::class, 'authenticate']);
Route::get('/', [UserController::class, 'allUsersCheckingIndex'])->name('/');

Route::get('/register', [UserController::class, 'allUsersCheckingRegister'])->name('register');

Route::get('/landing', [UserController::class, 'getUserCheckingLanding']);
Route::post('/landing', [ImageController::class, 'uploadImage']);

Route::get('/profile', [UserController::class, 'getUserCheckingProfile']);

Route::get('/admin', [UserController::class, 'GetUserCheckingAdmin']);

Route::get('/challenge1', [ViewController::class, 'getUserChallenge1']);
Route::get('/challenge2', [ViewController::class, 'getUserChallenge2']);
Route::get('/challenge3', [ViewController::class, 'getUserChallenge3']);
Route::get('/challenge4', [ViewController::class, 'getUserChallenge4']);
Route::get('/challenge5', [ViewController::class, 'getUserChallenge5']);
Route::get('/hintChallenge5', [ViewController::class, 'hintChallenge5']);
Route::get('/CompleteChallenge5InTheBrowserOfTheMatrixByTakingTheRedPill', [ChallengeCheckingController::class, 'completedChallenge5']);
Route::get('/rc', [UserController::class, 'resetChallengesUser']);


Route::get('/hello', [ViewController::class, 'helloworld']);
/*
Route::get('/test/test.php', [ViewController::class, 'showTest']);
Route::get('/test/test2.php', [ViewController::class, 'showTest2']);
Route::get('/test/test3.php', [ViewController::class, 'showTest3']);
Route::get('/test/test4.php', [ViewController::class,'showTest4']);*/
//Route::get('/test/config.php', [ViewController::class,'showTestConfig']);


//Meneer Casier
/*
Route::get('/users', [UserDemoController::class, 'all']);
Route::get('/users/{id}', [UserDemoController::class, 'get']);
Route::get('/password', [UserDemoController::class, 'encrypt']);
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
