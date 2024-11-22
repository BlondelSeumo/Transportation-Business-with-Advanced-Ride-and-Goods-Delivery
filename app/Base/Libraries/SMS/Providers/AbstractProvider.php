<?php

namespace App\Base\Libraries\SMS\Providers;

use App\Base\Libraries\SMS\Exceptions\SMSFailException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class AbstractProvider {
	/**
	 * Make a GET http request to the url.
	 *
	 * @param string $url
	 * @param array $query
	 * @param array $headers
	 * @return array|null
	 */
	public function makeGetRequest($url, $query = [], $headers = []) {
		return $this->makeHttpRequest('GET', $url, compact('query', 'headers'));
	}

	/**
	 * Make a POST http request to the url.
	 *
	 * @param string $url
	 * @param array $form_params
	 * @param array $headers
	 * @return array|null
	 */
	public function makePostRequest($url, $form_params = [], $headers = []) {
		return $this->makeHttpRequest('POST', $url, compact('form_params', 'headers'));
	}

	/**
	 * Make a http request to the url.
	 *
	 * @param string $method
	 * @param string $url
	 * @param array $options
	 * @return array|null
	 * @throws SMSFailException
	 */
	public function makeHttpRequest($method, $url, array $options = []) {
		$client = new Client();

		try {
			$response = $client->request($method, $url, $options);
		} catch (TransferException $exception) {
			throw new SMSFailException($exception->getMessage());
		}

		return json_decode($response->getBody(), true);
	}

	/**
	 * Check if the url is valid format.
	 *
	 * @param string $url
	 * @return bool
	 */
	protected function isValidUrl($url) {
		return filter_var($url, FILTER_VALIDATE_URL) !== false;
	}
}
