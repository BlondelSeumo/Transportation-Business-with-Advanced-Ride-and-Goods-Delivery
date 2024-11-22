<?php

namespace App\Base\Services\PDF\Creator;

use App\Base\Services\Hash\HashGeneratorContract;
use App\Base\Services\PDF\Generator\PDFGeneratorContract;
use Illuminate\Config\Repository as ConfigRepository;

class PDFCreator implements PDFCreatorContract {
	/**
	 * The PDFGenerator instance.
	 *
	 * @var PDFGeneratorContract
	 */
	protected $pdfGenerator;

	/**
	 * The HashGenerator instance.
	 *
	 * @var HashGeneratorContract
	 */
	protected $hashGenerator;

	/**
	 * The default config.
	 *
	 * @var array
	 */
	protected $config;

	/**
	 * PDFCreator constructor.
	 *
	 * @param PDFGeneratorContract $pdfGenerator
	 * @param HashGeneratorContract $hashGenerator
	 * @param ConfigRepository $config
	 */
	public function __construct(PDFGeneratorContract $pdfGenerator, HashGeneratorContract $hashGenerator, ConfigRepository $config) {
		$this->pdfGenerator = $pdfGenerator;
		$this->hashGenerator = $hashGenerator->extension('pdf');
		$this->config = $config;
	}

	// [WIP] Add relevant pdf generator/download methods when needed.

	/**
	 * Get the config value.
	 *
	 * @param string $key
	 * @param mixed|null $default
	 * @return mixed
	 */
	protected function config($key, $default = null) {
		return data_get($this->config, $key, $default);
	}
}
