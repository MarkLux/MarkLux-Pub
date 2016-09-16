@extends('layout.app')
@section('content')
    <div class="container">
        @foreach($posts as $item)
            <a href="{{url('blog/'.$item->id)}}"><h2>{{$item->title}}</h2></a>
            updated_at: {{$item->updated_at}} <br>
            <p>
                {{$item->content}}
            </p>
            <hr>
        @endforeach
        {{--厉害了我的哥，这分页封装的飞起,直接调用这个对象的render方法就能生成有样式的分页链接--}}
        {!! $posts->render() !!}
    </div>
@endsection