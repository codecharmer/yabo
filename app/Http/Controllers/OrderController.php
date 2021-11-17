<?php

namespace App\Http\Controllers;

use App\Models\{DriverOrders, UserOrders};

class OrderController extends Controller
{
	public function index()
	{
		$orders = UserOrders::select('users.first_name', 'users.profile_pic', 'users.mobile', 'user_orders.*')
			->leftJoin('users', 'users.id', '=', 'user_orders.user_id')
			->orderByDesc('user_orders.id')
			->get();

		if (is($orders ?? '', 'json')) foreach ($orders as $order) {
			$order->driverOrder = DriverOrders::select('driver_orders.*', 'users.first_name', 'users.profile_pic', 'users.mobile')
				->where('driver_orders.user_order_id', $order->id)
				->where('driver_orders.status', 1)
				->orWhere('driver_orders.status', 2)
				->orWhere('driver_orders.status', 4)
				->orWhere('driver_orders.status', 5)
				->leftJoin('users', 'users.id', '=', 'driver_orders.driver_id')
				->first();
		}

		return view('pages.order.list', ['orders' => $orders]);
	}
}
