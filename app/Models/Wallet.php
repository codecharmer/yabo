<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $coupon_code
 * @property string $payment_type
 * @property string $amount
 * @property string $transaction_type
 * @property integer $created_by
 * @property string $created_date
 * @property string $transaction_id
 */
class Wallet extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'wallet';

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
		'amount',
		'user_id',
		'created_by',
		'coupon_code',
		'payment_type',
		'transaction_id',
		'transaction_type',
	];

	public $timestamps = false;

	/** Scope a query to only include Wallet of a given type.
	 *
	 * @param Builder $query
	 * @param string $type 'credit','debit'
	 * @return Builder */
	public function scopeOfType(Builder $query, string $type = 'credit'): Builder
	{
		return $query->where('transaction_type', $type);
	}
}
