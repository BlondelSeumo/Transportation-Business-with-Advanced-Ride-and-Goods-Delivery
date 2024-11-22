<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;

class RequestBill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_bills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id','base_price','base_distance','price_per_distance','distance_price','price_per_time','time_price','waiting_charge','cancellation_fee','service_tax','service_tax_percentage','promo_discount','admin_commision','driver_commision','total_amount','requested_currency_code','admin_commision_with_tax','total_distance','total_time','requested_currency_symbol','airport_surge_fee','before_trip_start_waiting_time','after_trip_start_waiting_time','calculated_waiting_time','waiting_charge_per_min','admin_commision_from_driver'
];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [

    ];
    public function requestDetail()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }
    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
