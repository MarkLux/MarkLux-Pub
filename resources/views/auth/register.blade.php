@extends("layout.app")

@section("content")
<div class="container" id="register_form">
    <h1>注册</h1>
    <form action="http://localhost/blog/public/auth/register" method="POST">
        {!! csrf_field() !!}
        <div class="form_group">
            <label>用户名</label>
            <input class="form-control" type="text" name="name" value="{{old('name')}}">
        </div>
        <div class="form_group">
            <label>邮箱</label>
            <input class="form-control" type="email" name="email" value="{{old('email')}}">
        </div>
        <div class="form_group">
            <label>密码</label>
            <input class="form-control" type="password" name="password">
        </div>
        <div class="form_group">
            <label>确认密码</label>
            <input class="form-control" type="password" name="password_confirmation">
        </div>
        <br>
        <button type="submit">提交</button>
    </form>
</div>
@endsection