<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayoutController;

Route::get('/list/payouts', [PayoutController::class, 'index'])->middleware(['auth'])->name('payouts');
Route::get('/add/driver-payout', [PayoutController::class, 'add'])->middleware(['auth'])->name('payout.add');
Route::get('/edit/driver-payout/{id}', [PayoutController::class, 'edit'])->middleware(['auth'])->name('payout.edit');
Route::post('/add/driver-payout', [PayoutController::class, 'create'])->middleware(['auth'])->name('payout.add.post');
Route::post('/edit/driver-payout/{id}', [PayoutController::class, 'update'])->middleware(['auth'])->name('payout.edit.post');
