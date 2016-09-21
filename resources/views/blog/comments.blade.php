@inject('getter','App\ViewComposer\ViewHelper')

<div class="panel panel-default">
    <div class="panel-heading">
        评论
    </div>
    <div class="panel-body">
        @if(!empty($update))
            <div class="alert alert-success" role="alert">
                操作成功
            </div>
        @endif
        @if(count($comments)<=0)
            <p>还没有评论</p>
        @else
            @foreach($comments as $comment)
            <div class="panel panel-info">
                <div class="panel-heading">
                    by <b><a href="{{url('/profile')}}">
                    {{$getter->getUser($comment->uid)->name}}
                    </a></b>&nbsp at &nbsp
                    {{$comment->updated_at}}
                    @if(!empty($loginStatus)&&Gate::allows('delete-comment',$comment))
                        <form action="{{url('/blog/delete-comment/'.$comment->id).'?bid='.$post->id}}" method="POST">
                            {!!csrf_field()!!}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('确定删除？')">删除</button>
                        </form>
                    @endif
                </div>
                <div class="panel-body">
                    <p>{{$comment->content}}</p>
                </div>
            </div>
            @endforeach
        @endif
        <hr>
        @if(!empty($loginStatus))
            <h3>撰写评论</h3>
            @include('errors.form_validation')
            <form action="{{url('/blog/'.$post->id)}}" method="POST">
                {!! csrf_field() !!}
                <textarea class="form-control" name="comment"  cols="20" rows="5">{{old('comment')}}</textarea>
                <br>
                <button type="submit" class="btn btn-primary">提交评论</button>
            </form>
        @endif
    </div>
</div>