<?php
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('posts/{id}', function (Request $request, int $id) {
    $post = QueryBuilder::for(Post::where('id', $id))
        ->allowedFields(['id', 'title', 'slug', 'content', 'views', 'created_at', 'updated_at'])
        ->allowedIncludes(['author', 'comments'])
        ->first();
    return new PostResource($post);
    // 关联查询

});


Route::get('posts', function (Request $request) {
    $posts = QueryBuilder::for(Post::class)  // 把指定模型类注入Laravel Query Builder。这样对原来的代码没有侵入
    ->allowedFields(['id', 'title', 'content', 'views', 'created_at', 'authors.id', 'authors.name'])
        ->allowedFilters(['title'])  // 指定了支持过滤筛选的字段，也就是允许`filter[title]=***`这样查询
        ->defaultSort('-id')
        ->allowedSorts(['views', 'created_at'])
        ->allowedIncludes('author')  // 关联关系
        ->paginate(10);
    return PostResource::collection($posts);
});
