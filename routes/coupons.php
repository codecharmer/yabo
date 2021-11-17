<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

Route::get('/list/coupons', [CouponController::class, 'index'])
	->middleware(['auth'])
	->name('coupons');

Route::get('/add/coupon', [CouponController::class, 'add'])
	->middleware(['auth'])
	->name('coupon.add');

Route::post('/add/coupon', [CouponController::class, 'create'])
	->middleware(['auth'])
	->name('coupon.add.post');

Route::get('/delete/coupon/{slug}', [CouponController::class, 'delete'])
	->middleware(['auth'])
	->name('coupon.delete');
