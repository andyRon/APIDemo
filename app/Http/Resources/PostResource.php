<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class PostResource extends JsonApiResource
{
    // 定义的属性字段会映射 JSON API 的 attributes
    public function toAttributes(Request $request)
    {
        return Arr::except($this->resource->toArray(), ['id', 'author', 'comments']);
    }

    // 定义的关联资源会映射到 JSON API 的 relationships 以及 included
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
            Link::self(route('posts.show', $this->resource)),
        ];
    }
}
