<?php

namespace App\Transformers;

use App\Models\Admin\ServiceLocation;

class ServiceLocationTransformer extends Transformer {
	/**
	 * A Fractal transformer.
	 *
	 * @param ServiceLocation $serviceLocation
	 * @return array
	 */
	public function transform(ServiceLocation $serviceLocation) {
		return [
			'id' => $serviceLocation->id,
			'name' => $serviceLocation->name,
			'currency_name' => $serviceLocation->currency_name,
			'currency_symbol' => $serviceLocation->currency_symbol,
			'currency_code' => $serviceLocation->currency_code,
			'timezone' => $serviceLocation->timezone,
			'active' => $serviceLocation->active,
		];
	}
}
