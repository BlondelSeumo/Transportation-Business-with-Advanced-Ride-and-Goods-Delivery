<?php

namespace App\Transformers\Common;

use App\Transformers\Transformer;
use App\Models\Admin\DriverVehicleType;

class DriverVehicleTypeTransformer extends Transformer {
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected array $availableIncludes = [

	];

	/**
	 * A Fractal transformer.
	 *
	 * @return array
	 */
	public function transform(DriverVehicleType $driverVehicleType) {
		return [
			'id' => $driverVehicleType->vehicle_type,
			'driver_id' => $driverVehicleType->driver_id,
			'vehicletype_name' => $driverVehicleType->vehicleType->name,
			'name' => $driverVehicleType->vehicleType->name,
			'icon' => $driverVehicleType->vehicleType->icon,

			
		];
	}

}
