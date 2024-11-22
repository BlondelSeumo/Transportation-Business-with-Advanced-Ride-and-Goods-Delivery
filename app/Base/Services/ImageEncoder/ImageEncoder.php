<?php

namespace App\Base\Services\ImageEncoder;

use Intervention\Image\ImageManager;

class ImageEncoder implements ImageEncoderContract {
	/**
	 * The ImageManager instance.
	 *
	 * @var \Intervention\Image\ImageManager
	 */
	protected $image;

	/**
	 * New image width.
	 *
	 * @var int|null
	 */
	protected $resizeWidth = null;

	/**
	 * New image height.
	 *
	 * @var int|null
	 */
	protected $resizeHeight = null;

	/**
	 * Image encoding format.
	 *
	 * @var string
	 */
	protected $format = 'jpg';

	/**
	 * Image encoding quality.
	 *
	 * @var int
	 */
	protected $quality = 100;

	/**
	 * ImageEncoder constructor.
	 *
	 * @param \Intervention\Image\ImageManager $image
	 */
	public function __construct(ImageManager $image) {
		$this->image = $image;
	}

	/**
	 * Encode the image and return the resource handle.
	 *
	 * @param mixed $file
	 * @param bool $autoScale
	 * @return \Intervention\Image\Image
	 */
	public function encode($file, $autoScale = true) {
		$uploadedImage = $this->image->make($file);

		$ratio = $uploadedImage->width() / $uploadedImage->height();

		if ($this->resizeWidth && $this->resizeHeight) {
			$uploadedImage->resize($this->resizeWidth, $this->resizeHeight);
		} elseif ($this->resizeWidth) {
			$width = ($ratio > 1 && $autoScale) ? (int) ($this->resizeWidth * $ratio) : $this->resizeWidth;
			$uploadedImage->widen($width, function ($constraint) {
				$constraint->upsize();
			});
		} elseif ($this->resizeHeight) {
			$height = ($ratio < 1 && $autoScale) ? (int) ($this->resizeHeight / $ratio) : $this->resizeHeight;
			$uploadedImage->heighten($height, function ($constraint) {
				$constraint->upsize();
			});
		}

		return $uploadedImage->encode($this->format, $this->quality);
	}

	/**
	 * Set the new image size values.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 * @return $this
	 */
	public function resize($width = null, $height = null) {
		$this->resizeWidth = $width;
		$this->resizeHeight = $height;

		return $this;
	}

	/**
	 * Set the encoding quality.
	 * Value can be between 10 - 100.
	 *
	 * @param int $quality
	 * @return $this
	 */
	public function quality($quality) {
		$this->quality = limit_value($quality, 10, 100);

		return $this;
	}

	/**
	 * Set the image encoding format.
	 *
	 * @param string $format
	 * @return $this
	 */
	public function format($format) {
		$this->format = $format;

		return $this;
	}
}
