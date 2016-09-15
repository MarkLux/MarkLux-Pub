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
            <a class="navbar-brand" href="{{url("/")}}">MarkLux</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{url("/")}}">首页
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class = "dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-labelledby="dropdownMenu4">
                        博文
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="http://localhost/mark/index.php/blog/view/all">全部</a>
                            <a href="http://localhost/mark/index.php/blog/view/分享">分享</a>
                            <a href="http://localhost/mark/index.php/blog/view/技术">技术</a>
                            <a href="http://localhost/mark/index.php/blog/view/未分类">未分类</a>
                            <a href="http://localhost/mark/index.php/blog/view/生活">生活</a>
                        </li>
                    </ul>

                <li>
                    <a href="#">Pub</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    @if(Auth::check())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-labelledby="dropdownMenu4">
                            {{Auth::user()->name}}           <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{url('/profile')}}">个人资料</a>
                            </li>
                            @if(Gate::allows('manage-posts'))
                                <li><a href="{{url('/admin')}}">管理</a></li>
                            @endif
                            <li>
                                <a href="{{url('/logout')}}">登出</a>
                            </li>
                        </ul>
                    @else
                        <a href="{{url('/login')}}">登陆</a>
                    @endif
                </li>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>