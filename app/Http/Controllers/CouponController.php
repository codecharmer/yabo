<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use Illuminate\{Http\Request, Support\Str};

class CouponController extends Controller
{
	public function index()
	{
		return view('pages.coupon.list', ['coupons' => Coupons::all()]);
	}


	public function add()
	{
		return view('pages.coupon.add');
	}

	public function create(Request $request)
	{
		$request->validate([
			"start_from"       => "required|date",
			"end_to"           => "required|date",
			"is_active"        => "required|in:1,0",
			"description"      => "required|string",
			"percentage"       => "required|numeric",
			"max_amount"       => "required|numeric",
			"min_order_amount" => "required|numeric",
			"use_count"        => "required|numeric",
			"code"             => "required|alpha_num",
			"type"             => "required|in:flat,percentage",
		]);

		$coupon = Coupons::create([
			'code'             => strtoupper($request->input('code')),
			'type'             => $request->input('type'),
			'use_count'        => $request->input('use_count'),
			'max_amount'       => $request->input('max_amount'),
			'percentage'       => $request->input('percentage'),
			'start_from'       => $request->input('start_from'),
			'end_to'           => $request->input('end_to'),
			'min_order_amount' => $request->input('min_order_amount'),
			'is_active'        => (bool) $request->input('is_active'),
			'description'      => $request->input('description'),
		]);

		if (!$coupon) return back()->with('error', 'Something went wrong');
		return redirect('list/coupons')->with('success', $request->input('title') . ' successfully added');
	}


	public function delete($slug)
	{
		$coupon = Coupons::where('id', $slug)->first();
		if (!is($coupon ?? '', 'object')) return back()->with('error', 'Coupon not found');

		Coupons::where('id', $slug)->update(['is_active' => '0']);
		return redirect('/list/coupons')->with('success', 'Coupon deleted successfully');
	}
}
