<?php

namespace App\Models\Admin;

use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoneSurgePrice extends Model
{
    use HasActive;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zone_surge_prices';

    protected $fillable = [
        'zone_id','start_time','end_time','value','day'
    ];

    public function getFromAttribute(){
        return now()->parse($this->start_time)->format('h:i a');
    }

    public function getToAttribute(){
        return now()->parse($this->end_time)->format('h:i a');
    }
}
