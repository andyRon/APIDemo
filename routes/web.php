<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('posts/{post}', function (Request $req, Post $post) {
//    return new PostResource($post);
    return new PostResource($post->load(['author', 'comments'])); // TODO
});
