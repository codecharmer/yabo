<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int $id
 * @property string $option_key
 * @property string $option_value
 * @property string $created_date
 * @property string $modified_date
 */
class Settings extends Model
{
	protected $primaryKey = 'id';
	public    $timestamps = false;
	protected $fillable   = ['option_key', 'option_value'];

	public function scopeGetOption(Builder $query, string $option_key, bool $force = false)
	{
		if ($force) Cache::forget($option_key);
		return Cache::remember($option_key, Carbon::now()->addMinutes(10), function () use ($query, $option_key) {
			return $query->where('option_key', $option_key)->first(['option_value', 'option_key']);
		});
	}
}
