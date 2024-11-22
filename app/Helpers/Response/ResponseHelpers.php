<?php

namespace App\Helpers\Response;

use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Support\Arrayable;
use Spatie\Fractal\Fractal;

trait ResponseHelpers
{
    /**
     * Success status of the response.
     *
     * @var bool
     */
    protected $success = false;

    /**
     * Respond with http ok.
     * Status code = 200
     *
     * @param bool $success
     * @param mixed|null $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondOk($data = null, $success = true, $message = null)
    {
        $this->success = $success;

        return $this->respond($data, $message, Response::HTTP_OK);
    }

    /**
     * Respond with success.
     * Status code = 200
     *
     * @param mixed|null $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondSuccess($data = null, $message = 'success')
    {
        $this->success = true;

        return $this->respond($data, $message, Response::HTTP_OK);
    }

    /**
     * Respond with created.
     * Status code = 201
     *
     * @param mixed $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($data = null, $message = 'created')
    {
        $this->success = true;

        return $this->respond($data, $message, Response::HTTP_CREATED);
    }

    /**
     * Respond with no content.
     * Status code = 204
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNoContent()
    {
        $this->success = true;

        return $this->respond(null, null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Respond with failed.
     * Status code = 200
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondFailed($message = 'failed')
    {
        return $this->respondError($message, Response::HTTP_OK);
    }

    /**
     * Respond with bad request.
     * Status code = 400
     *
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondBadRequest($message = null)
    {

        return $this->respondError($message, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Respond with unauthorized.
     * Status code = 401
     *
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = null)
    {
        return $this->respondError($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Respond with forbidden.
     * Status code = 403
     *
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = null)
    {
        return $this->respondError($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Respond with not found.
     * Status code = 404
     *
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNotFound($message = null)
    {
        return $this->respondError($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * Respond with method not allowed.
     * Status code = 405
     *
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondMethodNotAllowed($message = null)
    {
        return $this->respondError($message, Response::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * Respond with internal server error.
     * Status code = 500
     *
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondInternalError($message = null)
    {
        return $this->respondError($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Return an error JSON response with the custom data format.
     *
     * @param string $message
     * @param int $status
     * @param mixed|null $errors
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondError($message, $status, $errors = null, array $headers = [], $options = 0)
    {

        return $this->jsonResponse(
            $this->formatErrorResponseData($message, $status, $errors),
            $status,
            $headers,
            $options
        );
    }

    /**
     * Return a JSON response with the custom data format.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($data, $message = null, $status = Response::HTTP_OK, array $headers = [], $options = 0)
    {
        return $this->jsonResponse(
            $this->formatResponseData($data, $message),
            $status,
            $headers,
            $options
        );
    }

    /**
     * Return a JSON response.
     *
     * @param string|array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($data = [], $status = Response::HTTP_OK, array $headers = [], $options = 0)
    {
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Merge the various data into the standard response format.
     *
     * @param mixed $data
     * @param string|null $message
     * @return array
     */
    protected function formatResponseData($data, $message = null)
    {
        $success = $this->success;

        if ($data instanceof Fractal) {
            $data = $data->toArray();
        }

        if (!(is_array($data) && array_key_exists('data', $data))) {
            if ($data instanceof Arrayable) {
                $data = $data->toArray();
            }

            $data = compact('data');
        }

        return array_filter(array_merge(compact('success', 'message'), $data), function ($value) {
            return !is_null($value);
        });
    }

    /**
     * Merge the various data into the standard error response format.
     *
     * @param string $message
     * @param int $status_code
     * @param mixed|null $errors
     * @return array
     */
    private function formatErrorResponseData($message, $status_code, $errors = null)
    {

        $success = $this->success;

        if (!$message && $status_code) {
            $message = Response::$statusTexts[$status_code];
        }

        if ($errors instanceof MessageBag) {
            $errors = $errors->getMessages();
        }
        return array_filter(compact('success', 'message', 'status_code', 'errors'), function ($value) {
            return !is_null($value);
        });
    }
}
