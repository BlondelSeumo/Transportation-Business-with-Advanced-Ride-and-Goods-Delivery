<?php

namespace App\Base\Filters\Master;

use App\Base\Libraries\QueryFilter\FilterContract;

/**
 * Test filter to demonstrate the custom filter usage.
 * Delete later.
 */
class CommonMasterFilter implements FilterContract
{
    /**
     * The available filters.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name',
        ];
    }

    /**
    * Default column to sort.
    *
    * @return string
    */
    public function defaultSort()
    {
        return '-created_at';
    }
    
    /**
     * Just a name method to demonstrate the filter usage.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $value
     */
    public function name($builder, $value = null)
    {
        $builder->where('name', $value);
    }
}
