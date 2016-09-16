@extends('layout.app')
@section('content')
    <br>
    <div class="container">

        <div class="row">

            <div class="col-md-6" id="add_new_form" >

                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                @if(!empty($update))
                    <div class="alert alert-success" role="alert">
                        操作成功
                    </div>
                @endif

                <h1>编辑文章</h1>

                    <a href="{{url("admin/delete/".$post->id)}}" onclick="return confirmOperate()"><button class="btn btn-danger" >删除这篇文章</button></a>

                <form action="{{url('/admin/update/'.$post->id)}}" method="POST">
                    {!! csrf_field() !!}
                    {{--没有csrf域post会被deny，然后直接返回500--}}
                    <h3>标题</h3>
                    <input class="form-control" type="text" name="title" size="20" value="{{$post->title}}"/>
                    <br>
                    <h3>内容</h3>
                    {{--下面这个textarea如果不写在一行里就会导致输入框自带一堆烦人的空格--}}
                    <textarea  class="form-control" rows="10" name="postContent" id="text_editor" oninput="update()">{{$post->content}}</textarea>
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

        function confirmOperate()
        {
           if(confirm("确定要删除这篇文章吗"))
               return true;
           else
               return false;
        }
    </script>
@endsection
