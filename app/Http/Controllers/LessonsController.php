<?php namespace App\Http\Controllers;

use App\Tag;
use App\Lesson;
use App\Transformers\LessonTransformer;
use App\Http\Requests\NewLessonRequest;

use League\Fractal\Manager;

use Illuminate\Http\Request;

class LessonsController extends ApiController {

    public $request;

    /**
     * @param LessonTransformer $lessonTransformer
     * @param Manager $manager
     * @param Request $request
     * @param Lesson $lesson
     */
    function __construct(LessonTransformer $lessonTransformer, Manager $manager, Request $request, Lesson $lesson)
    {
        $this->request = $request;
        $this->lesson = $lesson;

        static::$transformer = $lessonTransformer;

        $this->middleware('auth.basic', ['only' => 'store']);

        parent::__construct($manager);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Tag $tag
     * @param null $id
     * @return Response
     */
    public function index(Tag $tag, $id = null)
    {
        $limit = $this->request->get('limit', 10);

        if ($id) {
            $collection = $tag->findOrFail($id)->lessons()->paginate($limit);
        } else {
            $collection = $this->lesson->paginate($limit);
        }

        return $this->respondWithPaginator($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewLessonRequest $request
     * @return Response
     */
	public function store(NewLessonRequest $request)
	{
        $this->lesson->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'some_bool' => false
        ]);

        return $this->respondCreated('Lesson was successfully created.');
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
            $resource = $this->transformCollection($this->lesson->find(explode(',', $id)));
        } else {
            $resource = $this->transformItem($this->lesson->findOrFail($id));
        }

        return $this->respond($resource);
    }
}
