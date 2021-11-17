<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
	public function index()
	{
		$users   = Users::isNotDelete()->ofType('USER')->whereNotNull('app_token_id')
			->where('first_name', '!=', '')->whereNotNull('first_name')
			->orderBy('first_name')->cursor();
		$drivers = Users::isNotDelete()->ofType('DRIVER')->whereNotNull('app_token_id')
			->where('first_name', '!=', '')->whereNotNull('first_name')
			->orderBy('first_name')->cursor();
		return view('notification', ['users' => $users, 'drivers' => $drivers]);
	}

	public function send(Request $request)
	{
		$request->validate([
			'title'     => 'required|string',
			'message'   => 'required|string',
			'drivers'   => 'required_if:riders,null',
			'riders'    => 'required_if:drivers,null',
			'user_type' => 'required|in:DRIVER,USER',
		]);

		$title   = $request->input('title');
		$message = $request->input('message');
		$token   = $request->input('riders') ?? $request->input('drivers');

		if (sendNotification($token ?? '', ['title' => $title, 'body' => $message]))
			return back()->with('success', 'Notification send successfully');
		return back()->with('error', 'Something went wrong, try some time later');
	}
}
