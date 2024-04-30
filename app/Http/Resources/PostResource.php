<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Tests\Resources\CommentResource;
use Tests\Resources\UserResource;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class PostResource extends JsonApiResource
{
    public function toAttributes(Request $request)
    {
        return Arr::except($this->resource->toArray(), 'id');
    }

    public function toRelationships(Request $request)
    {
        return [
            'author' => fn() => new UserResource($this->author),
            'comments' => fn() => CommentResource::collection($this->comments),
        ];
    }
    public function toLinks(Request $request)
    {
        return [
            Link::self(route('test.show', $this->resource)),
        ];
    }
}
