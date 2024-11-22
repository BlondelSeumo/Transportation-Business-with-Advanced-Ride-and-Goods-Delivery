<?php

namespace App\Transformers\Common;

use App\Models\Common\Subscriber;
use App\Transformers\Transformer;

class SubscriberTransformer extends Transformer {
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
	public function transform(Subscriber $subscriber) {
		return [
			'id' => $subscriber->id,
			'name' => $subscriber->name,
			'email' => $subscriber->email,
			'created_at' => $subscriber->converted_created_at->toDateTimeString(),
			'status' => (bool) $subscriber->status,
		];
	}

}
