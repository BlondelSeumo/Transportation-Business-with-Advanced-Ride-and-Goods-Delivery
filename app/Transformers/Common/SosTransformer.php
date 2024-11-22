<?php

namespace App\Transformers\Common;

use App\Transformers\Transformer;
use App\Models\Admin\Sos;

class SosTransformer extends Transformer {
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
	public function transform(Sos $sos) {
		return [
			'id' => $sos->id,
			'name' => $sos->name,
			'number' => $sos->number,
			'user_type' => $sos->user_type,
			'status' => (bool) $sos->active,
		];
	}

}
