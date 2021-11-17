<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $reviewer_id
 * @property string $review
 * @property string $rate
 * @property integer $created_by
 * @property string $created_date
 */
class Ratings extends Model
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
	protected $fillable = ['user_id', 'reviewer_id', 'review', 'rate', 'created_by'];

	public $timestamps = false;
}
