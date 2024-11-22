<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait to auto set the IP Address when creating a model object.
 * Override the default 'ip' attribute name with the 'ipAttributeName' property.
 *
 * @package App\Models\Traits
 */
trait AutoSetIP
{
    /**
     * Binds creating event to auto insert the request IP address.
     *
     * @return void
     */
    public static function bootAutoSetIP()
    {
        static::creating(function (Model $model) {
            $model->setAttribute($model->ipAttributeName ?? 'ip', ip());
        });
    }
}
