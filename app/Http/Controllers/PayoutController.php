<?php

namespace App\Http\Controllers;

use App\Models\DriverPayout;
use App\Models\Drivers;
use App\Models\Users;
use Illuminate\{Http\Request, Support\Str};


class PayoutController extends Controller
{
	public function index()
	{
		$payouts = DriverPayout::join('users', 'users.id', '=', 'driver_payout.user_id')->orderByDesc('id')
			->get(['users.first_name', 'users.profile_pic', 'users.mobile', 'driver_payout.*']);
		return view('pages.payout.list', ['payouts' => $payouts]);
	}

	public function add()
	{
		$drivers = Users::where('status', '!=', '3')->ofType('DRIVER')->where('amount', '>', 0)->orderByDesc('id')->get();
		return view('pages.payout.add', ['drivers' => $drivers]);
	}

	public function create(Request $request)
	{
		$request->validate([
			"transaction_id"   => "required|string",
			"message"          => "required|string",
			"user_id"          => "required|numeric",
			"amount"           => "required|numeric",
			"transaction_mode" => "required|alpha_num",
			"status"           => "required|in:PENDING,PROCESSING",
		]);

		$user_id          = $request->input('user_id');
		$status           = $request->input('status');
		$amount           = $request->input('amount');
		$message          = $request->input('message');
		$transaction_id   = $request->input('transaction_id');
		$transaction_mode = $request->input('transaction_mode');

		DriverPayout::create([
			'status'           => $status,
			'amount'           => $amount,
			'user_id'          => $user_id,
			'message'          => $message,
			'transaction_id'   => $transaction_id,
			'transaction_mode' => $transaction_mode,
		]);

		return back()->with('success', 'Driver Payout successfully added');
	}

	public function edit($id)
	{
		if (!$id) return back()->with('error', 'Invalid Payout id');
		$payout = DriverPayout::where('driver_payout.id', $id)
			->leftJoin('users', 'users.id', '=', 'driver_payout.user_id')->orderByDesc('id')
			->first(['users.first_name', 'users.driver_id', 'users.profile_pic', 'users.mobile', 'driver_payout.*']);
		if (!is($payout ?? '', 'object')) return back()->with('error', 'Payout not found');

		$driver  = Drivers::find($payout->driver_id);
		$drivers = Users::isNotDelete()->ofType('DRIVER')->where('amount', '>', 0)->get();

		return view('pages.payout.edit', ['payout' => $payout, 'driver' => $driver, 'drivers' => $drivers]);
	}

	public function update($id, Request $request)
	{
		if (!$id) return back()->with('error', 'Invalid Payout id');
		$payout = DriverPayout::find($id);
		if (!is($payout ?? '', 'object')) return back()->with('error', 'Payout not found');
		$request->validate([
			"transaction_id"   => "required|string",
			"message"          => "required|string",
			"transaction_mode" => "required|alpha_num",
			"status"           => "required|in:PENDING,PROCESSING",
		]);

		DriverPayout::find($id)->update([
			'status'           => $request->input('status'),
			'message'          => $request->input('message'),
			'transaction_id'   => $request->input('transaction_id'),
			'transaction_mode' => $request->input('transaction_mode'),
		]);
		return back()->with('success', 'Driver Payout successfully updated');
	}
}
