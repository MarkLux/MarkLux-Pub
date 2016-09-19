@extends('layout.app')

@inject('getter','App\ViewComposer\CategoryComposer')

@section('content')
    <div class="container">
        <div class="page-header">
            <h2>{{$categoryName}}</h2>
        </div>
        @foreach($posts as $post)
            <a href="{{url('blog/'.$post->id)}}"><h2>{{$post->title}}</h2></a>
            <p>
                更新时间: {{$post->updated_at}} &nbsp &nbsp
                分类： <a href="{{url("/blog/category/".$post->cid)}}">{{$getter->getCategoryNameByCid($post->cid)}}</a>
            </p>
            <p>
                {{$post->content}}
            </p>
            <hr>
        @endforeach
        {{--厉害了我的哥，这分页封装的飞起,直接调用这个对象的render方法就能生成有样式的分页链接--}}
        {!! $posts->render() !!}
    </div>
@endsection