<div class="panel panel-default">
    <div class="panel-heading">
        评论
    </div>
    <div class="panel-body">
        @if(count($comments)<=0)
            <p>还没有评论</p>
        @else

            @foreach($comments as $comment)
            <div class="panel panel-info">
                <div class="panel-heading">{{$comment->uid}}</div>
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
            @if(!empty($update))
            <div class="alert alert-success" role="alert">
                操作成功
            </div>
            @endif
            <form action="{{url('/blog/'.$post->id)}}" method="POST">
                {!! csrf_field() !!}
                <textarea class="form-control" name="comment"  cols="20" rows="5">{{old('comment')}}</textarea>
                <br>
                <button type="submit" class="btn btn-primary">提交评论</button>
            </form>
        @endif
    </div>
</div>