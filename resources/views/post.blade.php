@extends("layout.app")

@section("content")
    <div class="container">
        <div class="page-header">
            <h1>{{$item->title}}</h1>
        </div>
        <p>
            更新时间： {{$item->updated_at}}
        </p>
        <hr>
        <div id="content">
            {!! $content !!}
        </div>

    </div>
@endsection