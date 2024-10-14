@extends('posts.layout')
@section('content')
<div class="card mt-5">
    <h2 class="card-header">Edit Post</h2>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('posts.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{route('posts.update',$data->id)}}" method="post">
            @csrf 
            @method('PUT')
            <div class=mb-3>
                <label for="name" class="form-label"><strong>Name:</strong></label>
                <input type="text" name="name" id="name" class="form-control" Palceholder = " Post Name" value="{{ $data->name }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message}}</div>
                @enderror
            </div>
            <div class=mb-3>
                <label for="comment" class="form-label"><strong>Comments:</strong></label>
                <textarea name="comment" id="comment" class="form-control">{{ old('comment', $data->comments) }}</textarea>
                @error('comments')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </form>
    </div>
</div>
@endsection