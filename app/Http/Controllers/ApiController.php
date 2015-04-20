<?php namespace App\Http\Controllers;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

use App\Http\RespondsTrait;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class ApiController extends Controller
{
    use RespondsTrait;

    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * @var
     */
    public static $transformer;

    /**
     * @param Manager $fractal
     */
    function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
        $this->fractal->parseIncludes($this->request->get('with', ''));
    }

    /**
     * @param $model
     * @return array
     */
    public function transformItem($model)
    {
        return $this->transform(Item::class, $model);
    }

    /**
     * @param $model
     * @return array
     */
    public function transformCollection($model)
    {
        return $this->transform(Collection::class, $model);
    }

    /**
     * @param string $resourceTypeClass
     * @param $model
     * @return array
     */
    public function transform($resourceTypeClass, $model)
    {
        $resource = new $resourceTypeClass($model, static::$transformer);

        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * @param LengthAwarePaginator $collection
     * @return Response
     */
    public function respondWithPaginator($collection)
    {
        return $this->respond($this->transformCollection($collection) + [
            'paginator' => [
                'total' => $collection->total(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage(),
                'per_page' => $collection->perPage()
            ]
        ]);
    }

    /**
     * @param $items
     * @return bool
     */
    public function hasMultipleItems($items)
    {
        return str_contains($items, ',');
    }
}