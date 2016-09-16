@extends('layout.app')

@section('content')
    <div class="container">

    Test:
    @foreach($test as $item)
        <h2>{{$item->title}}</h2>
        updated_at: {{$item->updated_at}} <br>
        <p>
            {{$item->content}}
        </p>
        <hr>
    @endforeach

    </div>
@endsection