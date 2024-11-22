<?php

namespace App\Base\Services\Hash;

interface HashGeneratorContract {
	/**
	 * Generate the hash.
	 *
	 * @param int|null $length
	 * @param string|null $prefix
	 * @param string|null $suffix
	 * @param string|null $extension
	 * @return string
	 */
	public function make($length = null, $prefix = null, $suffix = null, $extension = null);

	/**
	 * Set the hash length.
	 *
	 * @param int $length
	 * @return $this
	 */
	public function length($length);

	/**
	 * Set the hash prefix.
	 *
	 * @param string $prefix
	 * @return $this
	 */
	public function prefix($prefix);

	/**
	 * Set the hash suffix.
	 *
	 * @param string $suffix
	 * @return $this
	 */
	public function suffix($suffix);

	/**
	 * Set the hash extension.
	 *
	 * @param string $extension
	 * @return $this
	 */
	public function extension($extension);
}
