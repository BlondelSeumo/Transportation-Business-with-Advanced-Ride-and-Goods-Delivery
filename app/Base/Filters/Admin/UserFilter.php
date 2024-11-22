<?php

namespace App\Base\Filters\Admin;

use App\Base\Libraries\QueryFilter\FilterContract;
use Carbon\Carbon;

/**
 * Test filter to demonstrate the custom filter usage.
 * Delete later.
 */
class UserFilter implements FilterContract {
	/**
	 * The available filters.
	 *
	 * @return array
	 */
	public function filters() {
		return [
			'status','date_option'
		];
	}

	public function status($builder, $value = 0) {
		$builder->where('active', $value);
    }
    
	public function date_option($builder, $value = 0) {
		$today = now();
		$to = now()->toDateTimeString();

        if($value == 'today'){
            $from = $today->toDateTimeString();
        }elseif($value == 'week'){
            $from = $today->subWeek()->toDateTimeString();
        }elseif($value == 'month'){
            $from = $today->subMonth()->toDateTimeString();
        }elseif($value == 'year'){
            $from = $today->subYear()->toDateTimeString();
		}else{
			$date = explode('<>', $value);
			$from = Carbon::parse($date[0])->format('Y-m-d');
			$to = Carbon::parse($date[1])->format('Y-m-d');
		}

		$builder->whereBetween('created_at', [$from,$to]);
    }
}
