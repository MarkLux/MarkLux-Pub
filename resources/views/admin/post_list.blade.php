@extends('layout.app')
@section('content')
@inject('getter','App\ViewComposer\ViewHelper')
    <div class="container">
        <br>
        <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>
                    @if(isset($categoryName))
                        {{$categoryName}}
                    @else
                            全部
                    @endif
                </h3>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                        切换分类
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/admin/posts')}}">全部</a></li>
                        @foreach($all_categories as $category)
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('admin/posts/category/'.$category->id)}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel-body">

                <a href="{{url('admin/posts/add-new')}}">
                    <button class="btn btn-primary">+新建文章</button>
                </a>
                <table class="table table-striped task-table">
                    <thead><th>标题</th><th>分类</th><th></th></thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                        <td><b>{{$post->title}}</b></td>
                        <td><a href="{{url('admin/posts/category/'.$post->cid)}}">{{$getter->getCategoryNameByCid($post->cid)}}</a></td>
                        <td><a href="{{url('admin/posts/update/'.$post->id)}}"><button class="btn btn-danger">编辑</button></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $posts->render() !!}
            </div>
        </div>
        </div>
    </div>
@endsection