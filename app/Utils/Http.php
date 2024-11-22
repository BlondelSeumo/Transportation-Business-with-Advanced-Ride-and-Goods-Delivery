<?php

namespace App\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

/**
 * Class Http
 *
 * @package App\Utils
 */
class Http
{
    /**
     * @var array
     */
    private $queryString;

    /**
     * @var array
     */
    private $postBody;

    /**
     * @var array
     */
    private $jsonBody;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var string
     */
    private $url;

    /**
     * Http constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client    = $client;
    }

    /**
     * HTTP Get Request.
     *
     * @param       $url
     * @param array $params
     * @param array $header
     *
     * @return array
     */
    public function get($url, $params = [], $header = [])
    {
        return $this->setHeaders($header)->setQueryString($params)->sendRequest($url);
    }

    /**
     * HTTP Post Request.
     *
     * @param       $url
     * @param array $params
     * @param array $header
     *
     * @return array
     */
    public function post($url, $params = [], $header = [])
    {
        return $this->setHeaders($header)->setRequestBody($params)->sendRequest($url, 'POST');
    }

    /**
     * HTTP Put Request.
     *
     * @param       $url
     * @param array $params
     * @param array $header
     *
     * @return array
     */
    public function put($url, $params = [], $header = [])
    {
        return $this->setHeaders($header)->setRequestBody($params)->sendRequest($url, 'PUT');
    }

    /**
     * HTTP Delete Request.
     *
     * @param       $url
     * @param array $params
     * @param array $header
     *
     * @return array
     */
    public function delete($url, $params = [], $header = [])
    {
        return $this->setHeaders($header)->setRequestBody($params)->sendRequest($url, 'DELETE');
    }

    /**
     * Send the HTTP Request.
     *
     * @param        $url
     * @param string $method
     *
     * @return array
     */
    private function sendRequest($url, $method = 'GET')
    {
        return $this->setUrl($url)->makeRequest($method);
    }

    /**
     * Make Http Request.
     *
     * @param $method
     *
     * @return array
     * @throws \Exception
     */
    private function makeRequest($method)
    {
        $response   = ['code' => 200, 'response' => null];

        try {
            $request    = $this->client->request($method, $this->url, [
                'query'         => $this->getQueryString(),
                'form_params'   => $this->getPostBody(),
                'json'          => $this->getJsonBody(),
                'headers'       => $this->headers
            ]);

            $response['response']    = json_decode($request->getBody(), true);
        } catch (BadResponseException $e) {
            $response    = [
                'code'        => $e->getResponse()->getStatusCode(),
                'response'    => json_decode($e->getResponse()->getBody(), true)
            ];
        } catch (\Exception $e) {
            throw new \Exception($e);
        }

        return $response;
    }

    /**
     * @param string $url
     *
     * @return Http
     */
    private function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param array $headers
     *
     * @return Http
     */
    private function setHeaders($headers = [])
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Check for content type application json.
     *
     * @return bool
     */
    private function hasApplicationJsonContent()
    {
        return data_get($this->headers, 'Content-Type') == 'application/json';
    }

    /**
     * Get Body Params.
     *
     * @param array $params
     *
     * @return Http
     */
    private function setRequestBody($params = [])
    {
        if ($this->hasApplicationJsonContent()) {
            return $this->setJsonBody($params);
        }

        return $this->setPostBody($params);
    }

    /**
     * @return mixed
     */
    private function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * @param $queryString
     *
     * @return Http
     */
    private function setQueryString($queryString = [])
    {
        $this->queryString = $queryString;

        return $this;
    }

    /**
     * @return mixed
     */
    private function getPostBody()
    {
        return $this->postBody;
    }

    /**
     * @param $postBody
     *
     * @return Http
     */
    private function setPostBody($postBody = [])
    {
        $this->postBody = $postBody;

        return $this;
    }

    /**
     * @return mixed
     */
    private function getJsonBody()
    {
        return $this->jsonBody;
    }

    /**
     * @param array $jsonBody
     *
     * @return Http
     */
    private function setJsonBody($jsonBody = [])
    {
        $this->jsonBody = $jsonBody;

        return $this;
    }
}
