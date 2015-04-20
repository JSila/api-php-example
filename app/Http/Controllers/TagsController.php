<?php namespace App\Http\Controllers;

use Request;

use App\Tag;
use App\Lesson;
use App\Transformers\TagTransformer;

use League\Fractal\Manager;

class TagsController extends ApiController {

    function __construct(TagTransformer $tagTransformer, Manager $manager)
    {
        static::$transformer = $tagTransformer;

        parent::__construct($manager);
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return Response
     */
	public function index($id = null)
	{
        $limit = Request::get('limit', 10);

        $collection = $id ? Lesson::findOrFail($id)->tags()->paginate($limit) : Tag::paginate($limit);

        return $this->respondWithPaginator($collection);
	}

    /**
     * Display the specified resource or subset of resources.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if ($this->hasMultipleItems($id)) {

            $collection = Tag::find(explode(',', $id));

            return $this->respond($this->transformCollection($collection));

        } else {

            $item = Tag::findOrFail($id);

            return $this->respond($this->transformItem($item));
        }
    }
}
