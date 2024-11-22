<?php

namespace App\Base\Filters\Taxi;

use App\Base\Libraries\QueryFilter\FilterContract;

/**
 * Test filter to demonstrate the custom filter usage.
 * Delete later.
 */
class RequestFilter implements FilterContract {
	/**
	 * The available filters.
	 *
	 * @return array
	 */
	public function filters() {
		return [
			'is_completed','is_cancelled','is_trip_start','is_paid','payment_opt','vehicle_type','is_later','service_location_id'
		];
	}

	public function is_completed($builder, $value = 0) {
		$builder->where('is_completed', $value);
    }
    
	public function is_cancelled($builder, $value = 0) {
		$builder->where('is_cancelled', $value);
    }
    
	public function is_trip_start($builder, $value = 0) {
		$builder->where('is_trip_start', $value)->where('is_cancelled',0);
    }
    
    public function is_paid($builder, $value = 0){
        $builder->where('is_paid',$value);
    }

    public function payment_opt($builder, $value = 0){
        $builder->where('payment_opt',$value);
	}
	
	public function vehicle_type($builder, $value = 0){
		$builder->whereHas('typeDetail' , function($q) use ($value){
			$q->where('id',$value);
		});
	}

	public function is_later($builder, $value = 0){
		$builder->where('is_later',$value);
	}

	public function service_location_id($builder,$value=null){
		if($value)
			$builder->where('service_location_id',$value);
	}
}
