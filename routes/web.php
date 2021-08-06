<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::post('/posts/{post}/reacts/{user}',[App\Http\Controllers\ReactController::class, 'store']);
Route::post('/follow/{user}', [App\Http\Controllers\FollowController::class, 'store']);
Route::get('/',[App\Http\Controllers\PostsController::class, 'index']);
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::put('/profile/update/{post}', [App\Http\Controllers\PostsController::class, 'update']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::get('/destroy/{post}', [App\Http\Controllers\PostsController::class, 'destroy']);


Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.index');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.index');
Route::post('/posts/{post}/comments', [App\Http\Controllers\PostsController::class, 'addComment'])->name('profile.comment');
Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
    return view("search")->withDetails($user)->withQuery ( $q );
    else  
    return view("search")->with('error', 'no');
});

Route::get('/profile/messages/{user}', [App\Http\Controllers\MessageController::class, 'chat'])->name('profile.message');
Route::post('/profile/messages/{user}', [App\Http\Controllers\MessageController::class, 'store'])->name('profile.message.create');
