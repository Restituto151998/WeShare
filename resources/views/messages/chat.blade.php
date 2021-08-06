@extends('layouts.app')
 @section('content')
 @section('offset')
    <div class="container">
        <h4>You are sending message to : {{ $user->username }}</h4>
         <form action="{{ route('profile.message.create', $user) }}" method="post"  class="d-flex">
                @csrf
                <img src="/storage/{{ auth()->user()->profile->image }}" class="rounded-circle w-100" style="max-width: 40px;">
                <input type="text" class="form-control" style=" border-radius: 25px;" name="message" placeholder="Type here...">  
        </form>
       
        @foreach ($messages as $message)
           
            <p>{{ $message->sender_id }} {{ $message->message }} </p>
        @endforeach
      
   </div> 
   @endsection  
           @endsection