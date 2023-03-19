<?php

use App\Jobs\SendMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function() {
    return view('login', ['titulo' => 'login']);
})->name('login');

Route::get('cadUser', function () {
    return view('cadUser', ['titulo' => 'Cadastro']);
})->name('cadUser');

Route::get('te', function () {
    $users = \App\Models\User::get();

    foreach ($users as $user) {
        SendMail::dispatch($user->name, $user->email)->onQueue('cadUser');
    }
});
