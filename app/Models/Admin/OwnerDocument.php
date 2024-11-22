<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class OwnerDocument extends Model
{
    use HasActive, UuidModel,SoftDeletes;

    protected $table = 'owner_documents';

    protected $fillable = [
        'owner_id', 'document_id', 'image','identify_number','expiry_date','document_status','comment'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }

    public function ownerNeededDocuments()
    {
        return $this->belongsTo(OwnerNeededDocument::class, 'document_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $value));
    }

    public function uploadPath()
    {
        if (!$this->owner()->exists()) {
            return null;
        }
        return folder_merge(config('base.owner.upload.documents.path'), $this->owner->id);
    }

    public function getExpiryDateAttribute($value)
    {
        if ($value==null) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($value)->setTimezone($timezone)->format('Y-m-d');
    }
}
