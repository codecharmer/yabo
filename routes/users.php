<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DriverController, UserController};

Route::get('/list/drivers', [DriverController::class, 'drivers'])->middleware(['auth'])->name('drivers');
Route::get('/show/driver/{slug}', [DriverController::class, 'show'])->middleware(['auth'])->name('drivers.show');
Route::get('/delete/driver/{slug}', [DriverController::class, 'delete'])->middleware(['auth'])->name('drivers.delete');
Route::post('/show/driver/{slug}', [DriverController::class, 'update'])->middleware(['auth'])->name('drivers.show.post');

Route::get('/list/users', [UserController::class, 'users'])->middleware(['auth'])->name('users');
Route::get('/show/user/{slug}', [UserController::class, 'show'])->middleware(['auth'])->name('users.show');
Route::get('/delete/user/{slug}', [UserController::class, 'delete'])->middleware(['auth'])->name('users.delete');
