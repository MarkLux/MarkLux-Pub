<!--导航栏-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <!-- <span class="icon-bar"></span> -->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url("/")}}">MarkLux's Pub</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class = "dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-labelledby="dropdownMenu4">
                        博文
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('blog')}}">全部</a></li>
                        @foreach($all_categories as $category)
                            <li><a href="{{url('blog/category/'.$category->id)}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
		<li><a href="{{url('calendar')}}">黄历</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    @if($loginStatus === true)
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-labelledby="dropdownMenu4">
                            {{$user->name}}           <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{url('/profile')}}">个人资料</a>
                            </li>
                            @if($user->is_admin === 1)
                                <li><a href="{{url('/admin')}}">管理</a></li>
                            @endif
                            <li>
                                <a href="{{url('/logout')}}">登出</a>
                            </li>
                        </ul>
                    @else
                        <a href="{{url('/login')}}">登陆</a></li>
                        <li><a href="{{url('/register')}}">注册</a>
                    @endif
                </li>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
