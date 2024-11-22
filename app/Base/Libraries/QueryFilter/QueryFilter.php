<?php

namespace App\Base\Libraries\QueryFilter;

use Exception;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use JsonSerializable;

class QueryFilter implements QueryFilterContract, Arrayable, Jsonable, JsonSerializable
{
    /**
     * The delimiter used to separate the fields.
     *
     * @var string
     */
    const DELIMITER = ',';

    /**
     * The default filters.
     *
     * @var array
     */
    protected $defaultFilters = [
        'includes',
        'search',
        'sort',
        'limit',
        'page',
        'paginate',
    ];

    /**
     * The config array.
     *
     * @var array
     */
    protected $config;

    /**
     * The Request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The Eloquent Query Builder instance.
     *
     * @var \Illuminate\Database\Eloquent\Builder|null
     */
    protected $builder = null;

    /**
     * The custom filter class instance.
     *
     * @var \App\Base\Libraries\QueryFilter\FilterContract|null
     */
    protected $customFilter = null;

    /**
     * The query builder model.
     *
     * @var \Illuminate\Database\Eloquent\Model|null
     */
    protected $model = null;

    /**
     * The default (pagination) result limit.
     *
     * @var int|null
     */
    protected $defaultLimit = null;

    /**
     * The fractal transformer for data transformation.
     *
     * @var \League\Fractal\TransformerAbstract|callable|null
     */
    protected $transformer = null;

    /**
     * The serializer used with data transformation.
     *
     * @var \League\Fractal\Serializer\SerializerAbstract|null
     */
    protected $serializer = null;

    /**
     * The relationships to (lazy) eager load.
     * This will also be used to parse transformer includes.
     *
     * @var array|null
     */
    protected $relations = null;

    /**
     * The additional relationships to (lazy) eager load.
     * These are manually specified by the user.
     *
     * @var array
     */
    protected $additionalRelations = [];

    /**
     * The default sort value if none are provided.
     *
     * @var string|null
     */
    protected $defaultSort = null;

    /**
     * The minimum (pagination) result limit.
     *
     * @var int|null
     */
    protected $minLimit = null;

    /**
     * The maximum (pagination) result limit.
     *
     * @var int|null
     */
    protected $maxLimit = null;

    /**
     * The default (pagination) result limit.
     *
     * @var int|null
     */
    protected $limit = null;

    /**
     * The page number when using (simple) pagination.
     *
     * @var int|null
     */
    protected $page = null;

    /**
     * Check if only the first item is required.
     * If this is 'true' then only the 'includes' filter is applied from the default filters.
     *
     * @var boolean
     */
    protected $first = false;

    /**
     * Enable full pagination on the filter.
     *
     * @var boolean
     */
    protected $fullPagination = false;

    /**
     * QueryFilter constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(Request $request, ConfigRepository $config)
    {
        $this->config = $config['filters'];
        $this->request = $request;

        $this->defaultLimit = $this->config('limit.default', 10);
        $this->minLimit = $this->config('limit.min', 5);
        $this->maxLimit = $this->config('limit.max', 50);
        $this->limit = $this->defaultLimit;
        $this->page = 1;
    }

    /**
     * Set the Query Builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return $this
     */
    public function builder(Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * Set the custom filter.
     *
     * @param \App\Base\Libraries\QueryFilter\FilterContract $filter
     * @return $this
     */
    public function customFilter(FilterContract $filter)
    {
        $this->customFilter = $filter;

        return $this;
    }

    /**
     * Set the transformer and serializer to be used for data transformation.
     * Setting the transformer enables the data transformation.
     *
     * @param \League\Fractal\TransformerAbstract|callable $transformer
     * @param \League\Fractal\Serializer\SerializerAbstract|null $serializer
     * @return $this
     */
    public function transformWith($transformer, $serializer = null)
    {
        $this->transformer = $transformer;

        $this->serializer = $serializer;

        return $this;
    }

    /**
     * Set the default sort order if none are provided in the query string.
     *
     * @param string $sort
     * @return $this
     */
    public function defaultSort($sort)
    {
        if (is_string($sort)) {
            $this->defaultSort = $sort;
        }

        return $this;
    }

    /**
     * Manually specify additional relations to add to includes.
     * The relations can be an array or string or multiple string inputs.
     *
     * @param string|array $includes
     * @return $this
     */
    public function customIncludes($includes)
    {
        $this->additionalRelations = is_array($includes) ? $includes : func_get_args();

        return $this;
    }

    /**
     * Lazy eager load all the requested relationships.
     *
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|null $modelOrCollection
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Spatie\Fractal\Fractal|null
     * @throws \Exception
     */
    public function loadIncludes($modelOrCollection)
    {
        if (is_null($modelOrCollection)) {
            return null;
        }

        if (!$modelOrCollection instanceof Model && !$modelOrCollection instanceof Collection) {
            throw new Exception('Only Models and Eloquent Collections support lazy eager loading.');
        }

        $model = $modelOrCollection instanceof Collection
        ? $modelOrCollection->first()
        : $modelOrCollection;

        $this->relations = $this->normalizeRelations($model, $this->request->get('includes'));

        $data = $this->relations
        ? $modelOrCollection->load($this->relations)
        : $modelOrCollection;

        return $this->transformData($data);
    }

    /**
     * Apply the filters and get the first result.
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|\Spatie\Fractal\Fractal|null
     */
    public function first($columns = ['*'])
    {
        $this->first = true;

        $data = $this->applyFilters()->first($columns);

        return $this->transformData($data);
    }

    /**
     * Apply the filters and get the result.
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Spatie\Fractal\Fractal|null
     */
    public function get($columns = ['*'])
    {
        if ($this->needsFullPagination()) {
            return $this->paginate($columns);
        }

        $data = $this->applyFilters()->get($columns);

        return $this->transformData($data);
    }

    /**
     * Apply the filters and paginate the result.
     *
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Spatie\Fractal\Fractal
     */
    public function paginate($columns = ['*'])
    {
        $this->fullPagination = true;

        $data = $this->applyFilters()
            ->paginate($this->limit, $columns)
            ->appends($this->request->query());

        return $this->transformData($data);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->get()->toArray();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     * @throws \Illuminate\Database\Eloquent\JsonEncodingException
     */
    public function toJson($options = 0)
    {
        return $this->get()->toJson($options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Apply transformation to the provided data.
     *
     * @param mixed|null $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Spatie\Fractal\Fractal|null
     */
    protected function transformData($data)
    {
        if (is_null($this->transformer)) {
            return $data;
        }

        return fractal($data, $this->transformer, $this->serializer)
            ->parseIncludes($this->relations);
    }

    /**
     * Apply all the requested filters that are available.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Exception
     */
    protected function applyFilters()
    {
        if (is_null($this->builder)) {
            throw new Exception('Query builder not set for filtering.');
        }

        $this->model = $this->builder->getModel();

        /**
        * Apply the default filters.
        */
        foreach ($this->getFilters() as $name => $value) {
            $name = 'filter' . studly_case($name);
            if (method_exists($this, $name)) {
                $value
                ? $this->$name($value)
                : $this->$name();
            }
        }

        /*
                     * Apply the custom filters.
        */
        foreach ($this->getCustomFilters() as $name => $value) {
            if (method_exists($this->customFilter, $name)) {
                $value
                ? $this->customFilter->$name($this->builder, $value)
                : $this->customFilter->$name($this->builder);
            }
        }

        return $this->builder;
    }

    /**
     * Get all the filters that can be applied.
     *
     * @return array
     */
    protected function getFilters()
    {
        if ($this->first) {
            $this->defaultFilters = ['includes', 'sort'];
        }

        return $this->getAvailableFilters($this->defaultFilters);
    }

    /**
     * Get all the filters that can be applied.
     *
     * @return array
     */
    protected function getCustomFilters()
    {
        if (is_null($this->customFilter)) {
            return [];
        }

        return $this->getAvailableFilters($this->customFilter->filters());
    }

    /**
     * Get the available filters from the requested filters.
     *
     * @param array $filters
     * @return array
     */
    protected function getAvailableFilters(array $filters)
    {
        /*
                     * If we add any custom includes manually and the 'includes' query doesn't exist
                     * then the 'includes' filter will never run. So to enable the filter to run for
                     * processing our custom includes, we add an empty 'includes' query string.
        */
        if (!empty($this->additionalRelations) && !$this->request->exists('includes')) {
            $this->request->merge(['includes' => null]);
        }

        /*
                     * We can use the default sort for the filter if no 'sort' query string is set.
                     * To enable this we need to add a 'defaultSort' method in the custom filter
                     * or call the 'defaultSort' method on the filter. The 'defaultSort' fluent method
                     * set value takes precedence to the sort value set using the custom filer.
        */
        if (!$this->request->exists('sort')) {
            if (!is_null($this->defaultSort)) {
                $this->request->merge(['sort' => $this->defaultSort]);
            } elseif (!is_null($this->customFilter) && method_exists($this->customFilter, 'defaultSort')) {
                $this->request->merge(['sort' => $this->customFilter->defaultSort()]);
            }
        }

        return array_only($this->request->query(), $filters);
    }

    /**
     * Apply the includes filter to eager load all the requested relationships.
     *
     * @param string|null $includes
     */
    protected function filterIncludes($includes = null)
    {
        $this->relations = $this->normalizeRelations($this->model, $includes);

        if ($this->relations) {
            $this->builder->with($this->relations);
        }
    }

    /**
     * Apply the search filter.
     *
     * @param string|null $search
     */
    protected function filterSearch($search = null)
    {
        if (is_null($search)
            || !(property_exists($this->model, 'searchable'))
            || !(method_exists($this->model, 'scopeSearch'))) {
            return;
        }

        $this->builder->search($search, null, true)
            ->orderBy('relevance', 'desc');
    }

    /**
     * Apply the sort filters.
     *
     * @param string|null $params
     */
    protected function filterSort($params = null)
    {
        if (is_null($params) || !($sortable = $this->model->sortable)) {
            return;
        }

        $sortable = array_wrap($sortable);

        foreach (explode(self::DELIMITER, $params) as $sortParam) {
            $column = ltrim($sortParam, '-');

            if (in_array($column, $sortable)) {
                $this->builder->orderBy($column, starts_with($sortParam, '-') ? 'desc' : 'asc');
            }
        }
    }

    /**
     * Apply the limit filter.
     *
     * @param int|string|null $limit
     */
    protected function filterLimit($limit = null)
    {
        $this->limit = $this->normalizeLimit($limit);

        if (!$this->needsFullPagination() && !$this->needsSimplePagination()) {
            $this->builder->take($this->limit);
        }
    }

    /**
     * Apply the simple pagination filter using the page number.
     *
     * @param int|string|null $page
     */
    protected function filterPage($page = null)
    {
        $this->page = $this->normalizePage($page);

        if (!$this->needsFullPagination()) {
            $this->builder->skip(($this->page - 1) * $this->limit)->take($this->limit);
        }
    }

    /**
     * Check if the request needs simple pagination.
     *
     * @return bool
     */
    protected function needsSimplePagination()
    {
        return $this->request->has('page');
    }

    /**
     * Check if the request needs full pagination with meta information.
     *
     * @return bool
     */
    protected function needsFullPagination()
    {
        return $this->fullPagination || $this->request->exists('paginate');
    }

    /**
     * Normalize the limit value.
     *
     * @param mixed $limit
     * @return int
     */
    protected function normalizeLimit($limit)
    {
        if (!is_null($limit) && filter_var($limit, FILTER_VALIDATE_INT) !== false) {
            return (int) limit_value($limit, $this->minLimit, $this->maxLimit);
        }

        return $this->defaultLimit;
    }

    /**
     * Normalize the page number value.
     *
     * @param mixed $page
     * @return int
     */
    protected function normalizePage($page)
    {
        if (!is_null($page) && $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false) {
            return (int) $page;
        }

        return 1;
    }

    /**
     * Normalize the relationship names.
     *
     * @param Model $model
     * @param string $includes
     * @return array|null
     */
    protected function normalizeRelations(Model $model, $includes)
    {
        if ((is_null($includes) && empty($this->additionalRelations)) || !($allowedIncludes = $model->includes)) {
            return null;
        }

        $requestedIncludes = array_unique(
            array_merge(array_filter(explode(self::DELIMITER, $includes)), $this->additionalRelations)
        );

        $relations = array_values(
            array_uintersect(
                array_wrap($allowedIncludes),
                $requestedIncludes,
                'strcasecmp'
            )
        );

        return $relations;
    }

    /**
     * Get the config value.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    protected function config($key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }
}
