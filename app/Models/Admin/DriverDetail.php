<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\Driver;

class DriverDetail extends Model {
	use HasActive, UuidModel,SoftDeletes;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'driver_details';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'driver_id', 'latitude', 'longitude','bearing','is_socket_connected','current_zone','rating','rated_by','owner','is_company_driver'
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
        return $this->belongsTo(Driver::class, 'admin_id', 'id');
    }

    
}
