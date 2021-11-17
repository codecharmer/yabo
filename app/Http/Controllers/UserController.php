<?php

namespace App\Http\Controllers;

use App\Models\{UserOrders, Users};

class UserController extends Controller
{
	public function users()
	{
		$users = Users::ofType('USER')->isNotDelete()->orderByDesc('id')->get();
		return view('pages.user.list', ['users' => $users]);
	}

	public function show(string $slug = null)
	{
		if (!$slug) return back()->with('error', 'Invalid driver username');
		$user = Users::ofType('USER')->isNotDelete()->where('username', $slug)->first();
		if (!is($user ?? '', 'object')) return back()->with('error', 'User not found');

		$orders = UserOrders::where('user_id', $user->id)->cursor();
		return view('pages.user.show', ['user' => $user, 'orders' => $orders]);
	}

	public function delete(string $slug)
	{
		if (!$slug) return back()->with('error', 'Invalid user username');
		$user = Users::ofType('USER')->where('username', $slug)->first();
		if (!is($user ?? '', 'object')) return back()->with('error', 'User not found');
		if ($user->status === 3) return back()->with('error', 'User is already deleted');
		Users::where('username', $slug)->update(['status' => 3]);
		return back()->with('success', 'User deleted successfully');
	}
}
