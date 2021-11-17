<?php

namespace App\Http\Controllers;

use Illuminate\{Http\Request, Support\Facades\Validator};
use App\Models\{Categories, Coupons, DriverOrders, DriverPayout, Drivers, Ratings, Settings, UserOrders, Users, Vehicles, Wallet};
use App\View\Components\FormImage;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{

	public function acceptBid(Request $request)
	{
		$validator = Validator::make($request->all(), ['bid_id' => 'numeric|required', 'user_id' => 'numeric|required']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id', '1');
		$bid_id  = $request->input('bid_id', '1');
		$user    = Users::find($user_id);

		if (!is($user ?? '', 'json')) return ['data' => [], 'message' => 'Rider Not Found', 'error' => true];

		$driverOrder = DriverOrders::find($bid_id);

		if (!is($driverOrder ?? '', 'json')) return ['data' => [], 'message' => 'Bid Not Found', 'error' => true];

		$userOrder = UserOrders::where('id', $driverOrder->user_order_id)->where('status', '0')->first();

		if (!is($userOrder ?? '', 'json')) return ['data' => [], 'message' => 'Order Not Found', 'error' => true];

		$transaction_id = Wallet::create([
			'transaction_type' => 'debit',
			'user_id'          => $user_id,
			'created_by'       => $user_id,
			'transaction_id'   => 'AD' . time(),
			'payment_type'     => 'fromBooking',
			'amount'           => $driverOrder->price,
		]);

		if (!is($transaction_id ?? '') || !is($transaction_id->id ?? '')) return [
			'data' => [], 'message' => 'Something went wrong in transactions.', 'error' => true
		];

		$userUpdated = Users::where('id', $user_id)->update(['amount' => $user->amount - $driverOrder->price]);
		$driverUpdated = DriverOrders::where('id', $bid_id)->ofType('outdoor')->update(['status' => '2']);
		$userOrderUpdated = UserOrders::where('id', $user_id)->ofType('outdoor')->update(['status' => '4']);
		$driverOrderUpdatedFirst = DriverOrders::where('driver_orders.status', 0)
			->where('driver_orders.driver_id', $driverOrder->driver_id)
			->leftJoin('user_orders', 'Date(user_orders.booking_date)', '=', "Date('" . $userOrder->booking_date . "')")
			->update(['driver_orders.status' => 3]);

		$driverOrderUpdatedSecond = DriverOrders::where('driver_orders.status', 0)
			->where('driver_orders.user_order_id', $driverOrder->user_order_id)
			->update(['driver_orders.status' => '3']);

		if (!$userUpdated) return [
			'data' => [], 'error' => true, 'message' => 'Something went wrong in users price updatation'
		];

		if (!$driverUpdated) return [
			'data' => [], 'error' => true, 'message' => 'Something went wrong in Driver order status updatation'
		];

		if (!$userOrderUpdated) return [
			'data' => [], 'error' => true, 'message' => 'Something went wrong in Users order status updatation'
		];

		if (!$driverOrderUpdatedFirst) return [
			'data' => [], 'error' => true, 'message' => 'Something went wrong in Driver order first updatation'
		];

		if (!$driverOrderUpdatedSecond) return [
			'data' => [], 'error' => true, 'message' => 'Something went wrong in Driver order second updatation'
		];

		return ['data' => $driverOrder, 'message' => 'Bid Accept successfully', 'error' => null];
	}

	public function addMoney(Request $request)
	{
		$validator = Validator::make($request->all(), ['amount' => 'numeric|required', 'user_id' => 'numeric|required']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$amount  = $request->input('amount', 0);
		$user_id = $request->input('user_id', 1);

		return [
			'error'   => null,
			'message' => "Payment Link is genrated successfully",
			'data'    => ['redirect_url' => url('/') . "payment/initPayment/$user_id/$amount"],
		];
	}

	public function bid(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'price' => 'required|numeric', 'user_order_id' => 'required|numeric', 'driver_id' => 'required|numeric',
		]);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_order_id = $request->input('user_order_id', 1);
		$driver_id     = $request->input('driver_id', 1);
		$price         = $request->input('price', 0);

		$userOrder = UserOrders::where('id', $user_order_id)->where('status', '!=', 3)->first();

		if (!is($userOrder ?? '', 'json')) return ['data' => [], 'message' => 'order not found', 'error' => true];

		$bid = DriverOrders::create([
			'price'         => $price,
			'type'          => 'outdoor',
			'driver_id'     => $driver_id,
			'user_order_id' => $user_order_id,
		]);

		if (!is($bid ?? '')) return ['data' => [], 'error' => true, 'message' => 'Something went wrong'];

		return ['error' => null, 'data' => $bid, 'message' => 'Bid successfully'];
	}

	public function bookOutdoorRide(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'kms'          => 'required',
			'price'        => 'required',
			'drop_lat'     => 'required',
			'drop_text'    => 'required',
			'drop_long'    => 'required',
			'pickup_lat'   => 'required',
			'pickup_text'  => 'required',
			'pickup_long'  => 'required',
			'booking_date' => 'required',
			'user_id'      => 'required|numeric',
		]);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$kms          = $request->input('kms');
		$price        = $request->input('price');
		$user_id      = $request->input('user_id');
		$drop_lat     = $request->input('drop_lat');
		$drop_text    = $request->input('drop_text');
		$drop_long    = $request->input('drop_long');
		$pickup_lat   = $request->input('pickup_lat');
		$pickup_text  = $request->input('pickup_text');
		$pickup_long  = $request->input('pickup_long');
		$booking_date = $request->input('booking_date');

		$user = Users::where('id', $user_id)->isNotDelete()->ofType()->first();

		if (!is($user ?? '', 'json')) return ['data' => [], 'error' => true, 'message' => 'Rider not found',];

		$order = UserOrders::create([
			'kms'          => $kms,
			'price'        => $price,
			'user_id'      => $user_id,
			'created_by'   => $user_id,
			'drop_lat'     => $drop_lat,
			'type'         => "outdoor",
			'drop_text'    => $drop_text,
			'drop_long'    => $drop_long,
			'pickup_lat'   => $pickup_lat,
			'pickup_text'  => $pickup_text,
			'pickup_long'  => $pickup_long,
			'booking_date' => $booking_date,
			'otp'          => random_int(100000, 999999),
		]);

		if (!is($order ?? '') || !is($order->id ?? '')) return ['data' => [], 'message' => 'Ride not booked', 'error' => true];

		return ['error' => null, 'data' => $order, 'message' => 'Book Ride Successfully'];
	}

	public function bookRide(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'kms'         => 'required',
			'price'       => 'required',
			'drop_lat'    => 'required',
			'drop_text'   => 'required',
			'drop_long'   => 'required',
			'pickup_lat'  => 'required',
			'pickup_text' => 'required',
			'pickup_long' => 'required',
			'user_id'     => 'required|numeric',
			'category_id' => 'required|numeric',
		]);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$discountedAmount = null;
		$kms              = $request->input('kms');
		$price            = $request->input('price');
		$comment          = $request->input('comment');
		$user_id          = $request->input('user_id');
		$drop_lat         = $request->input('drop_lat');
		$drop_text        = $request->input('drop_text');
		$drop_long        = $request->input('drop_long');
		$pickup_lat       = $request->input('pickup_lat');
		$pickup_text      = $request->input('pickup_text');
		$pickup_long      = $request->input('pickup_long');
		$category_id      = $request->input('category_id');
		$coupon_code      = $request->input('coupon_code');
		$type             = $request->input('type', 'normal');
		$payment_mode     = $request->input('payment_mode', 'cod');
		$booking_date     = $request->input('booking_date', date('Y-m-d H:i:s'));
		$booking_date     = date('Y-m-d H:i:s', strtotime($booking_date));

		if (is($coupon_code ?? '')) {
			$coupon = Coupons::where('code', $coupon_code)->where('is_active', '!=', 0)->first();

			if (!is($coupon ?? '', 'json')) return [
				'data'    => null,
				'message' => 'Coupon not Exist',
				'error'   => true
			];
			$discountedAmount  = getDiscountedAmount($coupon, $price);
		}

		$user = Users::where('id', $user_id)->isNotDelete()->ofType()->first();

		if (!is($user ?? '', 'json')) return [
			'data' => [], 'error' => true, 'message' => 'Your details not found for booking ride.',
		];

		$driver = Users::isActive()->ofType('DRIVER')->whereNotNull('app_token_id')->where('category_id', $category_id)->first();

		if (!is($driver ?? '')) return [
			'data' => [], 'error' => true, 'message' => 'Sorry, Current all drivers are booked, Please try some time later.',
		];

		$transaction = Wallet::create([
			'amount'           => $price,
			'transaction_type' => 'debit',
			'user_id'          => $user_id,
			'created_by'       => $user_id,
			'coupon_code'      => $coupon_code,
			'transaction_id'   => 'AD' . time(),
			'payment_type'     => 'fromBooking',
		]);

		if (!is($transaction ?? '') || !is($transaction->id ?? '')) return [
			'data' => [], 'error' => true, 'message' => 'Something went wrong in transactions.',
		];

		if (strtolower($payment_mode) !== 'cod') {
			$updatePrice = is($coupon_code ?? '') ? $price : $discountedAmount;
			Users::find($user_id)->update(['amount' => $user->amount - $updatePrice]);
		}

		$order = UserOrders::create([
			'kms'          => $kms,
			'type'         => $type,
			'price'        => $price,
			'created_by'   => $user_id,
			'user_id'      => $user_id,
			'comment'      => $comment,
			'drop_lat'     => $drop_lat,
			'drop_text'    => $drop_text,
			'drop_long'    => $drop_long,
			'pickup_lat'   => $pickup_lat,
			'pickup_text'  => $pickup_text,
			'pickup_long'  => $pickup_long,
			'coupon_code'  => $coupon_code,
			'payment_mode' => $payment_mode,
			'booking_date' => $booking_date,
			'otp'          => random_int(100000, 999999),
		]);

		if (!is($order ?? '') || !is($order->id ?? '')) return ['data' => [], 'message' => 'Ride not booked', 'error' => true];

		$driverOrder_id = DriverOrders::create([
			'type'          => $type,
			'user_order_id' => $order,
			'created_by'    => $user_id,
			'driver_id'     => $driver->id,
			'price'         => is($coupon_code ?? '') ?  $price : $discountedAmount,
		]);

		if (!is($driverOrder_id ?? '')) return ['data' => [], 'error' => true, 'message' => 'Something went wrong'];

		$notification = $this->sendNotification($driver->app_token_id, [
			'kms'              => $kms,
			'type'             => $type,
			'userOrder_id'     => $order,
			'comment'          => $comment,
			'user_id'          => $user_id,
			'drop_lat'         => $drop_lat,
			'drop_text'        => $drop_text,
			'drop_long'        => $drop_long,
			'pickup_lat'       => $pickup_lat,
			'pickup_text'      => $pickup_text,
			'pickup_long'      => $pickup_long,
			'category_id'      => $category_id,
			'user_mobile'      => $user->mobile,
			'booking_date'     => $booking_date,
			'driverOrder_id'   => $driverOrder_id,
			'user_first_name'  => $user->first_name,
			'user_profile_pic' => $user->profile_pic,
			'title'            => 'You have new request',
			'body'             => ucfirst($user->first_name) . " has booked a new ride, Don't keep them waiting.",
		]);

		if (!$notification) return ['data' => [], 'message' => 'Notification not send to driver', 'error' => true];

		$order->driver_profile_pic = $driver->profile_pic;
		$order->driver_first_name  = $driver->first_name;
		$order->driver_mobile      = $driver->mobile;
		$order->driver_id          = $driver->id;

		return ['error' => null, 'data' => $order, 'message' => 'Book Ride Successfully'];
	}

	public function cancelRide(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'user_id'  => 'required|numeric',
			'order_id' => 'required|numeric',
		]);

		if ($validator->fails()) return [
			'data'    => [],
			'error'   => true,
			'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id  = $request->input('user_id');
		$order_id = $request->input('order_id');

		$order = UserOrders::where('id', $order_id)->where('user_id', $user_id)->where('status', 0)->first();

		if (!is($order ?? '', 'json')) return [
			'data' => [], 'message' => 'Order not Found', 'error' => true
		];

		UserOrders::find($order_id)->update(['status' => '3']);

		return [
			'data'    => [],
			'message' => 'Ride Cancel Successfully',
			'error'   => null
		];
	}

	public function checkBookingStatus(Request $request)
	{
		$validator = Validator::make($request->all(), ['userOrder_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data'    => [],
			'error'   => true,
			'message' => json_encode($validator->errors()->getMessages())
		];

		$userOrder_id  = $request->input('userOrder_id');

		$driverOrder = DriverOrders::where('user_order_id', $userOrder_id)->first();

		if (!is($driverOrder ?? '')) return [
			'data' => [], 'message' => "User Order not found", 'error' => true
		];

		return ['data' => $driverOrder, 'message' => "User Order Retrive successfully", 'error' => null];
	}

	public function checkCouponStatus(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'user_id' => 'required|numeric',
			'code'    => 'required|string',
			'amount'  => 'required|numeric'
		]);

		if ($validator->fails()) return [
			'data'    => [],
			'error'   => true,
			'message' => json_encode($validator->errors()->getMessages())
		];

		$code    = $request->input('code');
		$amount  = $request->input('amount');
		$user_id = $request->input('user_id');

		$coupon = Coupons::where('code', $code)->where('is_active', '!=', 0)->first();

		if (!is($coupon ?? '', 'json')) return [
			'data' => null, 'message' => 'Coupon not Exist', 'error' => true
		];

		if (!(strtotime($coupon->start_from) < time()) || !(strtotime($coupon->end_to) > time())) return [
			'data' => null, 'message' => 'Coupon Not Valid Yet.', 'error' => true
		];

		switch ($coupon->type) {
			case 'flat':
				$userOrders = UserOrders::where('user_id', $user_id)->where('coupon_code', $coupon->code)->get();
				if (count($userOrders) >= (int) $coupon->use_count) return [
					'data'    => null,
					'error'   => true,
					'message' => 'User Reached Maximum number of transactions for this Coupon.',
				];

				if (floatval($amount) <=  floatval($coupon->min_order_amount)) return [
					'data' => null, 'error' => true, 'message' => 'Coupon Not Applied on Current Order.',
				];

				return ['data' => $coupon, 'message' => 'Coupon Applied.', 'error' => null];
				break;

			case 'percentage':
				if (floatval($amount) >=  floatval($coupon->min_order_amount))
					return ['data' => $coupon, 'message' => 'Coupon Applied.', 'error' => null];
				else return ['data' => null, 'message' => 'Coupon Not Applied on Current Order.', 'error' => true];
				break;

			default:
				return ['data' => null, 'message' => 'Coupon Type Not Found.', 'error' => true];
				break;
		}

		return ['data' => null, 'message' => 'Coupon Not Applied on Current Order.', 'error' => true];
	}

	public function driverDetails(Request $request)
	{
		$validator = Validator::make($request->all(), ['driver_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$driver = Drivers::where('id', $request->input('driver_id'))->first();

		if (!is($driver ?? '', 'json')) return ['data' => [], 'message' => 'Driver Details not found', 'error' => true];
		return ['data' => $driver, 'message' => 'Driver Details retrive successfully', 'error' => null];
	}

	public function driverOverallTraveled(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$driver = UserOrders::where('driver_orders.status', 1)
			->where('driver_orders.driver_id', $request->input('user_id'))
			->leftJoin('driver_orders', 'driver_orders.user_order_id', '=', 'user_orders.id')
			->sum('user_orders.kms');

		return ['data' => ['total_traveled' => $driver], 'message' => 'Driver Overall Rating', 'error' => null];
	}

	public function driverPayout(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric', 'amount' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id');
		$amount  = $request->input('amount');

		$user = Users::where('id', $user_id)->ofType('DRIVER')->first();

		if (!is($user ?? '', 'object')) return ['data' => [], 'message' => 'driver not found', 'error' => true];
		if ($amount > $user->amount) return ['data' => [], 'message' => 'Request Amount larger then balance', 'error' => true];

		$request_id = DriverPayout::create(['amount' => $amount, 'user_id' => $user_id, 'created_by' => $user_id,]);

		if (!is($request_id ?? '')) return ['data' => [], 'message' => 'Something went wrong in Request.', 'error' => true];
		return ['data' => $request_id, 'message' => 'Driver Payout request created successfully', 'error' => null];
	}

	public function driverPayouts(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id');
		$user    = Users::where('id', $user_id)->ofType('DRIVER')->first();

		if (!is($user ?? '', 'object')) return ['data' => [], 'message' => 'driver not found', 'error' => true];

		$payouts = DriverPayout::where('user_id', $user_id)->get();

		if (!is($payouts ?? '')) return ['data' => [], 'message' => 'Something went wrong in Request.', 'error' => true];
		return ['data' => $payouts, 'message' => 'Driver Payouts List', 'error' => null];
	}

	public function driverRating(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id');
		$ratings = Ratings::where('reviewer_id', $user_id)->avg('rate');

		return ['data' => ['average_rating' => $ratings], 'message' => 'Driver Overall Rating', 'error' => null];
	}

	public function driverRides(Request $request)
	{
		$validator = Validator::make($request->all(), ['driver_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$driver_id = $request->input('driver_id');

		$driverOrder = DriverOrders::where('driver_id', $driver_id)
			->leftJoin('user_orders', 'user_orders.id', '=', 'driver_orders.user_order_id')
			->select('driver_orders.*', 'user_orders.pickup_text', 'user_orders.drop_text', 'user_orders.price')->get();

		return ['data' => $driverOrder, 'message' => "Driver Order Retrive successfully", 'error' => null];
	}

	public function driverStatus(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'user_id'       => 'required|numeric',
			'location'      => 'required',
			'is_active'     => 'required',
			'location_lat'  => 'required',
			'location_long' => 'required',
		]);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id       = $request->input('user_id');
		$location      = $request->input('location');
		$is_active     = $request->input('is_active');
		$location_lat  = $request->input('location_lat');
		$location_long = $request->input('location_long');

		$user = Users::where('id', $user_id)->ofType('DRIVER')->first();

		if (!is($user ?? '', 'object')) return ['data' => [], 'message' => 'Driver not found', 'error' => true];

		$driver_updates = [];
		if (is($location ?? '')) $driver_updates['location']           = $location;
		if (is($is_active ?? '')) $driver_updates['is_active']         = $is_active === 'online' ? true : '0';
		if (is($location_lat ?? '')) $driver_updates['location_lat']   = $location_lat;
		if (is($location_long ?? '')) $driver_updates['location_long'] = $location_long;

		Users::where('id', $user_id)->ofType('DRIVER')->update($driver_updates);

		return ['data' => Users::find($user_id), 'message' => "Driver is $is_active", 'error'   => null];
	}

	public function fetchSettings()
	{
		$setting = [];
		$settings = Settings::all();

		foreach ($settings as $settingItem) {
			$setting[$settingItem->option_key] = $settingItem->option_value;
		};

		return [
			'error'   => null,
			'data'    => $setting,
			'message' => 'All Setting'
		];
	}

	public function getBids(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_order_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_order_id = $request->input('user_order_id');

		$userOrders = DriverOrders::where('driver_orders.user_order_id', $user_order_id)
			->orderByDesc('driver_orders.id')
			->where('driver_orders.status', 0)
			->where('driver_orders.type', 'outdoor')
			->leftJoin('users', 'users.id', '=', 'driver_orders.driver_id')
			->select('driver_orders.*', 'users.first_name', 'users.profile_pic')->get();

		if (!is($userOrders ?? '')) return ['data' => [], 'error' => true, 'message' => 'Bids not found',];

		foreach ($userOrders as $key => $value) {
			$rate = Ratings::where('user_id', $value->driver_id)->avg('rate');
			$userOrders[$key]->total_reviews = Ratings::where('user_id', $value->driver_id)->count();
			$userOrders[$key]->rating = $rate ?? '0';
		}

		return ['error' => null, 'data' => $userOrders, 'message' => 'Bid successfully'];
	}

	public function getDetails(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id');
		$user    = Users::find($user_id);

		if (!is($user ?? '', 'json')) return ['data' => [], 'error' => true, 'message' => 'User not found'];
		return ['error' => null, 'data' => $user, 'message' => 'Data successfully retrived'];
	}

	public function getDriverBids(Request $request)
	{
		$validator = Validator::make($request->all(), ['driver_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$driver_id = $request->input('driver_id');

		$userOrders = DriverOrders::where('driver_orders.driver_id', $driver_id)
			->where('driver_orders.type', 'outdoor')
			->leftJoin('user_orders', 'user_orders.id', '=', 'driver_orders.user_order_id')
			->select('driver_orders.*', 'user_orders.kms', 'user_orders.drop_text', 'user_orders.pickup_text', 'user_orders.booking_date')
			->orderByDesc('driver_orders.id')
			->get();

		if (!is($userOrders ?? '', 'json')) return ['data' => [], 'error' => true, 'message' => 'Bids not found',];
		return ['error' => null, 'data' => $userOrders, 'message' => 'Bid successfully',];
	}

	public function getOutdoorOrders()
	{
		$order = UserOrders::where('status', '0')->ofType('outdoor')->orderByDesc('id');

		if (!is($order ?? '', 'json')) return ['data' => [], 'message' => 'No orders found', 'error' => true];
		return ['error' => null, 'data' => $order, 'message' => 'Order successfully fetched'];
	}

	public function getTransactions(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => $validator->errors()->getMessages()['user_id'][0]
		];

		return [
			'error'   => null,
			'message' => 'All Transactions',
			'data'    => Wallet::where('user_id', $request->input('user_id', '1'))->orderByDesc('id')->get(),
		];
	}

	public function getUserOutdoorOrders(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id');
		$order   = UserOrders::where('user_id', $user_id)->ofType('outdoor')->orderBy('status')->get();

		if (!is($order ?? '', 'json')) return ['data' => [], 'error' => true, 'message' => 'No orders found'];

		foreach ($order as $key => $value) {
			$order[$key]->driver = DriverOrders::where('driver_orders.user_order_id', $value->id)
				->where('driver_orders.status', '!=', 3)
				->where('driver_orders.status', '!=', '0')
				->leftJoin('users', 'users.id', '=', 'driver_orders.driver_id')
				->select('driver_orders.*', 'users.first_name', 'users.profile_pic')
				->get();
		}
		return ['error' => null, 'data' => $order, 'message' => 'Order successfully fetched'];
	}

	public function ongoingRide(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id');
		$ride    = UserOrders::where('user_orders.user_id', $user_id)
			->where('driver_orders.status', 6)
			->where('user_orders.type', 'upcoming')
			->leftJoin('users', 'users.id', '=', 'driver_orders.driver_id')
			->leftJoin('driver_orders', 'driver_orders.user_order_id', '=', 'user_orders.id')
			->select(
				'driver_orders.*',
				'user_orders.otp',
				'user_orders.drop_lat',
				'user_orders.drop_text',
				'user_orders.drop_long',
				'user_orders.pickup_lat',
				'user_orders.pickup_text',
				'user_orders.pickup_long',
				'user_orders.booking_date',
				'user_orders.payment_mode',
				'users.mobile as driver_mobile',
				'users.first_name as driver_first_name',
				'users.profile_pic as driver_profile_pic',
			)->get();

		return ['error' => null, 'data' => $ride, 'message' => 'Your upcoming ride.',];
	}

	public function review(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'review'      => 'required',
			'rate'        => 'required',
			'user_id'     => 'required|numeric',
			'reviewer_id' => 'required|numeric',
		]);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$rate        = $request->input('rate');
		$review      = $request->input('review');
		$user_id     = $request->input('user_id');
		$reviewer_id = $request->input('reviewer_id');

		$user     = Users::where('id', $user_id)->isNotDelete()->first();
		$reviewer = Users::where('id', $reviewer_id)->isNotDelete()->first();

		if (!is($user ?? '', 'object') or !is($reviewer ?? '', 'object')) return [
			'data' => [], 'error' => true, 'message' => 'Rider not found',
		];

		$reviews = Ratings::create([
			'rate'        => $rate,
			'review'      => $review,
			'created_by'  => $user_id,
			'user_id'     => $user_id,
			'reviewer_id' => $reviewer_id,
		]);

		if (!is($reviews ?? '')) return ['data' => [], 'error' => null, 'message' => 'Something went wrong'];
		return ['error' => null, 'data' => $reviews, 'message' => 'Review Successfully'];
	}

	private function sendNotification($FcmToken = "", $data = ["title" => "Hello", "body"  => "Notification send successfully"])
	{
		$encodedData = json_encode(["to" => $FcmToken, "notification" => $data]);
		$headers     = ['Authorization:key=' . env('FCM_SERVER_KEY'), 'Content-Type: application/json'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, env('FCM_URL'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

		// Execute post
		$result = curl_exec($ch);

		if ($result === FALSE) {
			Log::error("FCM notification failed curl error", [curl_error($ch)]);
			Log::error("FCM notification failed", [$result]);
			curl_close($ch);
			return false;
		}

		// Close connection
		curl_close($ch);

		Log::debug("FCM notification", $result);
		return true;
	}

	public function signin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'profile_pic' => 'url',
			'email'       => 'email',
			'uuid'        => 'string',
			'password'    => 'string',
			'last_name'   => 'string',
			'first_name'  => 'string',
			'app_token'   => 'required|string',
			'mobile'      => 'required|numeric',
			'user_type'   => 'nullable|in:USER,DRIVER'
		]);

		if ($validator->fails()) return ['data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())];

		$user_type = $request->input('user_type', 'USER');
		$user      = Users::where('mobile', $request->input('mobile'))->ofType($user_type)->first();

		if (!is($user ?? '', 'json')) {
			$user = Users::create(array_merge(array_filter($request->all()), [
				'created_by'   => 1,
				'user_ip'      => $request->ip(),
				'app_token_id' => $request->input('app_token'),
				'status'       => $user_type === 'DRIVER' ? '0' : '1',
			]));

			$amount = Settings::where('option_key', 'new_user_balance')->first()->option_value;

			if (is($user->id ?? '') && is($amount ?? '') && $user_type === 'USER' && (float)$amount > 0) {
				$transaction_id = Wallet::create([
					'amount'           => $amount,
					'transaction_type' => 'credit',
					'user_id'          => $user->id,
					'created_by'       => $user->id,
					'transaction_id'   => 'AD' . time(),
					'payment_type'     => 'onRegisterNewUser',
				]);

				if ($transaction_id) Users::where('id', $user->id)->update(['amount' => $amount]);
			}

			return ['error' => null, 'data' => Users::find($user->id), 'message' => "$user_type sign up successfully"];
		} else {
			if (is($user ?? '', 'json')) {
				Users::find($user->id)->update([
					'user_ip'      => $request->ip(),
					'app_token_id' => $request->input('app_token'),
				]);

				return ['error' => null, 'data' => Users::find($user->id), 'message' => "Login $user_type successfully"];
			}

			return ['data' => [], 'error' => true, 'message' => 'User not found'];
		}

		return ['data' => null, 'error' => true, 'message' => 'Something Went Wrong'];
	}

	public function upcomingDriverRides(Request $request)
	{
		$validator = Validator::make($request->all(), ['driver_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$driver_id = $request->input('driver_id');
		$rides     = DriverOrders::where('driver_orders.driver_id', $driver_id)
			->where('driver_orders.type', 'upcoming')
			->leftJoin('user_orders', 'driver_orders.user_order_id', '=', 'user_orders.id')
			->leftJoin('users', 'users.id', '=', 'user_orders.user_id')
			->select(
				'driver_orders.*',
				'user_orders.otp',
				'users.id as rider_id',
				'user_orders.drop_lat',
				'user_orders.drop_text',
				'user_orders.drop_long',
				'user_orders.pickup_lat',
				'user_orders.pickup_text',
				'user_orders.pickup_long',
				'user_orders.booking_date',
				'user_orders.payment_mode',
				'users.mobile as rider_mobile',
				'users.first_name as rider_first_name',
				'users.profile_pic as rider_profile_pic',
			)->get();

		return ['error' => null, 'data' => $rides, 'message' => 'Your upcoming rides.'];
	}

	public function upcomingUserRides(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id = $request->input('user_id');
		$rides   = UserOrders::where('user_id', $user_id)->ofType('upcoming')->get();
		return ['error' => null, 'data' => $rides, 'message' => 'Your upcoming rides.'];
	}

	public function updateBooking(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric', 'order_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$driverStatus = 3;
		$category_id  = '';
		$otp          = $request->input('otp');
		$status       = $request->input('status');
		$user_id      = $request->input('user_id');
		$order_id     = $request->input('order_id');

		switch ($status) {
			case 'complete':
				$driverStatus = 1;
				break;

			case 'accept':
				$driverStatus = 2;
				break;

			case 'reject':
				$driverStatus = 3;
				break;

			case 'pickup':
				$driverStatus = 4;
				break;

			case 'ongoing':
				$driverStatus = 5;
				break;

			case 'startride':
				$driverStatus = 6;
				break;

			default:
				$driverStatus = 3;
				break;
		}

		$order = DriverOrders::where('id', $order_id)->where('driver_id', $user_id)->first();
		if (!is($order ?? '', 'json')) return ['data' => [], 'error' => true, 'message' => 'Order not Found'];
		if ($status === 'ongoing') {
			if (!is($otp ?? '')) return ['data' => [], 'error' => true, 'message' => 'Otp is empty'];
			$userOrder = UserOrders::where('id', $order->user_order_id)->where('otp', $otp)->first();
			if (!is($userOrder ?? '', 'json')) return ['data' => [], 'error' => true, 'message' => 'Otp not match, please try again'];
		}

		if ($status === 'startride') {
			$currentRide = UserOrders::find($order->user_order_id);
			if (!is($currentRide ?? '', 'json')) return ['data' => [], 'error' => true, 'message' => 'Your Ride Not Found'];
			$currentRider = Users::find($currentRide->user_id);
			if (
				DriverOrders::find($order_id)->update(['status' => $driverStatus]) && UserOrders::find($currentRide->id)->update(['status' => $driverStatus])
			) {
				$notification = $this->sendNotification($currentRider->app_token_id, [
					'title' => 'Your ride started',
					'body'  => ucfirst($currentRider->first_name) . " Your Ride Started keep ready."
				]);
				if ($notification) return ['data' => [], 'error' => null, 'message' => 'Your Ride Updated'];
				return ['data' => [], 'error' => true, 'message' => 'Notification not send to rider'];
			}
			return ['data' => [], 'error' => true, 'message' => 'Your Ride Not Update'];
		}

		if ($status === 'reject') {
			$avilableDrivers = [];
			$currentDriver   = Users::find($user_id);
			$currentRider    = Users::find($order->created_by);
			$category_id     = $currentDriver->category_id;
			$nextDriver      = Users::ofType('DRIVER')
				->whereNotNull('app_token_id')
				->isActive()
				->where('category_id', $category_id)->first();

			$rejectedDrivers = DriverOrders::where('user_order_id', $order->user_order_id)->get();
			$rejectedDriversArr = array_map(fn ($item) => $item['driver_id'], $rejectedDrivers);

			$AllAvilableDrivers = Users::ofType('DRIVER')
				->whereNotNull('app_token_id')
				->isActive()
				->where('category_id', $category_id)->get();

			foreach ($AllAvilableDrivers as $driverItem) {
				if (!in_array($driverItem->id, $rejectedDriversArr)) array_push($avilableDrivers, $driverItem);
			}

			if (!(count($avilableDrivers) > 0)) {
				$currentRide        = UserOrders::find($order->user_order_id);
				$Admin              = Users::where('username', 'admin')->first();
				$updateUserOrder    = UserOrders::find($order->user_order_id)->update(['status' => 3]);
				$updateUserAccount  = Users::find($user_id)->update(['amount' => $currentRider->amount + $currentRide->price]);
				$updateAdminAccount = Users::find(1)->update(['amount' => $currentRider->amount + $currentRide->price]);
				$updateAdminAccount = Users::where('username', 'admin')->update(['amount' => $Admin->amount - $currentRide->price]);
				$transaction_id     = Wallet::create([
					'payment_type'     => 'refund',
					'transaction_type' => 'credit',
					'created_by'       => $Admin->id,
					'transaction_id'   => 'AD' . time(),
					'user_id'          => $currentRider->id,
					'amount'           => $currentRide->price,
				]);
				$notification = $this->sendNotification($currentRider->app_token_id, [
					'title'        => 'Your booked ride cancelled',
					'body'         => ucfirst($currentRider->first_name) . " no driver accepts Your Order, So will be cancelled.",
					'userOrder_id' => $currentRide->id,
					'user_id'      => $currentRider->id,
				]);

				return ['data' => [], 'message' => 'All Drivers busy right now', 'error' => true];
			} else {
				$driver         = (object) $avilableDrivers[0];
				$currentRide    = UserOrders::find($order->user_order_id);
				$driverOrder_id = DriverOrders::create([
					'driver_id'     => $driver->id,
					'created_by'    => $order->created_by,
					'user_order_id' => $order->user_order_id,
				]);
				$notification = $this->sendNotification($driver->app_token_id, [
					'title'            => 'You have new request',
					'body'             => ucfirst($currentRider->first_name) . " has booked a new ride, Don't keep them waiting.",
					'user_id'          => $driver->id,
					'category_id'      => $category_id,
					'driverOrder_id'   => $driverOrder_id,
					'userOrder_id'     => $currentRide->id,
					'kms'              => $currentRide->kms,
					'type'             => $currentRide->type,
					'user_mobile'      => $currentRider->mobile,
					'drop_lat'         => $currentRide->drop_lat,
					'drop_text'        => $currentRide->drop_text,
					'drop_long'        => $currentRide->drop_long,
					'pickup_lat'       => $currentRide->pickup_lat,
					'pickup_text'      => $currentRide->pickup_text,
					'pickup_long'      => $currentRide->pickup_long,
					'user_first_name'  => $currentRider->first_name,
					'user_profile_pic' => $currentRider->profile_pic,
					'booking_date'     => $currentRide->booking_date,
				]);
			}
		}

		if ($status === 'complete') {
			$currentDriver         = Users::find($user_id);
			$userOrder             = UserOrders::find($order->user_order_id);
			$commission_percentage = intval(Settings::where('option_key', 'admin_commission')
				->first('option_value')->option_value ?? 0);
			$price = intval($userOrder->price)  * (100 / (100 + $commission_percentage));
			DriverOrders::find($order_id)->update(['price' => round($price)]);
			Users::find($user_id)->update(['amount' => $currentDriver->amount + round($price)]);
		}

		DriverOrders::find($order_id)->update(['status' => $driverStatus]);
		if ($status === 'accept') Users::find($user_id)->update(['is_active' => '2']);

		return ['error' => null, 'message' => 'Order Update Successfully', 'data' => DriverOrders::find($order_id)];
	}

	public function updateDriverDetails(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$pan                      = $request->input('pan');
		$ifsc                     = $request->input('ifsc');
		$micr                     = $request->input('micr');
		$brand                    = $request->input('brand');
		$model                    = $request->input('model');
		$color                    = $request->input('color');
		$seats                    = $request->input('seats');
		$image                    = $request->input('image');
		$aadhar                   = $request->input('aadhar');
		$user_id                  = $request->input('user_id');
		$bank_name                = $request->input('bank_name');
		$vehicle_no               = $request->input('vehicle_no');
		$category_id              = $request->input('category_id');
		$branch_name              = $request->input('branch_name');
		$bank_account_no          = $request->input('bank_account_no');
		$driving_licence          = $request->input('driving_licence');
		$manufacture_year         = $request->input('manufacture_year');
		$pollution_certificate    = $request->input('pollution_certificate');
		$registration_certificate = $request->input('registration_certificate');

		$user = Users::where('id', $user_id)->ofType('DRIVER')->first();
		if (!is($user ?? '', 'object')) return ['data' => [], 'message' => 'driver not found', 'error' => true];

		$user_updates    = [];
		$driver_updates  = [];
		$vehicle_updates = [];
		if (is($pan ?? '')) $driver_updates['pan']                                           = $pan;
		if (is($ifsc ?? '')) $driver_updates['ifsc']                                         = $ifsc;
		if (is($micr ?? '')) $driver_updates['micr']                                         = $micr;
		if (is($aadhar ?? '')) $driver_updates['aadhar']                                     = $aadhar;
		if (is($bank_name ?? '')) $driver_updates['bank_name']                               = $bank_name;
		if (is($branch_name ?? '')) $driver_updates['branch_name']                           = $branch_name;
		if (is($bank_account_no ?? '')) $driver_updates['bank_account_no']                   = $bank_account_no;
		if (is($driving_licence ?? '')) $driver_updates['driving_licence']                   = $driving_licence;
		if (is($pollution_certificate ?? '')) $driver_updates['pollution_certificate']       = $pollution_certificate;
		if (is($registration_certificate ?? '')) $driver_updates['registration_certificate'] = $registration_certificate;

		if (is($brand ?? '')) $vehicle_updates['brand']                       = $brand;
		if (is($model ?? '')) $vehicle_updates['model']                       = $model;
		if (is($color ?? '')) $vehicle_updates['color']                       = $color;
		if (is($seats ?? '')) $vehicle_updates['seats']                       = $seats;
		if (is($seats ?? '')) $vehicle_updates['seats']                       = $seats;
		if (is($image ?? '')) $vehicle_updates['image']                       = $image;
		if (is($vehicle_no ?? '')) $vehicle_updates['vehicle_no']             = $vehicle_no;
		if (is($category_id ?? '')) $vehicle_updates['category_id']           = $category_id;
		if (is($manufacture_year ?? '')) $vehicle_updates['manufacture_year'] = $manufacture_year;

		if (is($category_id ?? '')) $user_updates['category_id'] = $category_id;

		if (is($driver_updates ?? '', 'array'))
			if (!is($user->driver_id ?? '')) {
				$driver_id = Drivers::create($driver_updates);
				Users::find($user_id)->update(['driver_id' => $driver_id, 'category_id' => $category_id]);
			} else Drivers::find($user->driver_id)->update($driver_updates);

		if (is($vehicle_updates ?? '', 'array'))
			if (!is($user->vehicle_id ?? '')) {
				$vehicle_updates['status'] = true;
				$vehicle_id = Vehicles::create($vehicle_updates);
				Users::find($user_id)->update(['vehicle_id' => $vehicle_id]);
			} else Vehicles::find($user->vehicle_id)->update($vehicle_updates);

		if (is($user_updates ?? '', 'array') and is($user_id ?? '')) Users::find($user_id)->update($user_updates);

		return ['error' => null, 'message' => 'Details Updated', 'data' => Users::find($user_id)];
	}

	public function updateProfile(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$about        = $request->input('bio');
		$dob          = $request->input('dob');
		$email        = $request->input('email');
		$mobile       = $request->input('mobile');
		$user_id      = $request->input('user_id');
		$fb_id        = $request->input('facebook');
		$last_name    = $request->input('last_name');
		$instagram_id = $request->input('instagram');
		$first_name   = $request->input('first_name');
		$profile_pic  = $request->input('profile_pic');

		$updates = [];
		if (is($dob ?? '')) $updates['dob']                   = $dob;
		if (is($about ?? '')) $updates['about']               = $about;
		if (is($email ?? '')) $updates['email']               = $email;
		if (is($fb_id ?? '')) $updates['fb_id']               = $fb_id;
		if (is($mobile ?? '')) $updates['mobile']             = $mobile;
		if (is($last_name ?? '')) $updates['last_name']       = $last_name;
		if (is($first_name ?? '')) $updates['first_name']     = $first_name;
		if (is($profile_pic ?? '')) $updates['profile_pic']   = $profile_pic;
		if (is($instagram_id ?? '')) $updates['instagram_id'] = $instagram_id;

		Users::where('id', $user_id)->where('user_type', '!=', 'ADMIN')->update($updates);
		return ['error' => null, 'message' => 'Profile Updated', 'data' => Users::find($user_id)];
	}

	public function uploadFile(Request $request)
	{
		$validator = Validator::make($request->all(), ["file" => "required|mimes:png,jpg,jpeg|max:2048"]);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$filePath = FormImage::upload($request, 'file', 'api');

		return ['error' => null, 'data' => ["uri" => $filePath], 'message' => 'File uploaded successfully'];
	}

	public function userRides(Request $request)
	{
		$validator = Validator::make($request->all(), ['user_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$user_id   = $request->input('user_id');
		$userOrder = UserOrders::where('user_id', $user_id)->get();

		if (!is($userOrder ?? '', 'json')) return ['data' => [], 'error' => null, 'message' => "no order",];
		return ['data' => $userOrder, 'message' => "User Order Retrive successfully", 'error' => null];
	}

	public function vehicleCategories()
	{
		$categories = Categories::ofType('VEHICLE')->isNotDelete()->orderBy('id')->get();

		if (is($categories ?? '', 'json'))
			return ['data' => $categories, 'message' => 'All Vehicles Categories', 'error' => null];
		return ['data' => [], 'message' => 'No record found', 'error' => true];
	}

	public function vehicleDetails(Request $request)
	{
		$validator = Validator::make($request->all(), ['vehicle_id' => 'required|numeric']);

		if ($validator->fails()) return [
			'data' => [], 'error' => true, 'message' => json_encode($validator->errors()->getMessages())
		];

		$vehicle_id = $request->input('vehicle_id');
		$vehicle    = Vehicles::find($vehicle_id);

		if (!is($vehicle ?? '', 'json')) return ['data' => [], 'message' => 'Vehicle Details not found', 'error' => true];
		return ['data' => $vehicle, 'message' => 'Data retrive successfully', 'error' => null];
	}

	public function vehicles()
	{
		$categories = Categories::ofType()->isNotDelete()->orderBy('id')->get();

		$categories->each(function ($item, $key) use ($categories) {
			$brand = Vehicles::where('category_id', $item->id)->isNotDelete()->groupBy('brand')->get(['brand']);
			$categories[$key]->price = $item->extra_field;
			$categories[$key]->brand = $brand->map(fn ($brandItem) => $brandItem->brand);
		});

		return ['error' => null, 'data' => $categories, 'message' => 'All Vehicles'];
	}
}
