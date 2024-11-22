<?php

namespace App\Base\Filters\Taxi;

use App\Base\Libraries\QueryFilter\FilterContract;
use Carbon\Carbon;

/**
 * Test filter to demonstrate the custom filter usage.
 * Delete later.
 */
class DriverFilter implements FilterContract {
	/**
	 * The available filters.
	 *
	 * @return array
	 */
	public function filters() {
		return [
			'active','approve','available','date_option','vehicle_type'
		];
	}

	public function active($builder, $value = 0) {
		$builder->where('active', $value);
    }
    
	public function approve($builder, $value = 0) {
		$builder->where('approve', $value);
    }
    
	public function available($builder, $value = 0) {
		$builder->where('available', $value);
	}

	public function date_option($builder, $value = 0) {
		$today = now();
		$to = now()->endOfDay()->toDateTimeString();

        if($value == 'today'){
            $from = $today->toDateTimeString();
        }elseif($value == 'week'){
            $from = $today->startOfWeek()->toDateTimeString();
        }elseif($value == 'month'){
            $from = $today->startOfMonth()->toDateTimeString();
        }elseif($value == 'year'){
            $from = $today->startOfYear()->toDateTimeString();
		}else{
			$date = explode('<>', $value);
			$from = Carbon::parse($date[0])->toDateTimeString();
			$to = Carbon::parse($date[1])->endOfDay()->toDateTimeString();
		}

		$builder->whereBetween('created_at', [$from,$to]);
	}
	
	public function vehicle_type($builder, $value = 0){
		$builder->whereHas('vehicleType' , function($q) use ($value){
			$q->where('id',$value);
		});
	}
}
