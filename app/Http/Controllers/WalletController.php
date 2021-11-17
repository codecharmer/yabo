<?php

namespace App\Http\Controllers;

use App\Models\Wallet;

class WalletController extends Controller
{
	public function index()
	{
		$wallet = Wallet::orderByDesc('wallet.id')
			->leftJoin('users', 'users.id', '=', 'wallet.user_id')
			->select(
				'wallet.amount',
				'users.last_name',
				'users.first_name',
				'users.profile_pic',
				'wallet.coupon_code',
				'wallet.payment_type',
				'wallet.created_date',
				'wallet.transaction_id',
				'wallet.transaction_type'
			)->get();
		return view('pages.wallet.list', ['wallet' => $wallet]);
	}
}
