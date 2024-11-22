<?php

namespace App\Base\Services\Setting;

use App\Models\Setting;
use Exception;

class DatabaseSetting implements SettingContract {
	/**
	 * The setting model instance.
	 *
	 * @var Setting
	 */
	protected $setting;

	/**
	 * The allowed setting types.
	 *
	 * @var array
	 */
	protected $allowedTypes = ['string', 'boolean', 'decimal'];

	/**
	 * DatabaseSetting constructor.
	 *
	 * @param Setting $setting
	 */
	public function __construct(Setting $setting) {
		$this->setting = $setting;
	}

	/**
	 * Get the database setting value.
	 *
	 * @param string $name
	 * @param mixed|null $default
	 * @return mixed|null
	 */
	public function get($name, $default = null) {
		$result = $this->setting->find($name);

		return is_null($result) ? $default : $result->value;
	}

	/**
	 * Set the database setting.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @param string $type
	 * @return \Illuminate\Database\Eloquent\Model|Setting
	 * @throws Exception
	 */
	public function set($name, $value, $type = 'string') {
		if (!in_array($type, $this->allowedTypes)) {
			throw new Exception('Invalid database setting type.');
		}

		$valueField = $type . '_value';

		return $this->setting->updateOrCreate(
			['name' => $name],
			['type' => $type, $valueField => $value]
		);
	}

	/**
	 * Set the 'string' type database setting.
	 *
	 * @param string $name
	 * @param string $value
	 * @return Setting
	 */
	public function setString($name, $value) {
		return $this->set($name, $value, 'string');
	}

	/**
	 * Set the 'boolean' type database setting.
	 *
	 * @param string $name
	 * @param boolean $value
	 * @return Setting
	 */
	public function setBoolean($name, $value) {
		return $this->set($name, $value, 'boolean');
	}

	/**
	 * Set the 'decimal' type database setting.
	 *
	 * @param string $name
	 * @param int|double $value
	 * @return Setting
	 */
	public function setDecimal($name, $value) {
		return $this->set($name, $value, 'decimal');
	}
}
