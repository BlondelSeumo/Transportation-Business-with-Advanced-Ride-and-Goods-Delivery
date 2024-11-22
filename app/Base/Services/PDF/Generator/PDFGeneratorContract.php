<?php

namespace App\Base\Services\PDF\Generator;

interface PDFGeneratorContract {
	/**
	 * Load a View with data and convert to HTML for generating PDF.
	 *
	 * @param string $view
	 * @param array $data
	 * @param array $mergeData
	 * @param string|null $encoding
	 * @return $this
	 */
	public function make($view, $data = [], $mergeData = [], $encoding = null);

	/**
	 * Save the generated PDF to a file.
	 * Needs the full path relative to the filesystem disk used.
	 *
	 * @param string $filename
	 * @return $this
	 */
	public function save($filename);

	/**
	 * Download the generated PDF file.
	 * Requires the name for the downloaded file.
	 *
	 * @param string $filename
	 * @return \Illuminate\Http\Response
	 */
	public function download($filename);

	/**
	 * Return a response to make the PDF viewable in the browser without downloading.
	 *
	 * @param string $filename
	 * @return \Illuminate\Http\Response
	 */
	public function stream($filename);
}
