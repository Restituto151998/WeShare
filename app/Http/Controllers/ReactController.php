<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;

class ReactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Post $post, User $user){
        $react = $post->reacts()->where('user_id', $user->id)->first();
        if($react) {
            $react->delete();
            return "unheart";
        }else {
            $post->reacts()->create([
    'user_id' => $user->id         
]);
    return "heart";
        }
    }

}
