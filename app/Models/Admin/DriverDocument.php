<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Base\Uuid\UuidModel;
use App\Models\Admin\Driver;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverDocument extends Model
{
    use HasActive, UuidModel,SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'driver_id', 'document_id', 'image','identify_number','expiry_date','document_status','comment'
    ];
    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = [
        'document_name','identify_number_key'
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'driver'
    ];

    /**
     * The driver that the uploaded image belongs to.
     * @tested
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
    /**
     * Get the Document's full file path.
     *
     * @param string $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $value));
    }
    /**
    * Get the Document's name.
    *
    * @param string $value
    * @return string
    */
    public function getDocumentNameAttribute()
    {
        if (!$this->driverNeededDocuments()->exists()) {
            return null;
        }
        return $this->driverNeededDocuments->name;
    }
    /**
    * Get the is_identify_number_exists.
    *
    * @param string $value
    * @return string
    */
    public function getIdentifyNumberKeyAttribute()
    {
        if (!$this->driverNeededDocuments()->exists()) {
            return null;
        }
        return $this->driverNeededDocuments->identify_number_locale_key;
    }
    /**
    * The Document that the DriverNeededDocuments belongs to.
    * @tested
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function driverNeededDocuments()
    {
        return $this->belongsTo(DriverNeededDocument::class, 'document_id', 'id');
    }

    /**
     * The default file upload path.
     *
     * @return string|null
     */
    public function uploadPath()
    {
        if (!$this->driver()->exists()) {
            return null;
        }
        return folder_merge(config('base.driver.upload.documents.path'), $this->driver->id);
    }
    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedCreatedAtAttribute()
    {
        if ($this->created_at==null||!auth()->user()->exists()) {
            return null;
        }
        if(auth()->user()->exists()){
            $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        }else{
            $timezone = env('SYSTEM_DEFAULT_TIMEZONE');
        }
        return Carbon::parse($this->created_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedUpdatedAtAttribute()
    {
        if ($this->updated_at==null||!auth()->user()->exists()) {
            return null;
        }
       if(auth()->user()->exists()){
            $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        }else{
            $timezone = env('SYSTEM_DEFAULT_TIMEZONE');
        }
        return Carbon::parse($this->updated_at)->setTimezone($timezone)->format('jS M h:i A');
    }

    public function getExpiryDateAttribute($value)
    {
        if ($value==null) {
            return null;
        }
        // if(auth()->user()->exists()){
        //     $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        // }else{
        //     $timezone = env('SYSTEM_DEFAULT_TIMEZONE');
        // }

            $timezone = env('SYSTEM_DEFAULT_TIMEZONE');

        return Carbon::parse($value)->setTimezone($timezone)->format('Y-m-d');
    }
}
