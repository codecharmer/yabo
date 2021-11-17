<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $code
 * @property string $type
 * @property boolean $is_active
 * @property string $start_from
 * @property string $end_to
 * @property int $use_count
 * @property string $max_amount
 * @property string $percentage
 * @property string $min_order_amount
 * @property string $description
 * @property string $created_date
 * @property string $modified_date
 */
class Coupons extends Model
{
	/** The "type" of the auto-incrementing ID.
	 *
	 * @var string */
	protected $keyType = 'integer';

	protected $primaryKey = 'id';

	/** The attributes that are mass assignable.
	 *
	 * @var string[] */
	protected $fillable = [
		'code',
		'type',
		'is_active',
		'start_from',
		'end_to',
		'use_count',
		'max_amount',
		'percentage',
		'min_order_amount',
		'description',
	];

	public $timestamps = false;
}
