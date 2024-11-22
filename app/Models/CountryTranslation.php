<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActive;

class CountryTranslation extends Model
{
     use HasActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country_translation';

    protected $fillable = ['country_id','name','locale'];

     public function CountryDetail()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
      public function language()
    {
        return $this->belongsTo(Language::class, 'code', 'locale');
    }
}

