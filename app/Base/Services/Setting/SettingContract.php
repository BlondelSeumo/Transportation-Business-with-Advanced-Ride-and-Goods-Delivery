<?php

namespace App\Base\Services\Setting;

interface SettingContract {
	/**
	 * Get the database setting value.
	 *
	 * @param string $name
	 * @param mixed|null $default
	 * @return mixed|null
	 */
	public function get($name, $default = null);

	/**
	 * Set the database setting.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @param string $type
	 * @return \App\Models\Setting
	 * @throws \Exception
	 */
	public function set($name, $value, $type = 'string');
	/**
	 * Set the 'string' type database setting.
	 *
	 * @param string $name
	 * @param string $value
	 * @return \App\Models\Setting
	 */
	public function setString($name, $value);

	/**
	 * Set the 'boolean' type database setting.
	 *
	 * @param string $name
	 * @param boolean $value
	 * @return \App\Models\Setting
	 */
	public function setBoolean($name, $value);

	/**
	 * Set the 'decimal' type database setting.
	 *
	 * @param string $name
	 * @param int|double $value
	 * @return \App\Models\Setting
	 */
	public function setDecimal($name, $value);
}
