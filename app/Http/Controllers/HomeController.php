<?php

namespace App\Http\Controllers;

use App\Models\{DriverPayout, UserOrders, Users, Vehicles, Wallet};

class HomeController extends Controller
{
	/** Create a new controller instance.
	 *
	 * @return void */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$monthsArr = [
			"Jan" => 0, "Feb" => 0, "Mar" => 0, "Apr" => 0, "May" => 0, "Jun" => 0,
			"Jul" => 0, "Aug" => 0, "Sep" => 0, "Oct" => 0, "Nov" => 0, "Dec" => 0,
		];

		$drivers      = [];
		$driverMonths = $totalVehiclesMonths = $totalOrdersMonths = $userMonths = $monthsArr;
		$driversData  = Users::isActive()
			->ofType('DRIVER')
			->whereNotNull('app_token_id')
			->where('location_lat', '<>', '')
			->where('location_long', '<>', '')
			->get(['id', 'location_lat', 'location_long', 'slug']);

		$AllVehiclesData = Vehicles::isNotDelete()->orderByDesc('id')->get();
		$AllOrderData    = UserOrders::orderByDesc('user_orders.id')
			->leftJoin('users', 'users.id', '=', 'user_orders.user_id')
			->get(['users.first_name', 'users.profile_pic', 'users.mobile', 'user_orders.*']);
		$AllUserData     = Users::isNotDelete()->ofType('USER')->orderByDesc('id')->get();
		$AlldriversData  = Users::isActive()->ofType('DRIVER')->isNotDelete()->orderByDesc('id')->get();

		foreach ($AllOrderData as $order) {
			if (strtotime('-1 years') <  strtotime($order->created_date))
				$totalOrdersMonths[date("M", strtotime($order->created_date))]++;
		}
		foreach ($AllOrderData as $order) {
			if (strtotime('-1 years') <  strtotime($order->created_date))
				$totalOrdersMonths[date("M", strtotime($order->created_date))]++;
		}
		foreach ($AllVehiclesData as $vehicle) {
			if (strtotime('-1 years') <  strtotime($vehicle->created_date))
				$totalVehiclesMonths[date("M", strtotime($vehicle->created_date))]++;
		}
		foreach ($AlldriversData as $driverItem) {
			if (strtotime('-1 years') <  strtotime($driverItem->created_date))
				$driverMonths[date("M", strtotime($driverItem->created_date))]++;
		}
		foreach ($AllUserData as $userItem) {
			if (strtotime('-1 years') <  strtotime($userItem->created_date))
				$userMonths[date("M", strtotime($userItem->created_date))]++;
		}
		foreach ($driversData as $driverItem) {
			array_push($drivers, [
				'lat'   => $driverItem->location_lat,
				'lng'   => $driverItem->location_long,
				'title' => route('drivers.show', $driverItem->slug),
			]);
		}

		$totals = object([
			'online_drivers'      => $drivers,
			'users'               => $AllUserData->count(),
			'orders'              => $AllOrderData->count(),
			'vehicles'            => Vehicles::isNotDelete()->count(),
			'user_canceled_rides' => UserOrders::isStatus(3)->count(),
			'revenue'             => Wallet::ofType('debit')->sum('amount'),
			'pending_payouts'     => DriverPayout::isStatus('PENDING')->count(),
			'recent_orders'       => UserOrders::orderByDesc('id')->limit(3)->get(),
			'drivers'             => Users::ofType('DRIVER')->isNotDelete()->count(),
			'new_orders' => object([
				'labels' => array_keys($totalOrdersMonths),
				'data'   => ['label' => 'Order', 'data' => array_values($totalOrdersMonths)]
			]),
			'new_vehicles' => object([
				'labels' => array_keys($totalVehiclesMonths),
				'data'   => ['label' => 'Vehicle', 'data' => array_values($totalVehiclesMonths)]
			]),
			'new_drivers' => object([
				'labels' => array_keys($driverMonths),
				'data'   => ['label' => 'Driver', 'data' => array_values($driverMonths)]
			]),
			'new_users' => object([
				'labels' => array_keys($userMonths),
				'data'   => ['label' => 'User', 'data' => array_values($userMonths)]
			]),
			'recent_drivers' => Users::ofType('DRIVER')->isNotDelete()->limit(3)->orderByDesc('id')
				->get(['first_name', 'last_name', 'profile_pic', 'email', 'mobile', 'status', 'username', 'id']),
			'recent_transactions' => Wallet::limit(5)
				->orderByDesc('id')
				->leftJoin('users', 'users.id', '=', 'wallet.user_id')
				->get(['wallet.*', 'users.first_name', 'users.profile_pic', 'users.mobile', 'users.username']),
		]);
		return view('dashboard', ['totals' => $totals]);
	}
}
