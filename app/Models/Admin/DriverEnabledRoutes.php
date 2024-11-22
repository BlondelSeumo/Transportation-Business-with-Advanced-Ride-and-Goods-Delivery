<?php

namespace App\Models\Admin;

use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Driver;

class DriverEnabledRoutes extends Model {
	use HasActive;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'driver_enabled_routes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'driver_id', 'current_lat','current_lng','current_address'
	];

	

	/**
	 * The relationships that can be loaded with query string filtering includes.
	 *
	 * @var array
	 */
	public $includes = [
		'driver'
	];

	   /**
     * The driver that the uploaded data belongs to.
     * @tested
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    
}
