<?php

namespace App\Models\Admin;

use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class OwnerNeededDocument extends Model
{
    use HasActive;

    protected $table = 'owner_needed_documents';

    protected $fillable = [
        'name', 'doc_type', 'has_identify_number','has_expiry_date','active','identify_number_locale_key'
    ];

    public function ownerDocument()
    {
        return $this->hasOne(OwnerDocument::class, 'document_id', 'id');
    }
}
