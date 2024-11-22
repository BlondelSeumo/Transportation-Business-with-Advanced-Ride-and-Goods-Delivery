<?php

namespace App\Transformers\Common;

use App\Transformers\Transformer;
use App\Models\Master\BannerImage;

class BannerImageTransformer extends Transformer {
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
	public function transform(BannerImage $bannerImage) {
		return [
			'image' => $bannerImage->image,
		];
	}

}
