@extends('layouts.app')
 @section('content')
 @section('offset')
  <div class="container">
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
                    <label for="image">Tweet Image</label>
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
           @endsection
           @endsection