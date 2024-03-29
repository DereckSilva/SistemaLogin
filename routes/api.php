<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([ 'request', 'authLogin' ])->group(function () {
    Route::post('/login', [UserController::class, 'login']);
});

Route::middleware([ 'auth:sanctum' ])->group(function () {
    Route::get('/users', [UserController::class, 'all']);
    Route::post('/comment', [UserController::class, 'comment']);
});
Route::middleware('request')->group(function () {
    Route::post('/cadUser', [UserController::class, 'create']);
    Route::post('/forgetPassword', [UserController::class, 'forgetPassword']);
});
    Route::post('/newPassword', [UserController::class, 'newPassword']);
    Route::post('/rememberMe', [UserController::class, 'rememberMe']);
