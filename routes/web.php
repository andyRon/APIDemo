<?php

use App\Http\Controllers\PostController;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('test/show' ,function () {
//    return 'xxxx';
//})->name('test.show');

Route::resource('posts', PostController::class);
Route::get('posts/{post}/comments/{comment}', function () {
    // ... show comment
})->name('posts.comments.show');
Route::get('user/{user}', function () {
    // ... show author
})->name('users.show');



