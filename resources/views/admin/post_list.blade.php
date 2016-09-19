@extends('layout.app')
@section('content')
    <div class="container">



        @foreach($posts as $item)
            <a href="{{url('admin/posts/update/'.$item->id)}}"><h2>{{$item->title}}</h2></a>
            updated_at: {{$item->updated_at}} <br>
            <p>
                {{$item->content}}
            </p>
            <hr>
        @endforeach
        {!! $posts->render() !!}
    </div>
@endsection