<?php

namespace App\Transformers;

use App\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['lessons'];

    public function transform(Tag $tag)
    {
        return [
            'name' => $tag->name,
        ];
    }

    public function includeLessons(Tag $tag)
    {
        return $this->collection($tag->lessons, new LessonTransformer);
    }
}