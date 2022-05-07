<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [CompanyController::class, 'homeView']);
    Route::post('/addCompany', [CompanyController::class, 'addCompany']);
    Route::get('/edit/{company}', [CompanyController::class, 'editView']);
    Route::patch('/update/{company}', [CompanyController::class, 'update']);
    Route::delete('/delete/{company}', [CompanyController::class, 'delete']);
});

Route::group(['middleware' => ['logcheck']], function () {
    Route::get('/auth', function () {
        return view('blades.auth');
    })->name('auth');
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});

Route::get('/logout', [UserController::class, 'logout']);
