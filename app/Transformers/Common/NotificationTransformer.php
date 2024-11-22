<?php

namespace App\Transformers\Common;

use Carbon\Carbon;
use App\Transformers\Transformer;
use App\Models\User;
use App\Models\Admin\Notification;
use App\Models\Admin\UserDriverNotification;
use App\Models\Admin\ServiceLocation;

class NotificationTransformer extends Transformer {
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [

    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Notification $notification) {

        $country = auth()->user()->country;

        $timezone = ServiceLocation::where('country',$country)->pluck('timezone')->first()?:env('SYSTEM_DEFAULT_TIMEZONE');

        return [
            'id' => $notification->id,
            'title' => $notification->title,
            'body' => $notification->body,
            'image'=>$notification->push_image,
            'converted_created_at'=>Carbon::parse($notification->created_at)->setTimezone($timezone)->format('jS M h:i A')
        ];
    }

}
