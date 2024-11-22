<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Admin\Faq;
use App\Base\Constants\Auth\Role;
use App\Transformers\Common\FaqTransformer;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group FAQ
 *
 * APIs for faq lists for user & driver
 */
class FaqController extends BaseController
{
    protected $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    /**
    * List Faq
    * @urlParam lat required double  latitude provided by user
    * @urlParam lng required double  longitude provided by user
    * @responseFile responses/common/faq.json
    */
    public function index($lat, $lng)
    {
        if (access()->hasRole(Role::USER)) {
            $user_type = 'user';
        }else if (access()->hasRole(Role::DRIVER)) {
            $user_type = 'driver';
        } else {
            $user_type = 'owner';
        }
        
        $query = $this->faq->where(function($query)use($user_type){
            $query->where('user_type', $user_type)->orWhere('user_type', 'all');
        });

        $result=filter($query, new FaqTransformer)->paginate();

        return $this->respondSuccess($result);
    }
}
