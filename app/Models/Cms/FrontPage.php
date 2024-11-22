<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FrontPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'landingpagecms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid', 'faviconfile', 'bannerimage', 'description','playstoreicon1','playstoreicon2','firstrowimage1','firstrowheadtext1','firstrowsubtext1','firstrowimage2','firstrowheadtext2','firstrowsubtext2','firstrowimage3','firstrowheadtext3','firstrowsubtext3','secondrowimage1','secondrowheadtext1','secondrowimage2','secondrowheadtext2','secondrowimage3','secondrowheadtext3','footertextsub','footercopytextsub','safety','safetytext','serviceheadtext','servicesubtext','serviceimage','privacy','dmv','complaince','terms','web_booking_logo','web_booking_taxi','web_booking_rental','web_booking_delivery','web_booking_history'
    ];

    /**
    * Get the Profile image full file path.
    *
    * @param string $value
    * @return string
    */
    // public function getProfilePictureAttribute($value)
    // {
    //     if (empty($value)) {
    //         $default_image_path = config('base.default.user.profile_picture');
    //         return env('APP_URL').$default_image_path;
    //     }
    //     return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $value));
    // }


    public function getFavIconPictureAttribute($value)
    {

        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $value));
    }
    // public function getWebBookingLogoAttribute(){
    //     if (!$this->web_booking_logo) {
    //         return null;
    //     }
        // return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $this->web_booking_logo));
    // }

       /**
     * The default file upload path.
     *
     * @return string|null
     */
    public function uploadPath()
    {
        return config('base.cms.upload.web-picture.path');
    }



}
