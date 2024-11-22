<?php

namespace App\Base\Services\ImageEncoder;

interface ImageEncoderContract {
	/**
	 * Encode the image and return the resource handle.
	 *
	 * @param mixed $file
	 * @param bool $autoScale
	 * @return \Intervention\Image\Image
	 */
	public function encode($file, $autoScale = true);

	/**
	 * Set the new image size values.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 * @return $this
	 */
	public function resize($width = null, $height = null);

	/**
	 * Set the encoding quality.
	 * Value can be between 10 - 100.
	 *
	 * @param int $quality
	 * @return $this
	 */
	public function quality($quality);

	/**
	 * Set the image encoding format.
	 *
	 * @param string $format
	 * @return $this
	 */
	public function format($format);
}
