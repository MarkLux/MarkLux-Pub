@extends("layout.app")
@section("content")
<div class="container">
<!-- resources/views/auth/login.blade.php -->
    <br>
    @include('errors.form_validation')
<form method="POST" action="{{url('/login')}}">
    {!! csrf_field() !!}

    <div class = "form-group">
        <label>Email</label>
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <label>密码</label>
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <div class="form-group">
        <input type="checkbox" name="remember">记住我
    </div>

    <div>
        <button type="submit" class="btn btn-primary">登陆</button>
    </div>
</form>
</div>
@endsection