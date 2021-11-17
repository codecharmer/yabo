<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Log;

if (!function_exists('is')) {
	/** Check Variable Exists or Not
	 *
	 * If Action is Defined & Variable Exists, Then Do Action
	 *
	 * @param mixed $param Parameter
	 * @param string $action ex.  `json`, `object`, `array`
	 * @return bool */
	function is($param = null, ?string $action = null)
	{
		if (isset($param)) {
			if (is_null($action)) {
				return isset($param) and $param !== false and $param !== '' and !empty($param);
			} elseif (!is_null($action) and $action === 'array') {
				return isset($param) and $param !== false and $param != '' and !empty($param) and is_array($param);
			} elseif (!is_null($action) and ($action === 'json' or $action === 'object')) {
				return isset($param) and $param !== false and $param != '' and !empty($param) and is_object($param);
			}
		}
		return false;
	}
}

if (!function_exists('datetime_format')) {
	/** Format Numaric String to DateTime Format
	 * @param string $date
	 * @return string|0 */
	function datetime_format($date)
	{
		if (is($date ?? ''))
			return date('M d, Y', strtotime($date)) . ' At ' . date('h: i A', strtotime($date));
		return 0;
	};
}

if (!function_exists('get_status')) {
	function get_status($status = null)
	{
		$statuses = [
			0  => ['title' => 'new', 'class' => 'info'],
			1  => ['title' => 'approved', 'class' => 'success'],
			2  => ['title' => 'draft or pending', 'class' => 'dark'],
			3  => ['title' => 'delete', 'class' => 'danger'],
			4  => ['title' => 'block', 'class' => 'danger'],
			11 => ['title' => 'contacted', 'class' => 'info'],
			12 => ['title' => 'interested', 'class' => 'success'],
			13 => ['title' => 'proposal sent', 'class' => 'secondary'],
			14 => ['title' => 'not interested', 'class' => 'danger'],
			15 => ['title' => 'not convanced', 'class' => 'warning'],
			16 => ['title' => 'contact us', 'class' => 'info'],
		];

		$data = new stdClass();

		isset($status) and array_key_exists($status, $statuses) and
			$data->title = ucwords($statuses[$status]['title']);

		isset($status) and array_key_exists($status, $statuses) and
			$data->class = strtolower($statuses[$status]['class']);

		return $data;
	}
}

if (!function_exists('getDiscountedAmount')) {
	/**
	 * Get Discounted Amount
	 *
	 * @param object|null $coupon {min_order_amount, max_amount, type, percentage }
	 * @param int $amount
	 * @return int
	 */
	function getDiscountedAmount(object $coupon = null, int $amount)
	{
		if ($amount < (int) $coupon->min_order_amount) return $amount;
		switch ($coupon->type) {
			case 'flat':
				return ((int) $amount - (int) $coupon->max_amount);
				break;

			case 'percentage':
				$discoount_amount = ($amount * ((float) $coupon->percentage / 100));
				if ($discoount_amount > (int) $coupon->max_amount)
					return ((int) $amount - (int) $coupon->max_amount);
				else
					return $discoount_amount;
				break;

			default:
				return $amount;
				break;
		}
	}
}

if (!function_exists('object')) {
	/** Convert Array to Object
	 *
	 * @param array $param
	 * @return object */
	function object(array $param = []): object
	{
		return json_decode(json_encode($param));
	}
}

if (!function_exists('price_format')) {
	/** Format Numaric String to Indian Currency Format
	 * @param mixed $price
	 * @return string|0 */
	function price_format($price)
	{
		$currency = Settings::getOption('site_currency');
		$currency = is($currency, 'json') ? $currency->option_value : '';
		if (!class_exists('NumberFormatter')) return $price;
		$format = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
		$format->setTextAttribute(NumberFormatter::CURRENCY, $currency);
		$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
		if (is($price ?? '') and (is_string($price) or is_int($price) or is_float($price)) and (float)$price > 0)
			return $format->formatCurrency($price, $currency);
		elseif ((float)$price < 0)
			return '-' . $format->formatCurrency(str_replace('-', '', (string)$price), $currency);
		return $format->formatCurrency($price, $currency);
	};
}

if (!function_exists('image_format')) {
	function image_format(string  $image): string
	{
		return is($image ?? '') ? $image : 'https://via.placeholder.com/150/000000/FFFFFF';
	}
}

if (!function_exists('sendNotification')) {
	function sendNotification($FcmToken = "", $data = ["title" => "Hello", "body"  => "Notification send successfully"])
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
}
