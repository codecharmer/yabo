<?php

namespace App\Models;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\{Database\Eloquent\Model, Support\Facades\DB};
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $post_type
 * @property string $extra_field
 * @property string $image
 * @property boolean $status
 * @property integer $created_by
 * @property string $created_date
 * @property integer $modified_by
 * @property string $modified_date
 */
class Categories extends Model
{
	use HasSlug;

	/** The table associated with the model.
	 *
	 * @var string */
	protected $table = 'categories';

	/** The "type" of the auto-incrementing ID.
	 *
	 * @var string */
	protected $keyType = 'integer';

	protected $primaryKey = 'id';

	public $timestamps = false;

	/** @var string[] */
	protected $fillable = [
		'slug',
		'title',
		'post_type',
		'extra_field',
		'image',
		'status',
		'created_by',
		'modified_by',
	];

	/**
	 * Get the options for generating the slug.
	 */
	public function getSlugOptions(): SlugOptions
	{
		return SlugOptions::create()
			->generateSlugsFrom('title')
			->saveSlugsTo('slug');
	}

	/** Scope a query to only include Categories of a given type.
	 *
	 * @param Builder $query
	 * @param string $type VEHICLE
	 * @return Builder */
	public function scopeOfType(Builder $query, string $type = 'VEHICLE'): Builder
	{
		return $query->where('post_type', $type);
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
