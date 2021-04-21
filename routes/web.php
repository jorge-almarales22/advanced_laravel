<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/groups', [App\Http\Controllers\UserController::class, 'index'])->name('groups');
Route::post('/groups', [App\Http\Controllers\UserController::class, 'store'])->name('addGroups');
Route::post('/addPosts', [App\Http\Controllers\UserController::class, 'addPosts'])->name('addPosts');
Route::get('/remove-groups/{group}', [App\Http\Controllers\UserController::class, 'remove'])->name('remove-groups');

Route::post('/images', [App\Http\Controllers\UserController::class, 'storeImg'])->name('addImage');
Route::post('/json', [App\Http\Controllers\UserController::class, 'responseJson'])->name('responseJson');

Route::get('posts/{post:user_id}', function (Post $post) {
    return $post;
});