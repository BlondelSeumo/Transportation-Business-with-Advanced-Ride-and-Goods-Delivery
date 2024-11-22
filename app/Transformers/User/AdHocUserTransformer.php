<?php

namespace App\Transformers\User;

use App\Models\Request\AdHocUser;
use App\Transformers\Transformer;

class AdHocUserTransformer extends Transformer
{
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
    public function transform(AdHocUser $user)
    {
        $params = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'profile_picture' => $user->profile_pic,
            'active' => $user->active,
            'rating' => 0,

        ];
        return $params;
    }
}
