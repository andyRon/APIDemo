<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class UserResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return Arr::only($this->resource->toArray(), 'name');
    }

    public function toLinks(Request $request): array
    {
        return [
            Link::self(route('users.show', $this->id)),
        ];
    }
}
