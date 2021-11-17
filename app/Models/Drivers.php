<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $registration_certificate
 * @property string $driving_licence
 * @property string $pollution_certificate
 * @property string $aadhar
 * @property string $pan
 * @property string $bank_account_no
 * @property string $bank_name
 * @property string $branch_name
 * @property string $micr
 * @property string $ifsc
 */
class Drivers extends Model
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
		'registration_certificate',
		'driving_licence',
		'pollution_certificate',
		'aadhar',
		'pan',
		'bank_account_no',
		'bank_name',
		'branch_name',
		'micr',
		'ifsc'
	];
	public $timestamps = false;
}
