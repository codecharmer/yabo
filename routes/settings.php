<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

Route::get('/list/settings', [SettingController::class, 'index'])
	->middleware(['auth'])
	->name('settings');

Route::get('/edit/setting/{id}', [SettingController::class, 'edit'])
	->middleware(['auth'])
	->name('settings.edit');

Route::post('/edit/setting/{id}', [SettingController::class, 'update'])
	->middleware(['auth'])
	->name('settings.edit.post');
