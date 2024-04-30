<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test/show' ,function () {
    return 'xxxx';
})->name('test.show');


Route::get('posts/{id}', function (Request $request, int $id) {
    $post = QueryBuilder::for(Post::where('id', $id))
        ->allowedFields(['id', 'title', 'slug', 'content', 'views', 'created_at', 'updated_at'])
        ->first();
    return new PostResource($post);
    // 关联查询

});


Route::get('posts', function (Request $request) {
    $posts = QueryBuilder::for(Post::class)
        ->allowedFields(['id', 'title', 'content', 'views', 'created_at', 'authors.id', 'authors.name'])
        ->allowedFilters(['title'])
        ->defaultSort('-id')
        ->allowedSorts(['views', 'created_at'])
        ->allowedIncludes('author')
        ->paginate(10);
    return PostResource::collection($posts);
});
