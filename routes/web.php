<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, NotificationController, OrderController, RatingController, VehicleController, WalletController};

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

Route::get('/', fn () => redirect('/dashboard'));
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/list/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('orders');
Route::get('/list/wallets', [WalletController::class, 'index'])->middleware(['auth'])->name('wallets');
Route::get('/list/ratings', [RatingController::class, 'index'])->middleware(['auth'])->name('ratings');
Route::get('/list/vehicles', [VehicleController::class, 'index'])->middleware(['auth'])->name('vehicles');
Route::get('/send-notification', [NotificationController::class, 'index'])->middleware(['auth'])->name('send-notification');
Route::post('/send-notification', [NotificationController::class, 'send'])->middleware(['auth'])->name('send-notification-post');

require __DIR__ . '/auth.php';
require __DIR__ . '/users.php';
require __DIR__ . '/coupons.php';
require __DIR__ . '/payouts.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/categories.php';
