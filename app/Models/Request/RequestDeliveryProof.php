<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RequestDeliveryProof extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_delivery_proofs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','after_load','after_unload','proof_image'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'request'
    ];
    /**
     * The request that the meta belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }

    public function getProofImageAttribute($value){

        if (empty($value)) {
            return null;
        }

        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $value));
    }
    

    public function uploadPath()
    {
        return config('base.request.upload.delivery-proof.path');
    }
}
