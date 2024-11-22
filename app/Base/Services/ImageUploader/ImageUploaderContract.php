<?php

namespace App\Base\Services\ImageUploader;

use Illuminate\Http\UploadedFile;

interface ImageUploaderContract
{
    /**
     * Save the user profile picture.
     *
     * @return string Returns the saved filename
     */
    public function saveProfilePicture();

    /**
     * Save the user profile picture.
     *
     * @return string Returns the saved filename
     */
    public function saveDriverProfilePicture();

    /**
     * Save the Vehicle type's Image.
     *
     * @return string Returns the saved filename
     */
    public function saveVehicleTypeImage();
    /**
     * Save the Driver Document's Image.
     *
     * @return string Returns the saved filename
     */
    public function saveDriverDocument($driver_id);

    /**
     * Save the Company's Image.
     *
     * @return string Returns the saved filename
     */
    public function saveCompanyImage($admin_id);

    public function saveSystemAdminLogo();

        /**
     * Save the FireBase Json File.
     *
     * @return string Returns the saved filename
     */

    public function saveSystemFirebaseJson();
    public function saveCountryFlagImage();

    


    public function file(UploadedFile $file);

    /**
     * Set the new image size values.
     *
     * @param int|null $width
     * @param int|null $height
     * @return $this
     */
    public function resize($width = null, $height = null);

    /**
     * Set the encoding quality.
     * Value can be between 10 - 100.
     *
     * @param int $quality
     * @return $this
     */
    public function quality($quality);

    /**
     * Set the image encoding format.
     *
     * @param string $format
     * @return $this
     */
    public function format($format);

    public function saveOwnerDocument($ownerId);

    public function saveFleetRegistrationCertificateImage();
    
    public function saveFleetBackSideImage();

    public function saveBannerImage();
    
    public function OnboardingImage();
}
