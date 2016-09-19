@extends('layout.app')
@section('content')
    <br>
<div class="container">

    <div class="row">

        <div class="col-md-6" id="add_new_form" >

            @include('errors.form_validation')

            @if(!empty($update))
                    <div class="alert alert-success" role="alert">
                        操作成功
                    </div>
            @endif

            <h1>添加文章</h1>


            <form action="{{url('/admin/posts/add-new')}}" method="POST">
                {!! csrf_field() !!}
                {{--没有csrf域post会被deny，然后直接返回500--}}
            <h3>标题</h3>
            <input class="form-control" type="text" name="title" size="20" value="<?php old('blog_title'); ?>"/>
            <br>
            <h3>分类</h3>
                <select name="cid">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            <h3>内容</h3>
                {{--下面这个textarea如果不写在一行里就会导致输入框自带一堆烦人的空格--}}
            <textarea  class="form-control" rows="10" name="postContent" id="text_editor" oninput="update()"><?php old('postContent'); ?></textarea>
            <br>
            <button type="submit" class="btn btn-default">提交</button>

            </form>
        </div>
        <div class="col-md-6">

            <h3>实时预览</h3>
            <div id="preview">
                随便写点什么就可以查看预览了哦...
            </div>

        </div>
    </div>
</div>

<script>
    var editor = document.getElementById('text_editor');
    var preview = document.getElementById('preview');
    var parser = new HyperDown;

    function update()
    {
        preview.innerHTML = parser.makeHtml(editor.value);
    }
</script>
@endsection
