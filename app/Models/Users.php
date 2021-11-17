<?php

namespace App\Models;

use Illuminate\{Foundation\Auth\User as Authenticate, Notifications\Notifiable, Database\Eloquent\Builder};

/**
 * @property integer $id
 * @property int $category_id
 * @property string $uuid
 * @property string $user_ip
 * @property string $username
 * @property string $slug
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $profile_pic
 * @property string $amount
 * @property string $dob
 * @property string $about
 * @property string $gender
 * @property int $status
 * @property integer $parent_id
 * @property integer $driver_id
 * @property integer $vehicle_id
 * @property string $location
 * @property string $location_lat
 * @property string $location_long
 * @property int $is_active
 * @property string $email_verified
 * @property string $mobile_verified
 * @property string $google_id
 * @property string $fb_id
 * @property integer $address_id
 * @property integer $ref_id
 * @property string $pincode
 * @property string $user_type
 * @property integer $role_id
 * @property string $remember_token
 * @property string $app_token_id
 * @property string $last_login_device
 * @property string $device_type
 * @property string $browser
 * @property string $browser_version
 * @property string $os
 * @property string $mobile_device
 * @property string $last_login_date
 * @property string $comment
 * @property integer $created_by
 * @property string $created_date
 * @property integer $modified_by
 * @property string $modified_date
 */
class Users extends Authenticate
{
	use Notifiable;

	/** The "type" of the auto-incrementing ID.
	 *
	 * @var string */
	protected $keyType = 'integer';
	protected $primaryKey = 'id';

	/** @var string[] */
	protected $fillable = [
		'category_id',
		'uuid',
		'user_ip',
		'username',
		'slug',
		'email',
		'mobile',
		'password',
		'first_name',
		'last_name',
		'profile_pic',
		'amount',
		'dob',
		'about',
		'gender',
		'status',
		'parent_id',
		'driver_id',
		'vehicle_id',
		'location',
		'location_lat',
		'location_long',
		'is_active',
		'email_verified',
		'mobile_verified',
		'google_id',
		'fb_id',
		'address_id',
		'ref_id',
		'pincode',
		'user_type',
		'role_id',
		'remember_token',
		'app_token_id',
		'last_login_device',
		'device_type',
		'browser',
		'browser_version',
		'os',
		'mobile_device',
		'last_login_date',
		'comment',
		'created_by',
		'created_date',
		'modified_by',
		'modified_date'
	];

	const CREATED_AT = 'created_date';
	const UPDATED_AT = 'modified_date';

	/** Scope a query to only include users is active.
	 *
	 * @param Builder $query
	 * @return Builder */
	public function scopeIsActive(Builder $query): Builder
	{
		return $query->where('is_active', 1);
	}

	/** Scope a query to only include User of a given type.
	 *
	 * @param Builder $query
	 * @param string $type VEHICLE
	 * @return Builder */
	public function scopeOfType(Builder $query, string $type = 'USER'): Builder
	{
		return $query->where('user_type', $type);
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
