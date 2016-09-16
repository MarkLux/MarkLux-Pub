@extends('layout.app')

@section('content')
    <div class="container">
    <div class= "page-header">
        <h2>后台管理</h2>
    </div>


        <a  class="btn btn-primary btn-lg" href="{{url('admin/add-new')}}">新建文章</a>
        <a class="btn btn-primary btn-lg" href="{{url('admin/list')}}">管理文章</a>
    </div>
@endsection