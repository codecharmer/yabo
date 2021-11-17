<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model};

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $coupon_code
 * @property string $pickup_text
 * @property string $drop_text
 * @property string $pickup_long
 * @property string $pickup_lat
 * @property string $drop_long
 * @property string $drop_lat
 * @property string $price
 * @property string $kms
 * @property string $otp
 * @property string $booking_date
 * @property string $type
 * @property integer $status
 * @property string $payment_mode
 * @property integer $created_by
 * @property string $created_date
 * @property string $comment
 */
class UserOrders extends Model
{
	/**
	 * The "type" of the auto-incrementing ID.
	 *
	 * @var string
	 */
	protected $keyType = 'integer';
	protected $primaryKey = 'id';

	/**
	 * @var array
	 */
	protected $fillable = [
		'kms',
		'otp',
		'type',
		'price',
		'status',
		'user_id',
		'comment',
		'drop_lat',
		'drop_text',
		'drop_long',
		'pickup_lat',
		'created_by',
		'coupon_code',
		'pickup_text',
		'pickup_long',
		'booking_date',
		'payment_mode',
	];

	public $timestamps = false;


	/** Scope a query to only include status is 1.
	 *
	 * @param Builder $query
	 * @return Builder */
	public function scopeIsNotDelete(Builder $query): Builder
	{
		return $query->where('status', 1);
	}

	/** Scope a query to only include User of a given type.
	 *
	 * @param Builder $query
	 * @param string $type VEHICLE
	 * @return Builder */
	public function scopeOfType(Builder $query, string $type = 'normal'): Builder
	{
		return $query->where('type', $type);
	}


	/** Scope a query to only include Driver Payout of a given status.
	 *
	 * @param Builder $query
	 * @param int $type
	 * @return Builder */
	public function scopeIsStatus(Builder $query, int $type = 0): Builder
	{
		return $query->where('status', $type);
	}
}
