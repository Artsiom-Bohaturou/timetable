<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
    'reset' => false,
    'request' => false,
    'confirm' => false,
]);

Route::middleware('auth:web')->group(function () {
    Route::resource('/users', \App\Http\Controllers\Admin\UserController::class)->names('users');
    Route::match(['PUT', 'PATCH'], '/users/{id}/restore', [App\Http\Controllers\Admin\UserController::class, 'restore'])->name('users.restore');

    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
});
