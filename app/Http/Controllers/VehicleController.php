<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;

class VehicleController extends Controller
{
	public function index()
	{
		$vehicles = Vehicles::select('vehicles.*', 'categories.title as category_name', 'categories.extra_field as price')
			->where('vehicles.status', '!=', '3')
			->leftJoin('categories', 'categories.id', '=', 'vehicles.category_id')
			->orderByDesc('vehicles.id')
			->get();

		return view('pages.vehicle.list', ['vehicles' => $vehicles]);
	}
}
