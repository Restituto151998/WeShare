<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class ProfilesController extends Controller
{
    public function index(User $user)
    {

    //    $user = User::find($user);
     
    //     return view('home',[
    //         'user' =>  $user
    //     ]);
    $follows = (auth()->user())? auth()->user()->following->contains($user->id):false;
        return view('profiles.index',compact('user','follows'));

    }

    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);
        // return view('profiles.index',compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([

            'title'=>'required',
            'description'=> 'required',
            'url'=>'url',
            'image'=>'',
            'bg_image' =>''

        ]);

        if(request('image')){
            $imagePath = (request('image')->store('profile','public'));
            $image = Image::make(public_path("storage/{$imagePath}"))->resize(1000,1000);
            $image->save();
            $imageArray = ["image" => $imagePath];
        }
        if(request('bg_image')){
            $imagePath1 = (request('bg_image')->store('bg_image','public'));
            $bg_image = Image::make(public_path("storage/{$imagePath1}"))->resize(1000,1000);
            $bg_image ->save();
            $imageArray1 = ["bg_image" => $imagePath1];
        }

        auth()->user()->profile->update(array_merge(

            $data,
            $imageArray ?? [],
            $imageArray1 ?? []
        ));
        return redirect("/profile/{$user->id}");
    }
}
