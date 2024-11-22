<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;

class RequestStop extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_stops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','address','latitude','longitude','poc_name','poc_mobile','order','poc_instruction', 'completed_at'];

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
}
