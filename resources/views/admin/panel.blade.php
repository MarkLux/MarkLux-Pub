@extends('layout.app')

@section('content')
    <div class="container">
    <div class= "page-header">
        <h2>后台管理</h2>
    </div>


        <a  class="btn btn-primary btn-lg" href="{{url('admin/posts/add-new')}}">新建文章</a>
        <a class="btn btn-primary btn-lg" href="{{url('admin/posts')}}">管理文章</a>
        <a class="btn btn-primary btn-lg" href="{{url('admin/categories')}}">管理分类</a>
    </div>
@endsection