<?php

namespace App\Transformers\User;

use Carbon\Carbon;
use App\Models\Admin\ZoneType;
use App\Models\Admin\ZoneSurgePrice;
use League\Fractal\TransformerAbstract;

class ZoneTypePriceTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ZoneType $zone_type)
    {
        $ZoneSurgePrice = ZoneSurgePrice::where('zone_id', $zone_type->zone_id)->get();
        $today = Carbon::now()->dayOfWeek;  // Day of week numeric sun->0 ----- sat->6

        $typePrice = $zone_type->zoneTypePrice()->get();
        $params = [];

        foreach ($typePrice as $k => $price) {
            $params[$k]['id'] = $price->id;
            $params[$k]['type_id'] = $price->zone_type_id;
            $params[$k]['price_type'] = $price->price_type;
            $params[$k]['admin_commission_type'] = get_settings('admin_commission_type')==1?'percentage':'fixed';
            $params[$k]['admin_commission'] = $zone_type->admin_commision;

            $basePrice = $price->base_price;
            $pricePerDistance = $price->price_per_distance;

            foreach ($ZoneSurgePrice as $surge) {
                $startDate = now()->parse($surge->peaktime_start);
                $endDate = now()->parse($surge->peaktime_end);

                if (now()->gte($startDate)  && now()->lte($endDate) && $surge->applied_days) {
                    $pricePerDistance = $price->price_per_distance + (($price->price_per_distance * $surge->value) / 100);
                    break;
                }
            }

            $params[$k]['base_price'] = $basePrice;
            $params[$k]['price_per_distance'] = $pricePerDistance;

            $params[$k]['base_distance'] = $price->base_distance;
            $params[$k]['price_per_time'] = $price->price_per_time;
            $params[$k]['waiting_charge'] = $price->waiting_charge;
            $params[$k]['cancellation_fee'] = $price->cancellation_fee;
        }

        return $params;
    }
}
