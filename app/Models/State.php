<?php

namespace App\Models;

use App\Base\Slug\HasSlug;
use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class State extends Model {
	use HasActive, HasSlug, UuidModel;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'states';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'slug', 'name', 'active',
	];

	/**
	 * The attributes that can be used for sorting with query string filtering.
	 *
	 * @var array
	 */
	public $sortable = [
		'name',
	];

	/**
	 * The relationships that can be loaded with query string filtering includes.
	 *
	 * @var array
	 */
	public $includes = [
		'cities',
	];

	/**
	 * The list of cities the state has.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function cities() {
		return $this->hasMany(City::class, 'state_id', 'id');
	}

	/**
	 * Get the attribute name to slugify.
	 *
	 * @return string
	 */
	public function getSlugSourceColumn() {
		return 'name';
	}
}
