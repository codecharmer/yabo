<?php

namespace App\Http\Controllers;

use App\Models\{DriverOrders, Drivers, Users, Vehicles};
use Illuminate\{Http\Request, Support\Facades\Validator};

class DriverController extends Controller
{
	public function drivers()
	{
		$drivers = Users::where('status', '!=', 3)->ofType('DRIVER')->orderByDesc('id')->get();

		if (is($drivers ?? '', 'json')) foreach ($drivers as $key => $value) {
			$drivers[$key]->total_reject   = DriverOrders::where('status', 3)->where('driver_id', $value->id)->count();
			$drivers[$key]->total_complete = DriverOrders::where('status', 1)->where('driver_id', $value->id)->count();
			$drivers[$key]->payble_amount  = DriverOrders::select('price')
				->where('status', 1)->where('driver_id', $value->id)
				->where('is_paid', '!=', 'paid')->count();
		}

		return view('pages.driver.list', ['drivers' => $drivers]);
	}

	public function show(string $slug)
	{
		if (!$slug) return back()->with('error', 'Invalid driver username');
		$driver = Users::ofType('DRIVER')->where('username', $slug)->first();
		if (!is($driver ?? '', 'object')) return back()->with('error', 'Driver not found');

		if (is($driver, 'object') and is($driver->vehicle_id) and is($driver->driver_id)) {
			$driver->vehicle = Vehicles::where('vehicles.status', 1)
				->where('vehicles.id', $driver->vehicle_id)
				->leftJoin('categories', 'categories.id', '=', 'vehicles.category_id')
				->first(['vehicles.*', 'categories.title']);
			$driver->detail = Drivers::find($driver->driver_id);
		}

		$orders = DriverOrders::where('driver_orders.driver_id', $driver->id)
			->leftJoin('user_orders', 'user_orders.id', '=', 'driver_orders.user_order_id')
			->get(['driver_orders.*', 'user_orders.*', 'driver_orders.id as id']);

		return view('pages.driver.show', ['driver' => $driver, 'orders' => $orders]);
	}

	public function update(Request $request, string $slug)
	{
		if (!$slug) return back()->with('error', 'Invalid driver username');

		$validator = Validator::make($request->all(), [
			'comment' => 'string|nullable', 'status' => 'required|numeric', 'is_active' => 'required|numeric',
		]);

		if ($validator->fails()) return back()->with('error', 'Form is empty.');
		$driver = Users::where('username', $slug)->update([
			'status' => $request->input('status'), 'comment' => $request->input('comment'), 'is_active' => $request->input('is_active')
		]);
		if ($driver) return back()->with('success', 'Driver update successfully');
		return back()->with('error', 'Something went wrong, try again');
	}

	public function delete(string $slug)
	{
		if (!$slug) return back()->with('error', 'Invalid driver username');
		$driver = Users::ofType('DRIVER')->where('username', $slug)->first();
		if (!is($driver ?? '', 'object')) return back()->with('error', 'Driver not found');
		if ($driver->status === 3) return back()->with('error', 'Driver is already deleted');
		Users::where('username', $slug)->update(['status' => 3]);
		return back()->with('success', 'Driver deleted successfully');
	}
}
