<?php

namespace App\Models\Traits;

trait HasActive
{
    /**
     * Scope a query to add the active condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope a query to add the inactive condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * Check if active.
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool) $this->active;
    }
}
