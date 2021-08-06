@extends('layouts.app')
 @section('content')
 @section('offset')
   <div class="container ">
     <div class="row">
       <div class="col-8">
          <img src="/storage/{{ $post->image}}" class="w-100">
       </div>

       <div class="col-4">
       
          <div class="d-flex align-items-center"> 
            <div class="pr-3">
              <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle w-100" style="max-width: 40px;">
            </div>
            <div>
              <h5 class="font-weight-bold">
                <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span> </a>
              </h5>
              
            </div>
          </div>
          <hr>
          <p><span class="font-weight-bold"><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span> </a></span> {{ $post->caption }}</p>
       </div>
     </div>
   </div> 
   @endsection
           @endsection