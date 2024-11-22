<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * The allowed mime types for image uploads.
     * Generates the 'mimes' rule string.
     *
     * @return string
     */
    protected function allowedImages()
    {
        $mimeTypes = $this->config('uploads.image.allowed_mime', ['jpeg', 'png']);

        return 'mimes:' . implode(',', $mimeTypes);
    }

    /**
     * User profile picture file upload rule.
     *
     * @return string
     */
    protected function userProfilePictureRule()
    {
        $minResolution = $this->config('user.upload.profile-picture.image.min_resolution', 100);

        $maxFileSizeKb = $this->config('user.upload.profile-picture.image.max_file_size_kb', 500);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }
    /**
     * Driver Document file upload rule.
     *
     * @return string
     */
    protected function driverDocumentRule()
    {
        $minResolution = $this->config('driver.upload.documents.image.min_resolution', 100);

        $maxFileSizeKb = $this->config('driver.upload.documents.image.max_file_size_kb', 500);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * Request Delivery Document file upload rule.
     *
     * @return string
     */
    protected function requestDeliveryProofRule()
    {
        $minResolution = $this->config('request.upload.delivery-proof.image.min_resolution', 100);

        $maxFileSizeKb = $this->config('request.upload.delivery-proof.image.max_file_size_kb', 500);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }
    

    /**
     * VehicleType Image file upload rule.
     *
     * @return string
     */
    protected function companyImageRule()
    {
        $minResolution = $this->config('company.upload.images.image.min_resolution', 100);

        $maxFileSizeKb = $this->config('company.upload.images.image.max_file_size_kb', 500);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * VehicleType Image file upload rule.
     *
     * @return string
     */
    protected function vechicleTypeImageRule()
    {
        $minResolution = $this->config('types.upload.images.image.min_resolution', 100);

        $maxFileSizeKb = $this->config('types.upload.images.image.max_file_size_kb', 500);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * Get the config value.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    protected function config($key, $default = null)
    {
        return data_get(config('base'), $key, $default);
    }
}
