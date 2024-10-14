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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Posts List
                        <a  href ="{{ route('posts.create') }}" class="btn btn-primary float-end">Add Post</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if($posts->count())
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Comments</th>
                                <th width="250px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->comments }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$post->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <a class="btn btn-info btn-sm" href="{{ route('posts.show',$post->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
    {!! $posts->links() !!}
    
@endsection