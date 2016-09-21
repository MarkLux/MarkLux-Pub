@extends('layout.app')

@section('content')
    <div class="container">
        <h3>{{$user->name}}</h3>
        <p>创建于：{{$user->created_at}}</p>
        <i>更多功能正在开发中...</i>
    </div>
@endsection