<?php

namespace App\Base\Services\PDF\Generator;

use Exception;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Filesystem\Filesystem;

class PDFGenerator implements PDFGeneratorContract {
	/**
	 * The DomPDF instance.
	 *
	 * @var \Barryvdh\DomPDF\PDF
	 */
	protected $dompdf;

	/**
	 * The filesystem instance.
	 *
	 * @var Filesystem
	 */
	protected $files;

	/**
	 * PDFGenerator constructor.
	 *
	 * @param ConfigRepository $config
	 * @param Filesystem $files
	 * @throws Exception
	 */
	public function __construct(ConfigRepository $config, Filesystem $files) {
		$generator = data_get($config, 'Base.pdf.generator', 'dompdf.wrapper');

		if (!app()->bound($generator)) {
			throw new Exception('The PDF package is not installed.');
		}

		$this->dompdf = app($generator);

		$this->files = $files;
	}

	/**
	 * Load a View with data and convert to HTML for generating PDF.
	 *
	 * @param string $view
	 * @param array $data
	 * @param array $mergeData
	 * @param string|null $encoding
	 * @return $this
	 */
	public function make($view, $data = [], $mergeData = [], $encoding = null) {
		$this->dompdf = $this->dompdf->loadView($view, $data, $mergeData, $encoding);

		return $this;
	}

	/**
	 * Save the generated PDF to a file.
	 * Needs the full path relative to the filesystem disk used.
	 *
	 * @param string $filename
	 * @return $this
	 */
	public function save($filename) {
		$this->files->put($filename, $this->dompdf->output());

		return $this;
	}

	/**
	 * Download the generated PDF file.
	 * Requires the name for the downloaded file.
	 *
	 * @param string $filename
	 * @return \Illuminate\Http\Response
	 */
	public function download($filename) {
		return $this->dompdf->download($filename);
	}

	/**
	 * Return a response to make the PDF viewable in the browser without downloading.
	 *
	 * @param string $filename
	 * @return \Illuminate\Http\Response
	 */
	public function stream($filename) {
		return $this->dompdf->stream($filename);
	}
}
