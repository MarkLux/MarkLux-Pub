<!--导航栏-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <!-- <span class="icon-bar"></span> -->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url("/")}}">龙润旅游系统</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">首页</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-labelledby="dropdownMenu4">
                        报价
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/quote-price')}}">报价</a></li>
                        <li><a href="{{url('/quote-price/template')}}">行程模板</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-labelledby="dropdownMenu4">
                        组团
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">组团操作</a></li>
                        <li><a href="#">组团查询</a></li>
                        <li><a href="#">预付款申请</a></li>
                        <li><a href="#">导游分配</a></li>
                        <li><a href="#">保障审核</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-labelledby="dropdownMenu4">
                        评价
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">评价管理</a></li>
                        <li><a href="#">模板管理</a></li>
                    </ul>
                </li>
                <li><a href="#">财务</a></li>
                <li><a href="#">统计</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-labelledby="dropdownMenu4">
                        设置
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">用户管理</a></li>
                        <li><a href="#">基本信息管理</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-labelledby="dropdownMenu4">
                            宇文成都 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/profile')}}">修改密码</a></li>
                            <li><a href="{{url('/admin')}}">个人信息</a></li>
                            <li><a href="{{url('/logout')}}">待办事项</a></li>
                        </ul>
                </li>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
