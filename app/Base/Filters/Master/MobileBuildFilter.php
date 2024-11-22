<?php

namespace App\Base\Filters\Master;

use App\Base\Libraries\QueryFilter\FilterContract;

/**
 * Test filter to demonstrate the custom filter usage.
 * Delete later.
 */
class MobileBuildFilter implements FilterContract
{
    /**
     * The available filters.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'team',
        ];
    }

    /**
     * Just a team method to demonstrate the filter usage.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $value
     */
    public function team($builder, $value = null)
    {
        $builder->where('team', $value);
    }
}
