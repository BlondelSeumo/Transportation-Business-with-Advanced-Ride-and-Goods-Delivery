<?php

namespace App\Models\Admin;

use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class FleetNeededDocument extends Model
{
    use HasActive;

    protected $table = 'fleet_needed_documents';

    protected $fillable = [
        'name', 'doc_type', 'has_identify_number','has_expiry_date','active','identify_number_locale_key'
    ];

    public function fleetDocument()
    {
        return $this->hasOne(FleetDocument::class, 'document_id', 'id');
    }
}
