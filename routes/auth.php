<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
	->middleware('guest')
	->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
	->middleware('guest');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
	->middleware('auth')
	->name('logout');
