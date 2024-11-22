<?php

namespace App\Helpers\Rides;

use Kreait\Firebase\Contract\Database;
use Sk\Geohash\Geohash;
use Carbon\Carbon;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\DB;
use App\Models\Request\Request;
use Illuminate\Support\Facades\Log;
use App\Base\Constants\Setting\Settings;
use App\Models\Admin\Driver;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\Request\DriverRejectedRequest;
use App\Models\Request\RequestCycles;
use App\Jobs\NoDriverFoundNotifyJob;
use App\Models\Admin\ZoneSurgePrice;
use App\Models\Request\RequestCancellationFee;
use App\Models\Admin\PromoUser;

trait CalculatAdminCommissionAndTaxHelper
{



    /**
     * Calculate Ride fare
     * pick lat,pick lng, drop lat, drop lng should be double
     * total_distance can be double
     * duration should be in integer and in mins
     * 
     */
    //
    protected function calculateAdminCommissionAndTax($sub_total,$zone_type,$request_detail)
    {

        $is_round = (integer)get_settings('can_round_the_bill_values');

        
        // Convenience fee for customer
        $admin_commision_type = $zone_type->admin_commision_type;

        $service_fee = $zone_type->admin_commision;
        
        if($admin_commision_type==1){
            
            $admin_commision = ($sub_total * ($service_fee / 100));

        }else{

            $admin_commision = $service_fee;

        }

        // Calculate Tax for sub total
        $tax_percent = $zone_type->service_tax;
        $tax_amount = ($sub_total * ($tax_percent / 100));

        if($is_round){

            $tax_amount = ceil($tax_amount);
            $admin_commision = ceil($admin_commision);

        }

         if($request_detail && $request_detail->is_bid_ride){

                $sub_total -=$admin_commision;

                $sub_total -=$tax_amount;

        }

       return $result = [
            'admin_commision'=>$admin_commision,
            'tax_amount'=>$tax_amount,
            'sub_total'=>$sub_total,
            'tax_percent'=>$tax_percent
        ];

    }

    
}
