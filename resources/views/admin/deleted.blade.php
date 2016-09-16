@extends('layout.app')
@section('content')
    <br>
    <div class="container">
    <div class="alert alert-success" role="alert">
        删除成功
    </div>
    <a href={{url("/admin/list")}}><button class="btn btn-primary">返回列表</button></a>
    </div>
@endsection