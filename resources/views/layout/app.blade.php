<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Mark Lux|Pub</title>

    <!-- Bootstrap -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/site.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{url("/")}}/js/Parser.js"></script>
    <style>
	img {
	    max-width: 80vw;
	}
        @media  screen and (max-width: 768px) {
                img {
                    max-width: 92vw;
                }
        }
    </style>
</head>
<body>

    @include("layout.top_nav")

    <div  style="height:51px">
    </div>
    @yield('content')
    <!--footer-->
    <footer class="footer ">
        <hr/>
        <div class="row footer-bottom">
            <ul class="list-inline text-center">
                <li>
                    &copy;2020
                </li>
                <li>
                    MarkLux
                </li>
            </ul>
	    <ul class="list-inline text-center">
                <li>
                    冀ICP备17019200号-1
                </li>
            </ul>
        </div>
        </div>
    </footer>

</body>
</html>
