<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model};

/** @property integer $id
 * @property integer $user_order_id
 * @property integer $driver_id
 * @property string $price
 * @property string $type
 * @property boolean $status
 * @property string $is_paid
 * @property integer $created_by
 * @property string $created_date */
class DriverOrders extends Model
{
	/** The "type" of the auto-incrementing ID.
	 *
	 * @var string */
	protected $keyType = 'integer';
	protected $primaryKey = 'id';

	/** @var array */
	protected $fillable = [
		'type',
		'price',
		'status',
		'is_paid',
		'driver_id',
		'created_by',
		'user_order_id',
	];

	public $timestamps = false;

	/** Scope a query to only include categories of a given type.
	 *
	 * @param Builder $query
	 * @param string $type
	 * @return Builder */
	public function scopeOfType(Builder $query, string $type = 'normal'): Builder
	{
		return $query->where('type', $type);
	}

	/** Scope a query to only include status is 1.
	 *
	 * @param Builder $query
	 * @return Builder */
	public function scopeIsNotDelete(Builder $query): Builder
	{
		return $query->where('status', 1);
	}
}
