<?php

use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'reset' => false,
    'request' => false,
    'confirm' => false,
]);

Route::middleware('auth:web')->group(function () {
    Route::resource('/users', \App\Http\Controllers\Admin\UserController::class)->names('users');
    Route::match(['PUT', 'PATCH'], '/users/{id}/restore', [App\Http\Controllers\Admin\UserController::class, 'restore'])->name('users.restore');

    Route::resource('/groups', \App\Http\Controllers\Admin\GroupController::class)->names('groups')->except(['edit', 'create']);
    Route::match(['PUT', 'PATCH'], '/groups/{id}/restore', [App\Http\Controllers\Admin\GroupController::class, 'restore'])->name('groups.restore');

    Route::get('/admins', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admins.index');

    Route::resource('/timetable', \App\Http\Controllers\Admin\TimetableController::class)->names('timetable')->except(['edit', 'create', 'update', 'destroy']);
    Route::match(['PUT', 'PATCH'], '/timetable/update', [\App\Http\Controllers\Admin\TimetableController::class, 'update'])->name('timetable.update');
    Route::delete('/timetable/delete', [\App\Http\Controllers\Admin\TimetableController::class, 'destroy'])->name('timetable.destroy');

    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
});
