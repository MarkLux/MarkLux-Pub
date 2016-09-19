@extends("layout.app")

@inject('getter','App\ViewComposer\CategoryComposer')

@section("content")
    <div class="container">
        <div class="page-header">
            <h1>{{$post->title}}</h1>
        </div>
        <p>
            更新时间： {{$post->updated_at}} &nbsp &nbsp &nbsp
            分类： <a href="{{url("/blog/category/".$post->cid)}}">{{$getter->getCategoryNameByCid($post->cid)}}</a>
        </p>
        <hr>
        <div id="content">
            {!! $content !!}
        </div>

    </div>
@endsection