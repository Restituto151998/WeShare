@extends('layouts.app')

@section('content')
@section('offset')
<div class="container ">
   
   <div class="row pl-5">
   <img src="{{ $user->profile->coverPhoto()}}" class="w-100 " style="height:300px">
        <img src="{{ $user->profile->profileImage()}}" class=" rounded-circle "
            style="margin-top:150px;position:absolute;width:200px;">
         <div class="col-9  offset-0 pt-5 pb-2 mt-5">
         
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-4">
                    <h1> {{$user->name}}</h1>

                @if(auth()->user()->id != $user->id)
                   <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                   <a href="/profile/messages/{{ $user->id }}"><button class="btn btn-primary ml-4">Send Message</button></a>

                @endif
                </div>
                
                @can('update',$user->profile)
                {{-- <button type="button"  style="right:auto;margin-left:200px"></button> --}}
                <button type="button" class="btn btn-outline-primary" onClick="editProfile({{$user}})" data-toggle="modal" data-target="#editProfile" style="right:auto;margin-left:200px"> Edit Profile</button>
                @endcan
                @can('update',$user->profile)
               {{-- <button> <a href="/p/create" class="btn btn-primary">+ Share Now</a></button> --}}
               <button class="btn btn-primary" data-toggle="modal" data-target="#addPost">  Share Now</a></button>
                @endcan
            </div>
           

            <div class=" font-weight-bold">@ {{$user->profile ->title}}</div><br>
            <div> <strong>{{$user->profile->description}} </strong></div>
            <div> <strong><i class="far fa-calendar-alt p-2"></i>Joined {{date_format($user->profile->created_at, 'M Y')}} </strong></div>
            <div><i class="fas fa-link p-2"></i><a href="#">{{$user->profile -> url}}</a></div>
        </div>
        <div class="d-flex pb-3">
            <div class="pr-5"> <strong>{{$user->posts->count()}} </strong>posts</div>
            <div class="pr-5"><strong>{{$user->profile->followers->count()}} </strong>followers</div>
            <div class="pr-5"><strong>{{$user->following->count()}} </strong>following</div>
        </div>



       </div>
   </div>
   <hr class="w-100 ">
   <div class="row ">
     
   @foreach($user->posts as $post)
        <div class="row  pb-3 ">
                <div class="offset-3 align-items-center pb-5">
                        <div class="d-flex">
                            <img src="{{ $user->profile->profileImage()}}" class="rounded-circle" style="width:40px"> &nbsp; &nbsp;
                            <a href="/profile/{{$post->user->id}}">
                             <strong> <span class="text-dark" style="font-size:20px;">{{$post->user->username }}</span></strong> </a></p>
            
                                <div class="dropdown ">
                                        <button style="margin-left:230px;" class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                      
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="/destroy/{{$post->id}}"
                                                onclick="return confirm('Are you sure you want to delete it? ')"> <i
                                                    class="far fa-trash-alt p-3"></i> Delete Tweet</a>
                                            <a onClick="editPost({{$post}})" class="dropdown-item" data-toggle="modal" data-target="#editPost"
                                              ><i class="fas fa-pen p-3"></i> Edit Tweet</a>                   
                                        </div>           
                            </div>
                           
                        </div><br>
                        <p> {{$post->caption}}</p>
             
        <a href="/p/{{ $post->id }}">
          
             <img src="/storage/{{$post->image}}" class="w-50">
             <hr class="w-75">
        </a>
           
        </div>
       
     @endforeach
   
   </div>
   <!-- Modal for Editing Profile-->
   <div class=" container modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true" >
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title offset-4" id="exampleModalLabel">Edit Profile</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form id="editProfile" method="post" enctype="multipart/form-data">

                   @csrf
                   @method('PATCH')

                   <div class="col-8 offset-2">

                       <div class="form-group row">
                           <label for="title">Username</label>
                           <input type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{old('title') ?? $user->profile->title}}" autocomplete="title"
                               autofocus>

                           @error('title')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                           @enderror
                       </div>
                       <div class="form-group row">
                           <label for="description">Bio</label>
                           <textarea name="description" id="description" cols="30" rows="5"
                               class="form-control @error('title') is-invalid @enderror" name="description"
                               autocomplete="description"
                               autofocus>{{old('description') ?? $user->profile->description}}</textarea>

                           @error('title')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                           @enderror

                       </div>
                       <div class="form-group row">
                           <label for="url">URL/Website</label>
                           <input type="text" id="url" class="form-control @error('url') is-invalid @enderror"
                               name="url" value="{{old('url') ?? $user->profile->url}}" autocomplete="url"
                               autofocus>

                           @error('url')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                           @enderror
                       </div>

                       <div class="row">
                           <label for="image">Profile Image</label>
                           <input type="file" name="image" id="image" class="form-control-file"
                               value="{{old('image') ?? $user->profile->image}}">
                       </div>

                       @error('image')
                       <strong>{{$message}}</strong>
                       </span>
                       @enderror

                       <div class="row">
                           <label for="bg_image">Cover Photo</label>
                           <input type="file" name="bg_image" id="bg_image" class="form-control-file"
                               value="{{old('bg_image') ?? $user->profile->image}}">
                       </div>

                       @error('bg_image')
                       <strong>{{$message}}</strong>
                       </span>
                       @enderror

                       <div class="row pt-4">
                           <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



   <!-- Edit Posts -->
   <div class=" container modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title offset-4" id="exampleModalLabel">Edit Post</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form id="postForm" method="post" enctype="multipart/form-data">

                   @csrf
                   @method('PUT')

                   <div class="col-8 offset-2">
                       <div class="form-group row">
                           <label for="caption">Caption</label>
                           <textarea name="caption" id="caption" cols="10" rows="2"
                               class="form-control @error('title') is-invalid @enderror" name="caption"
                               autocomplete="description"
                               autofocus></textarea>
                       </div>
                       <img id="modalImage" class="w-100">
                       <div class="row pt-4">
                           <button type="submit" class="btn btn-primary">Update Post</button>
                       </div>
                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           </div>
       </div>
   </div>
</div>
<!-- End of modal -->
   <!-- Add Posts -->
   <div class=" container modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true" >
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           {{-- <div class="modal-header">
              
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div> --}}
           <div class="modal-body">
                <form action="/p" method="post" enctype="multipart/form-data"> 

                    @csrf
                    <div class="col-8 offset-2">
                    
                    <div class="row"> 
                        <h1>Add Tweet</h1> 
                        </div> 
                           <div class="form-group row"> 
                                <label for="caption">Tweet Caption</label>
                                <input type="text"
                                id="caption" 
                                class="form-control @error('caption') is-invalid @enderror" 
                                name="caption" 
                                value="{{ old('caption') }}" 
                                autocomplete="caption" autofocus> 
        
        
                                @error('caption')
                                
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong> 
                                </span> 
                                @enderror 
                           </div> 
                                    
                        <div class="row"> 
                            <label for="image">  Image</label>
                            <input type="file" name="image" id="image" class="form-control-file"> 
                        </div>
                            @error('image') 
                                <strong>{{ $message }}</strong> 
                            @enderror

                        
                                <div class="row pt-4"> 
                                <button type="submit" class="btn btn-primary">Add Tweet</button> 
                    </div>
                    
                    </div>
                </form>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           </div>
       </div>
   </div>
</div>
<!-- End of modal -->
</div>
@endsection
@endsection
