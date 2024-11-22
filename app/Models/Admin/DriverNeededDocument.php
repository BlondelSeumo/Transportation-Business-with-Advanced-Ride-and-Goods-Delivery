<?php

namespace App\Models\Admin;

use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class DriverNeededDocument extends Model
{
    use HasActive;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_needed_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'doc_type', 'has_identify_number','has_expiry_date','active','identify_number_locale_key','account_type',
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'driverDocument'
    ];

    /**
     * The Driver Document associated with the driver needed document's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function driverDocument()
    {
        return $this->hasOne(DriverDocument::class, 'document_id', 'id');
    }
}
