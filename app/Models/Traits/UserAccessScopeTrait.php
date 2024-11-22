<?php

namespace App\Models\Traits;

trait UserAccessScopeTrait
{
    /**
     * Scope a query to check if the user belongs to the role using its name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $roleSlugs
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBelongsToRole($query, ...$roleSlugs)
    {
        if (is_array($roleSlugs[0])) {
            $roleSlugs = $roleSlugs[0];
        }

        return $query->whereHas('roles', function ($query) use ($roleSlugs) {
            $query->whereIn('slug', $roleSlugs);
        });
    }

    /**
     * Scope a query to check if the user doesn't belong to the role using its name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $roleSlugs
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDoesNotBelongToRole($query, ...$roleSlugs)
    {
        if (is_array($roleSlugs[0])) {
            $roleSlugs = $roleSlugs[0];
        }

        return $query->whereHas('roles', function ($query) use ($roleSlugs) {
            $query->whereNotIn('slug', $roleSlugs);
        });
    }
}
