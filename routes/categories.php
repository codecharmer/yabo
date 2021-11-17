<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/list/categories', [CategoryController::class, 'index'])
	->middleware(['auth'])
	->name('categories');

Route::get('/add/category', [CategoryController::class, 'add'])
	->middleware(['auth'])
	->name('category.add');

Route::post('/add/category', [CategoryController::class, 'create'])
	->middleware(['auth'])
	->name('category.add.post');

Route::get('/edit/category/{slug}', [CategoryController::class, 'edit'])
	->middleware(['auth'])
	->name('category.edit');

Route::post('/edit/category/{slug}', [CategoryController::class, 'update'])
	->middleware(['auth'])
	->name('category.edit.post');

Route::get('/delete/category/{slug}', [CategoryController::class, 'delete'])
	->middleware(['auth'])
	->name('category.delete');
