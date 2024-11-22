<?php

namespace App\Base\Libraries\QueryFilter;

use Illuminate\Database\Eloquent\Builder;

interface QueryFilterContract {
	/**
	 * Set the Query Builder.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 * @return $this
	 */
	public function builder(Builder $builder);

	/**
	 * Set the custom filter.
	 *
	 * @param \App\Base\Libraries\QueryFilter\FilterContract $filter
	 * @return $this
	 */
	public function customFilter(FilterContract $filter);

	/**
	 * Set the transformer and serializer to be used for data transformation.
	 * Setting the transformer enables the data transformation.
	 *
	 * @param \League\Fractal\TransformerAbstract|callable $transformer
	 * @param \League\Fractal\Serializer\SerializerAbstract|null $serializer
	 * @return $this
	 */
	public function transformWith($transformer, $serializer = null);

	/**
	 * Set the default sort order if none are provided in the query string.
	 *
	 * @param string $sort
	 * @return $this
	 */
	public function defaultSort($sort);

	/**
	 * Manually specify additional relations to add to includes.
	 * The relations can be an array or string or multiple string inputs.
	 *
	 * @param string|array $includes
	 * @return $this
	 */
	public function customIncludes($includes);

	/**
	 * Lazy eager load all the requested relationships.
	 *
	 * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|null $modelOrCollection
	 * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Spatie\Fractal\Fractal|null
	 * @throws \Exception
	 */
	public function loadIncludes($modelOrCollection);

	/**
	 * Apply the filters and get the first result.
	 *
	 * @param array $columns
	 * @return \Illuminate\Database\Eloquent\Model|\Spatie\Fractal\Fractal|null
	 */
	public function first($columns = ['*']);

	/**
	 * Apply the filters and get the result.
	 *
	 * @param array $columns
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Spatie\Fractal\Fractal|null
	 */
	public function get($columns = ['*']);

	/**
	 * Apply the filters and paginate the result.
	 *
	 * @param array $columns
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Spatie\Fractal\Fractal
	 */
	public function paginate($columns = ['*']);
}
