<?php

namespace App\Http\Controllers;

use App\Models\Ratings;

class RatingController extends Controller
{
	public function index()
	{
		$ratings = Ratings::select(
			'ratings.id',
			'ratings.rate',
			'ratings.review',
			'ratings.created_date',
			'rider.mobile as rider_mobile',
			'driver.mobile as driver_mobile',
			'rider.last_name as created_by_l',
			'rider.first_name as created_by_f',
			'driver.last_name as driver_last_name',
			'driver.first_name as driver_first_name'
		)
			->leftJoin('users as rider', 'rider.id', '=', 'ratings.user_id')
			->leftJoin('users as driver', 'driver.id', '=', 'ratings.reviewer_id')
			->orderByDesc('ratings.id')
			->get();

		return view('pages.rating.list', ['ratings' => $ratings]);
	}
}
