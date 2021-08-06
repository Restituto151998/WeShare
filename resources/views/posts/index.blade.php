@extends('layouts.app')
 @section('content')
@section('offset')
    <div class="container">
     
      @foreach($posts as $post)
     
    
      <div class="row">
        <div class="col-6 offset-3">
   
            <span class="font-weight-bold ">
              <div class="d-flex">
              <a href="/profile/{{ $post->user->id }}"> 
              <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle w-100" style="max-width: 40px;">
              <span class="text-dark" style="font-size:20px;">{{ $post->user->name }}</span><span class="text-primary"> @ {{ $post->user->username }}</span> </a>
              <div class="dropdown" style="margin-left:140px">
                  <button  class="btn btn-transparent dropdown-toggle ml-5"  type="button" id="dropdownMenuButton"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                  </button>
                
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="/p/{{$post->id}}">
                        <i class="fas fa-eye p-3"></i> View Tweet</a>               
                  </div>           
                </div>
              </div>
            </span>

   
        <div class="mt-3">          
           <h5> {{ $post->caption }} </h5>                 
            <a href="/profile/{{ $post->user->id }}"><img src="/storage/{{ $post->image}}" class="w-100 pb-3"></a> 
           
            <div class="d-flex">
                <react-button :post="{{$post}}" :user_id="{{auth()->user()->id}}"></react-button>
            <form action="{{ route('profile.comment',$post->id) }}" method="post"  class="d-flex">   
              @csrf
  
                <img src="/storage/{{ auth()->user()->profile->image }}" class="rounded-circle w-100 ml-3" style="max-width: 40px;">
                <input type="text" class="form-control" style=" border-radius: 25px;width:120%"  name="comment" placeholder="comment here...">  
            </form>
          </div>
                 
        </div>  

      
   
          @foreach ($post->comments as $comment)
              <div class="align-items-center mt-3 d-flex offset-1">
           <img  src="/storage/{{ $comment->user->profile->image }}" class="rounded-circle w-100" style="max-width: 30px;"><p style="font-size:15px; margin-top:4%;margin-left:2%">{{ $comment->comment}}</p>
          </div>
          @endforeach
       
        </div>
        
      </div>
     
      <hr>  
      @endforeach

     

      <div class="row pt-2">
        <div class="col-12 d-flex justify-content-center">
          {{ $posts->links('pagination::bootstrap-4') }}
        </div>
 
      </div>
    
   </div> 
   @endsection
           @endsection