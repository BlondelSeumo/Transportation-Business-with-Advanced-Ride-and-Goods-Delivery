<?php

namespace App\Http\Controllers\Api\V1\Request;

use App\Models\Admin\Promo;
use App\Http\Controllers\Api\V1\BaseController;
use App\Transformers\Requests\PromoCodesTransformer;
use Carbon\Carbon;

/**
 * @group User-trips-apis
 *
 * APIs for User-trips apis
 */
class PromoCodeController extends BaseController
{
    protected $promocode;

    public function __construct(Promo $promocode)
    {
        $this->promocode = $promocode;
    }

    /**
    * List Promo codes for user
    * @responseFile responses/user/trips/promocode-list.json
    */
    public function index()
    {
        $zone_detail = find_zone(request()->input('pick_lat'), request()->input('pick_lng'));

        $current_date = Carbon::today()->toDateTimeString();

        $query = $this->promocode->where('from', '<=', $current_date)->where('to', '>=', $current_date)->get();//->where('service_location_id', $zone_detail->service_location_id)

        $result = fractal($query, new PromoCodesTransformer);

        return $this->respondSuccess($result, 'promo_listed');
    }
}
