<?php

namespace App\Transformers;

use App\Models\TimeZone;

class TimezoneTransformer extends Transformer {
	/**
	 * A Fractal transformer.
	 *
	 * @param TimeZone $timezone
	 * @return array
	 */
	public function transform(TimeZone $timezone) {
		return [
			'id' => $timezone->id,
			'name' => $timezone->name,
			'abbr' => $timezone->abbr,
			'offset' => $timezone->offset,
			'isdst' => $timezone->isdst,
			'text' => $timezone->text,
			'utc' => $timezone->utc,
		];
	}
}
