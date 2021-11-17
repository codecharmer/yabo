<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model};

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $amount
 * @property string $status
 * @property string $transaction_mode
 * @property string $transaction_id
 * @property string $message
 * @property integer $created_by
 * @property string $created_date
 * @property string $modified_date
 */
class DriverPayout extends Model
{
	protected $primaryKey = 'id';
	public    $timestamps = false;
	protected $keyType    = 'integer';
	protected $table      = 'driver_payout';
	protected $fillable   = [
		'amount',
		'status',
		'user_id',
		'message',
		'created_by',
		'transaction_id',
		'transaction_mode',
	];

	/** Scope a query to only include Driver Payout of a given status.
	 *
	 * @param Builder $query
	 * @param string $type 'PENDING','PROCESSING','COMPLETED'
	 * @return Builder */
	public function scopeIsStatus(Builder $query, string $type = 'PENDING'): Builder
	{
		return $query->where('status', $type);
	}
}
