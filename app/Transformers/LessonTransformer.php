<?php

namespace App\Transformers;

use App\Lesson;
use League\Fractal\TransformerAbstract;

class LessonTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['tags'];

    public function transform(Lesson $lesson)
    {
        return [
            'title' => $lesson->title,
            'body' => $lesson->body,
            'visible' => (bool) $lesson->some_bool
        ];
    }

    protected function includeTags(Lesson $lesson)
    {
        return $this->collection($lesson->tags, new TagTransformer);
    }
}