<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;
class PostsController extends Controller
{
public function __construct()

{
    $this->middleware('auth');

}

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $users->push(auth()->user()->id);
      
        // $posts = Post::whereIn('user_id', $users)->latest()->paginate(3);
        $posts= \App\Models\Post::with('reacts')->withCount('reacts')->latest()->paginate(10);
 
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image']
        ]);
        
    

        $imagePath = (request('image')->store('uploads','public'));
   
      
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(1200,1200);
        $image->save();
        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
            ]);
        return redirect('/profile/'. auth() ->user()->id);
   

    }

    public function show(Post $post)
    {
       return view('posts.show',compact('post'));
    }

    public function addComment(Request $request,Post $post)
    {
    $userId = auth()->user()->id;

        $post->comments()->create([
            'comment'=>$request->comment,
            'user_id'=>$userId

        ]);

        return redirect('/');
    }
    public function destroy(\App\Models\Post $post){
        $delete = Post::findOrFail($post->id);
             $delete-> delete(); 
       return redirect('/profile/'. auth()->user()->id)->with('message','Post Deleted');
}       

public function update(Post $post){

$data = request()->validate([
   'caption' => 'required',
]);

$post->update($data);
return redirect('/profile/'. auth()->user()->id); 
}


}