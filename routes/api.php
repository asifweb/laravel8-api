<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Private Routes
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
    Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('articles.destory')->middleware('api.superAdmin');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index')->middleware('api.admin');
    Route::get('/article/{id}', [ArticleController::class, 'show'])->name('articles.show')->middleware('api.superAdmin');
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    //Public Routes
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
});
