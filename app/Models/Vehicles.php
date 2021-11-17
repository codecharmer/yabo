<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model};

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $image
 * @property string $vehicle_no
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property string $seats
 * @property string $toll_charges
 * @property int $price
 * @property string $manufacture_year
 * @property boolean $status
 * @property string $created_date
 * @property string $modified_date
 */
class Vehicles extends Model
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
		'category_id',
		'image',
		'vehicle_no',
		'brand',
		'model',
		'color',
		'seats',
		'toll_charges',
		'price',
		'manufacture_year',
		'status'
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
}
