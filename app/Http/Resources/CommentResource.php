<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class CommentResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return Arr::only($this->resource->toArray(), ['id']);
    }

    public function toRelationships(Request $request): array
    {
        return [
            Link::self(route('posts.comments.show', [$this->post_id, $this->id])),
        ];
    }
}
