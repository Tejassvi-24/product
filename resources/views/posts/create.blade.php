@extends('posts.layout')
@section('content')
@if(Session::has('message'))
    <div class="container">
        <div class="row ">
                <div class="col-xs-12">
                <div class="{!! Session::get('class') !!}" id="message">{!!  Session::get('message') !!}</div>
            </div>
        </div>
    </div>
    <!-- //using jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function(){
            setTimeout(() => $('#message').fadeOut('slow'), 2000);

        });
    </script>
@endif

<div class="card mt-5">
    <h2 class="card-header">Add New Posts</h2>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('posts.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <form action ="{{ route('posts.store')}}" method="post">
        @csrf 
        <div class=mb-3>
            <label for="name" class="form-label"><strong>Name:</strong></label>
            <input type="text" name="name" id="name" class="form-control" Palceholder = " Post Name"></input>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class=mb-3>
            <label for="comment" class="form-label"><strong>Comments:</strong></label>
            <textarea type="text" name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror"  Palceholder = "Comments"></textarea>
            @error('comment')
            <div class="alert alert-danger">{{ $message}}</div>
            @enderror
           
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
    </form>
    </div>
</div>
@endsection